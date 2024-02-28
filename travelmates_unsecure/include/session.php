<?php ob_start();
session_start();
include("include/database.php");



if (isset($_POST['connexion'])){

  if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
    $hashedPassword = sha1($_POST['password']);

    $query = "SELECT * from utilisateur WHERE pseudo = '".$_POST['pseudo']."' and mot_de_passe = '".$_POST['password']."'";

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

