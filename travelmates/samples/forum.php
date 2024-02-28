<!DOCTYPE html>

<html lang="en">
    <?php
            include("cnx.php");
             session_start();
           
                       if(isset($_SESSION['user']))  
                   {  

                  // recuperation du groupe de ce client *******************
                 
                  $npsid= $_SESSION['user'];
                  $sqlinf="SELECT * FROM `utilisateur` where id_utilisateur='$npsid'";
                  $resinf = $conn->query($sqlinf);
                  $rowinf = $resinf->fetch_assoc();

                  //********************************

                  }else{
                     //header("location:index.php");
                  }


  if(isset($_POST["poster"])){

      
        $id_utilisateur = $npsid;
        $texte_discussion = $_POST["commentaire"];
        $date_discussion = date("y-m-d");
        $heure_discussion = date("h:i");
        $sujet = $_POST["sujet"];
        $req="INSERT INTO discussion (id_utilisateur,texte_discussion,date_discussion,heure_discussion,sujet) VALUES ('$id_utilisateur','$texte_discussion','$date_discussion','$heure_discussion','$sujet') ";
        $resins = $conn->query($req);
     
              if ($resins === TRUE) {
                //echo "New record created successfully";
              } else {
                echo "Error: " . $req . "<br>" . $conn->error;
              }

              
  }

    ?>

<?php include("header.php"); ?>


  <main id="main">

    <section class="breadcrumbs" style="margin-top: 120px;">
      <div class="container">

        <h2>Forum</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

                          <article class="entry" >
              <div class="reply-form">
              <?php  

                   if(isset($_SESSION['user']))  
                   {  
                  echo '<button type="button" style="margin-top: -3%" name="poster" class="btn btn-primary float-right"data-toggle="modal"data-target="#Modalcomment">Céer Une Discussion </button>';
                }else{
                  echo '<button type="button" style="margin-top: -3%" name="poster" class="btn btn-primary float-right"data-toggle="modal"data-target="#loginModal">Céer Une Discussion </button>';
                }
                ?>
              </div>
             </article><!-- End blog entry -->

            <?php


              $sql = "SELECT * FROM `discussion`";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {


                                             $npsinf = $row["id_utilisateur"];
                                             $sqlinf2="SELECT * FROM `utilisateur` where id_utilisateur ='$npsinf'";
                                             $resinf2 = $conn->query($sqlinf2);
                                             $rowinf = $resinf2->fetch_assoc();


                   $id_disc = $row["id_discussion"];
                   $sqln = "SELECT COUNT(id_sd) as nb_cmnt FROM `sous_discussion` where id_discussion = '$id_disc' ";
                   $resultn = $conn->query($sqln);
                   $rown = $resultn->fetch_assoc();

                
                    echo '<article class="entry">
              <h2 class="entry-title">
                <a href="forum_single.php?id='.$row["sujet"].'">'.$row["sujet"].'</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><img src="assets1/img/blog/'.$rowinf["nom"].'.jpg" class="img-circle img-no-padding img-responsive" style="width: 40px;height: 40px;"> &nbsp &nbsp 
                    <a href="forum_single.php">'.$rowinf["nom"].' '.$rowinf["prenom"].'</a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> 
                  <a href="forum_single.php"><time datetime="2020-01-01">'.$row["date_discussion"].' '.$row["heure_discussion"].'</time></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> 
                  <a href="forum_single.php?id='.$row["sujet"].'">'.$rown["nb_cmnt"].' Comments</a></li>
                </ul>
              </div>

            </article>';  

                }
              } else {
                echo "0 results";
              }
              $conn->close();
            //<!-- End blog entry -->
            ?>






                                        <!-- Modal -->
                          <div class="modal fade" id="Modalcomment" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                                <article class="entry">
                                <div class="reply-form">
                                  <h4>Start a new Subject</h4> 
                                  <p>Your email address will not be published. Required fields are marked * </p>
                                  <form method="Post">
                                    
                                    <div class="row">
                                      <div class="col form-group">
                                        <input type="text" name="sujet" class="form-control" placeholder="Your Subject" required="">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col form-group">
                                        <textarea  name="commentaire" class="form-control" placeholder="Description"></textarea>
                                      </div>
                                    </div>
                                    <button type="submit" name="poster" class="btn btn-primary">Créer Une Discussion</button>

                                  </form>

                                </div>
                                </div>
                                            </article><!-- End blog entry -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

          


          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="icofont-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  <li><a href="forum.html" style="font-weight: bold;">Afrique <span>(25)</span></a></li>
                  <li><a href="forum.html" style="font-weight: bold;">Europe <span>(12)</span></a></li>
                  <li><a href="forum.html" style="font-weight: bold;">Ameriques <span>(5)</span></a></li>
                  <li><a href="forum.html" style="font-weight: bold;">Oceanie <span>(22)</span></a></li>
                  <li><a href="forum.html" style="font-weight: bold;">Asie <span>(8)</span></a></li>
                </ul>
              </div><!-- End sidebar categories-->

             

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  
  <footer class="footer   footer-white ">
    <div class="container">
      <div class="row">
        <nav class="footer-nav">
          <ul>
            <li>
              <a href="index.html" >TravelMates</a>
            </li>
            
          </ul>
        </nav>
        <div class="credits ml-auto">
          <span class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script>, All right reserved
          </span>
        </div>
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->


  <!-- Vendor JS Files -->
  <script src="assets1/vendor/jquery/jquery.min.js"></script>
  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets1/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>
  <script src="assets1/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets1/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets1/vendor/counterup/counterup.min.js"></script>
  <script src="assets1/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets1/vendor/venobox/venobox.min.js"></script>
  <script src="assets1/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets1/js/main.js"></script>


  
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>



  
</body>

</html>
