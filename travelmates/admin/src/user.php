<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Profil Admin - TravelMates
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include("./sidebar.php") ?>
    <div class="main-panel" id="main-panel">
      <?php include("./navbar.php") ?>

      


      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Modifier profil</h5>
              </div>

              <?php $pseudo = $_SESSION['user'];
              $queryad = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' ";
              $queryadm = mysqli_query($con,$queryad);
              if(!$queryadm){
                    die("QUERY FAILED".mysqli_error($con));
                    }
              while($row = mysqli_fetch_assoc($queryadm)){
                        $id_ut = $row['id_utilisateur'];
                        $pseudo = $row['pseudo'];
                        $nom = $row['nom'];
                        $prenom  = $row['prenom'];
                        $email = $row['email'];
                        $date_naissance = $row['date_naissance'];
                        $mot_de_passe = $row['mot_de_passe'];
                        $num_tel = $row['num_tel'];
                        $pays = $row['pays'];
                        $sexe = $row['sexe'];
                        $role = $row['role']; 
                        $adress = $row['adress'];
                        $zip = $row['zip'];
                        $ville = $row['ville'];
                        $image = $row['img_profil'];  
                        
                        }     

              ?>

              <div class="card-body">
                <form method="post" action="user.php" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Pseudo</label>
                        <input type="text" class="form-control" placeholder="Username" value="<?=$pseudo?>" name="pseudo" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" placeholder="Email" value="<?=$email?>" name="email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Prenom</label>
                        <input type="text" class="form-control" placeholder="Company" value="<?=$prenom?>" name="prenom">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" placeholder="Last Name" value="<?=$nom?>"
                        name="nom">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" class="form-control" placeholder="mot de passe" required="required" name="mdp">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Confirmation du mot de passe</label>
                        <input type="password" class="form-control" placeholder="confirmez votre mot de passe" required="required" name="cmdp">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" class="form-control" placeholder="" value="<?=$date_naissance?>" name="date_naissance">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Sexe</label>
                        <select id="inputSexe" class="form-control" name="sexe">
                        <option selected><?=$sexe?></option>
                        <option>Homme</option>
                        <option>Femme</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" class="form-control" placeholder="Home Address" value="<?=$adress?>" name="adress">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Ville</label>
                        <input type="text" class="form-control" placeholder="City" value="<?=$ville?>" name="ville">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Pays</label>
                        <input type="text" class="form-control" placeholder="Country" value="<?=$pays?>" name="pays">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Code postal</label>
                        <input type="number" class="form-control" placeholder="ZIP Code" value="<?=$zip?>" name="zip">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Numero de telephone</label>
                        <input type="number" class="form-control" value="<?=$num_tel?>" name="num_tel">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Photo de profil</label>
                        <input type="file" class="" value="<?=$image?>" name="img_profil">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <?php if (isset($_GET['msg'])) {
                    ?>
                    <div class="col-md-4 pl-1 text-center"><p style="color: red; margin-top: 10px;">Les mots de passe ne correspondent pas</p></div>
                     <div class="col-md-4 pl-1 text-center">
                      <div class="form-group">
                        <button name="mod" type="submit" class="btn btn-primary">Confirmer</button>
                      </div>
                    </div> <?php } else {  ?>
                    <div class="col-md-12 pl-1 text-center">
                      <div class="form-group">
                        <button name="mod" type="submit" class="btn btn-primary">Confirmer</button>
                      </div>
                    </div><?php }?>
                  </div>
                </form>
              </div>
              
              <?php 
              $pseudoverif = $_SESSION['user'];
              if (isset($_POST['mod'])){

        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mot_de_passe = $_POST['mdp'];
        $mot_de_passe2 = $_POST['cmdp'];
        $date_naissance = $_POST['date_naissance'];
        $num_tel = $_POST['num_tel'];
        $sexe = $_POST['sexe'];
        $pays = $_POST['pays'];
        $role = "user";
        $ville = $_POST['ville'];
        $zip = $_POST['zip'];
        $adress = $_POST['adress'];
        $imgprofil =$_FILES['img_profil']['name'];
        $target = '../../uploads/profil/' . $imgprofil;


        if (move_uploaded_file($_FILES['img_profil']['tmp_name'], $target)) {
          if ($mot_de_passe == $mot_de_passe2) {
          $querymo = "UPDATE utilisateur SET nom='$nom', prenom='$prenom', email='$email',  mot_de_passe='$mot_de_passe', num_tel='$num_tel', date_naissance='$date_naissance', sexe='$sexe', pays='$pays', ville='$ville', zip='$zip', adress='$adress', img_profil = '$imgprofil' WHERE pseudo= '$pseudoverif' ";
        $querymod = mysqli_query($con,$querymo);
        if(!$querymod){
                    die("QUERY FAILED".mysqli_error($con));
                    }
                    header('Location:user.php');
        }

        else{
          
          header('Location:user.php?msg= Les mots de passe ne correspondent pas');
        }
        }

        else {

          if ($mot_de_passe == $mot_de_passe2) {
          $querymo = "UPDATE utilisateur SET nom='$nom', prenom='$prenom', email='$email',  mot_de_passe='$mot_de_passe', num_tel='$num_tel', date_naissance='$date_naissance', sexe='$sexe', pays='$pays', ville='$ville', zip='$zip', adress='$adress' WHERE pseudo= '$pseudoverif' ";
        $querymod = mysqli_query($con,$querymo);
        if(!$querymod){
                    die("QUERY FAILED".mysqli_error($con));
                    }
                    header('Location:user.php');
        }

        else{
          
          header('Location:user.php?msg= Les mots de passe ne correspondent pas');
        }

        }
        
        

        

        }

        ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="../assets/img/bg5.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="<?php echo "../../uploads/profil/".$image?>" alt="...">
                    <h5 class="title"><?php echo $nom . " " . $prenom ?></h5>
                  </a>
                  <p class="description">
                    <?php echo $pseudo?>
                  </p>
                </div>
                <p class="description text-center">
                  Date de naissance : <?php echo $date_naissance?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="../../index.html">
                  TravelMates
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, All rights reserved 
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
</body>

</html>