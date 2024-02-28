



<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <!-- Vendor CSS Files -->
  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets1/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets1/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets1/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets1/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets1/css/style.css" rel="stylesheet">

  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link href="style.css" rel="stylesheet"/>
</head>

<body class="landing-page sidebar-collapse">

<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="5">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="#" rel="tooltip" data-placement="bottom" >
          <img src="assets/img/logosite.png" width="230px" height="35px" class="logosite">
          <style type="text/css">
            @media only screen and (max-width: 600px) {
              .logosite {
                width: 180px;
                height: 25px;
              }
            }
          </style>
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link"> <span class="nvb">Accueil</span> </a>
          </li>
          <li class="nav-item">
            <a href="forum.php" class="nav-link"> <span class="nvb">Forum</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="compagnon_voyage.php" class="nav-link"> <span class="nvb">Compagnon de voyage</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php#carousel" target="" class="nav-link"> <span class="nvb">Destinations</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php#contact" class="nav-link"> <span class="nvb">Contact</span>
            </a>
          </li>

          <?php 
          if (isset($_SESSION['user'])){
            ?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="nvb"><?php echo $_SESSION['user']?></span>
          </a>
          <?php $pseudo = $_SESSION['user'];
           $querya = "SELECT role FROM utilisateur WHERE pseudo = '$pseudo'";
          $queryad = mysqli_query($con,$querya);  

          if(!$queryad){
                    die("QUERY FAILED".mysqli_error($con));
                }
                    while($row = mysqli_fetch_assoc($queryad)){
                      $role = $row['role'];
                    }  ?>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="profil.php">Mon profil</a>
            <?php if ($role == "admin") {?>
            
            <a class="dropdown-item" href="admin/src/user.php">Panneau de configuration admin</a><?php } ?>
            <a class="dropdown-item" href="discussion.php">Mes discussions</a>
            <a class="dropdown-item" href="annonce.php">Mes annonces</a>
            <a class="dropdown-item" href="index.php?logout">Deconnexion</a>
          </div>
        </li>

          <?php
          }
          else{
          ?>

          <li class="nav-item">
            <button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user"></i> Connexion</button>

            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-register">
        <div class="modal-content">
            <div class="modal-header no-border-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              
                <h3 class="modal-title text-center">TravelMates</h3>
                <p>Connectez vous à votre compte</p>
            </div>
            <?php

  if(@$_GET['erreur']==true){

    ?>
      <div class="alert alert-danger text-center" role="alert">
  <?php echo $_GET['erreur']?>
</div>
    <?php

  }

?>
            <div class="modal-body">
              <form method="post">
                <div class="form-group">
                    <label>Pseudo</label>
                <input type="text" value="" placeholder="Pseudo" class="form-control" required="required" name="pseudo" />
              </div>
              <div class="form-group">
                    <label>Mot de passe</label>
                <input type="password" value="" placeholder="Password" class="form-control" required="required" name="password" />
              </div>
                <button type="submit" name="connexion" class="btn btn-block btn-round"> Connexion</button>
                </form>
            </div>
            <div class="modal-footer no-border-footer">
                <span class="text-muted  text-center">Nouveau ? <a href="inscrire.php">creez votre compte</a></span>
            </div>
        </div>
    </div>
</div>
          </li>  

          <?php
          }
          ?>

                
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->