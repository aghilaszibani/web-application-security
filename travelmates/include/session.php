<?php 
ob_start();
ini_set('session.cookie_httponly', 1 );
/*ini_set('session.gc_maxlifetime', 5);*/
session_start();
include("include/database.php");



if (isset($_POST['connexion'])){
  require_once 'autoload.php';
  $recaptcha = new \ReCaptcha\ReCaptcha('6Ld1xRApAAAAAFahUTirM0r5V7HZqtZWYTzQKH6v');
  $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
  if ($resp->isSuccess()) {
    // Verified!

  if(!empty($_POST['pseudo']) && !empty($_POST['password'])){

    $pseudo = $_POST['pseudo'];
    $safe_pseudo = mysqli_real_escape_string($con, $pseudo);
    $password = $_POST['password'];
    $safe_password = mysqli_real_escape_string($con, $password);
    $hashedPassword = sha1($password);

    $query = "SELECT * from utilisateur WHERE pseudo = '$safe_pseudo' and mot_de_passe = '$hashedPassword'";    
    //$query = "SELECT * from utilisateur WHERE pseudo = '".$_POST['pseudo']."' and mot_de_passe = '".$_POST['password']."'";

    $result=mysqli_query($con,$query);

    if (mysqli_fetch_assoc($result)) {
      $_SESSION['user']=$_POST['pseudo'];
      header("location:index.php");
    }

    else {
      header("location:?erreur= Vos identifiants de connexion sont incorrects");
    }

  }

  else{
    echo "Remplir tous les champs";
  }}

  else {
    header("location:index.php?erreur=captcha invalide");
  }
}

?>

<?php

  if (isset($_GET['logout']))

  {
    session_destroy();
    header("location:index.php");
  }

?>


<?php 
if (isset($_SESSION['user'])) {
  $pseudoq = $_SESSION['user'];
              
              $queryid = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = '$pseudoq'";
              $resultid = mysqli_query($con,$queryid);
              while ($row = mysqli_fetch_assoc($resultid)) {
                    $id_session = $row['id_utilisateur'];
                  }    
}
                ?>




<?php if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check CSRF token on form submission
if (isset($_POST['postsujet'])) {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // Invalid CSRF token, handle error (e.g., log, redirect, or display an error message)
        die('CSRF token validation failed.');
    }

    // Process the form data (save blog post, etc.)
    // ...

    // Regenerate CSRF token for the next form submission
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}?>


<?php
// Set session timeout to 30 minutes (1800 seconds)


/*// Check if the user is logged in and has an active session
if (isset($_SESSION['user'])) {
    // Check the last activity time
    $inactive_timeout = 5; // 30 minutes in seconds
    $current_time = time();

    if (isset($_SESSION['last_activity']) && ($current_time - $_SESSION['last_activity'] > $inactive_timeout)) {
        // Session expired, destroy session and redirect to login page
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    // Update last activity time
    $_SESSION['last_activity'] = $current_time;

    // Your other code for logged-in users goes here...

}*/?>

