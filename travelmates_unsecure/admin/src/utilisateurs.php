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
    Utilisateur - TravelMates
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

<body class="">
  <div class="wrapper ">
    <?php include("./sidebar.php") ?>
    <div class="main-panel" id="main-panel">
      <?php include("./navbar.php") ?>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Gestions des utilisateurs</h4>
                <a href="ajouter_admin.php"><button class="btn btn-primary">Ajouter un administrateur</button></a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Pseudo
                      </th>
                      <th>
                        Nom
                      </th>
                      <th>
                        Prenom
                      </th>
                      <th>
                        Email
                      </th>
                      <th>
                        Numero de téléphone
                      </th>
                      <th>
                        Pays
                      </th>
                      <th>
                        Sexe
                      </th>
                      <th>
                        Role
                      </th>
                      <th class="text-right">
                        Bannir
                      </th>
                    </thead>
                    <tbody>
                    <?php 

                      $queryu = "SELECT * FROM utilisateur";
                      $queryut = mysqli_query($con,$queryu);
                      if(!$queryut){
                    die("QUERY FAILED".mysqli_error($con));
                    }

                    while($row = mysqli_fetch_assoc($queryut)){
                        $id_ut = $row['id_utilisateur'];
                        $pseudo = $row['pseudo'];
                        $nom = $row['nom'];
                        $prenom  = $row['prenom'];
                        $email = $row['email'];
                        $num_tel = $row['num_tel'];
                        $pays = $row['pays'];
                        $sexe = $row['sexe'];
                        $role = $row['role'];

                        if ($pseudo <> $_SESSION['user']) {
                          # code...
                        

                    ?>
                    
                      <tr>
                        <td>
                          <?php echo $pseudo ?>
                        </td>
                        <td>
                          <?php echo $nom ?>
                        </td>
                        <td>
                          <?php echo $prenom ?>
                        </td>
                        <td>
                          <?php echo $email ?>
                        </td>
                        <td>
                          <?php echo $num_tel ?>
                        </td>
                        <td>
                          <?php echo $pays ?>
                        </td>
                        <td>
                          <?php echo $sexe ?>
                        </td>
                        <td>
                          <?php echo $role ?>
                        </td>
                        <td class="text-right">
                          <a href="ban.php?id=<?php echo $id_ut?>" class="btn btn-danger">Bannir</a>
                        </td>
                      </tr> 

                      <?php }} ?>                    
                    </tbody>
                  </table>
                </div>
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