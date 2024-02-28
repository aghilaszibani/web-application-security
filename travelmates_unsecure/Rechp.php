<?php
include("include/session.php");
?>
  <!-- Navbar -->
<?php 
include ("include/header.php");?>
  <!-- End Navbar -->


  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>







    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog" style=" margin-top:50px;   background-color:white;">
      <div class="container" data-aos="fade-up">


        <article class="entry">
        <div class="row">
          <div class="col-lg-6 entries">
            <h3 class="entry-title">résultats de la recherche...
            </h3>
          </div>
        </div>
        </article>


        <div class="row">

          <div class="col-lg-8 entries">
                <!-- partie PHP -->
        <?php


                         if (isset($_POST['btsubmit'])) 
                         {
 $tit=$_POST['titre'];

 $reqSelect= "SELECT * FROM publication WHERE (titre_publication = '$tit' ) ";

                           }


                                $resultat=mysqli_query($con,$reqSelect);
                               
   if(mysqli_num_rows($resultat) > 0){                   
 while($ligne=mysqli_fetch_assoc($resultat)) 
               {
    ?>

            <article class="entry">




              <div class="entry-img">
                   <img src="<?php echo $ligne['img_publication'] ?>"  class="img-fluid" alt="" />
              </div>

              <h2 class="entry-title">
               <?php echo $ligne['titre_publication'] ?>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> 
                    <?php echo $ligne['date_publication'] ?>
                  </li>

                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">12 Commentaires</a>
                  </li>
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?php   echo $ligne['description_publication'] ?>
                </p>

                <div class="read-more">
                      <form action="Rech&Comp.php" method="post">
                <input type="hidden" name="sh" value=<?php echo $ligne['id_publication'] ?> >
 
                 <button type="submit" name="show">Plus d'informations </button> </form>
                </div>

              </div>

            
            </article><!-- End blog entry -->
                 <?php  }  }
                    else 
                           
                  echo  "<script> alert('Precisez votre recherche'); window.location='index.php'</script>";
                     ?>
    <!-- End partie PHP -->

            
        </div>


        </div><!-- End blog entries list -->

      
      </div>
    </section><!-- End Blog Section -->



<?php 
  include ("include/footer.php");?>


</body>
</html>