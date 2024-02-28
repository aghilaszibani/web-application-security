<!DOCTYPE html>

<html lang="en">
  <?php
            include("cnx.php");

             session_start();
              
                       if(isset($_SESSION['user']))  
                   {  

                  // recuperation du groupe de ce client *******************
                  $npsid=$_SESSION['user']; 
                  $sqlinf="SELECT * FROM `utilisateur` where id_utilisateur = '$npsid'";
                  $resinf = $conn->query($sqlinf);
                  $rowinf = $resinf->fetch_assoc();

                  //********************************

                  }



               $sujet = $_GET["id"];
              $sqlsd = "SELECT * FROM `discussion` where sujet = '$sujet' ";
              $resultsd = $conn->query($sqlsd);
              $rowsd = $resultsd->fetch_assoc();
              $id_discussion = $rowsd["id_discussion"];

    if (isset($_POST["pocomment"])) {
        
        $id_utilisateur = $npsid;        
        $texte_sd = $_POST["comment"];
        $date_sd = date("y-m-d");
        $heure_sd = date("h:i");
        $reqins="INSERT INTO sous_discussion (id_discussion,id_utilisateur,texte_sd,date_sd,heure_sd) VALUES ('$id_discussion','$id_utilisateur','$texte_sd','$date_sd','$heure_sd') ";
        $resins = $conn->query($reqins);
     
              if ($resins === TRUE) {
                //echo "New record created successfully";
              } else {
                echo "Error: " . $reqins . "<br>" . $conn->error;
              }

              

    }

    //echo $_GET["id"];

  ?>

  <?php include("header.php"); ?>


  <main id="main">

    <section class="breadcrumbs" style="margin-top: 120px;">
      <div class="container">

        <h2>Forum single</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

             <?php

              $sql = "SELECT COUNT(id_sd) as nb_cmnt FROM `sous_discussion` where id_discussion = '$id_discussion' ";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();

                  $npsinf = $rowsd["id_utilisateur"];   
                  $sqlinf2="SELECT * FROM `utilisateur` where id_utilisateur ='$npsinf'";
                  $resinf2 = $conn->query($sqlinf2);
                  $rowinf = $resinf2->fetch_assoc();

            echo '<article class="entry entry-single">

              <h2 class="entry-title">
                <a href="">'.$rowsd["sujet"].'</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><img src="assets1/img/blog/'.$rowinf["nom"].'.jpg" class="img-circle img-no-padding img-responsive" style="width: 40px;height: 40px;"> &nbsp &nbsp <a href="forum_single.html">'.$rowinf["nom"].' '.$rowinf["prenom"].'</a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">'.$rowsd["date_discussion"].'  '.$rowsd["heure_discussion"].'</time></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">'.$row["nb_cmnt"].' Comments</a></li>
                </ul>
              </div>

              <div class="entry-content">
                <p style="border-top:1px solid #eeeee4">'.$rowsd["texte_discussion"].'</p>

            </article>'; ?>

            <!-- End blog entry -->


            <div class="blog-comments">

              <?php

              /*$sql = "SELECT COUNT(id_sd) as nb_cmnt FROM `sous_discussion` where id_discussion = '$id_discussion' ";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();*/
              echo '<h4 class="comments-count">'.$row["nb_cmnt"].'  Comments</h4>';

              $sql1 = "SELECT * FROM `sous_discussion` where id_discussion = '$id_discussion' ";
              $result1 = $conn->query($sql1);

              if ($result1->num_rows > 0) { 
                // output data of each row
                while($row1 = $result1->fetch_assoc()) {

                  $npsinf = $row1["id_utilisateur"];   
                  $sqlinf2="SELECT * FROM `utilisateur` where id_utilisateur ='$npsinf'";
                  $resinf2 = $conn->query($sqlinf2);
                  $rowinf = $resinf2->fetch_assoc();

              echo '<div id="comment-1" class="comment clearfix">
                <img src="assets1/img/blog/'.$rowinf["nom"].'.jpg" class="comment-img  float-left" alt="">
                <h5><a href="">'.$rowinf["nom"].' '.$rowinf["prenom"].'</a> </h5>
                <time datetime="2020-01-01">'.$row1["date_sd"].'  '.$row1["heure_sd"].'</time>
                <p>'.$row1["texte_sd"].'</p>
              </div>';}}

              ?>

              <!-- End comment #1 -->
              <?php
              if(isset($_SESSION['user']))  
                   {  
              echo '<div class="reply-form">
                <h4>Leave a Reply</h4>
                <p>Your email address will not be published. Required fields are marked * </p>
                <form method="Post" >
                  
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                    </div>
                  </div>
                  <button type="submit" name="pocomment" class="btn btn-primary">Post Comment</button>


                </form>

              </div>';}else{
                 echo '<div class="reply-form">
                <h4>Leave a Reply</h4>
                <p></p>
                <form method="Post" >
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Post Comment</button>
                </form>

              </div>';
              }
              ?>
            </div><!-- End blog comments -->

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
    </section><!-- End Blog Single Section -->

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
