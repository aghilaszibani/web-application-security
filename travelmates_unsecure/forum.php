<?php
include("include/session.php");
?>
  <!-- Navbar -->
<?php 
include ("include/header.php");?>
  <!-- End Navbar -->
<style type="text/css">
  .nvb {
  color: black !important;
}
</style>

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

      <?php if (isset($_POST['forsearch'])) { 

      $textsujet = $_POST['forumname'];

     ?>
          <?php  $reqSelect= "SELECT * FROM forum WHERE sujet LIKE '%$textsujet%' ";

$resultat=mysqli_query($con,$reqSelect);
                               
   if(mysqli_num_rows($resultat) > 0){                   
 while($ligne=mysqli_fetch_assoc($resultat)) 
               {
                $id_discussion = $ligne['id_discussion'];
                $id_utilisateur = $ligne['id_utilisateur'];
                $texte_discussion = $ligne['texte_discussion'];
                $date_discussion = $ligne['date_discussion'];
                $sujet = $ligne['sujet'];
    ?>

            <article class="entry">
              <h2 class="entry-title">
                <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $sujet ?></a>
              </h2>

              <div class="entry-meta">
                <ul>

              <?php 
              $nbcom = 0;
              $commentselect = "SELECT * FROM commentairef WHERE id_publicationf = $id_discussion";
              $cres = mysqli_query($con,$commentselect);
              while($row=mysqli_fetch_assoc($cres)) 
               { $nbcom = $nbcom + 1; }


              $utilselect = "SELECT pseudo,nom,prenom,img_profil FROM utilisateur where id_utilisateur = '$id_utilisateur' ";
              $resutil = mysqli_query($con,$utilselect);
              while($row=mysqli_fetch_assoc($resutil)) 
               { $pseudo = $row['pseudo'];
               $nom = $row['nom'];
               $prenom = $row['prenom'];
               $img_profil = $row['img_profil']; }

              ?>

                  <li class="d-flex align-items-center"><img src="<?php echo "uploads/profil/" . $img_profil?>" class="img-circle img-no-padding img-responsive" style="width: 40px;height: 40px;"> &nbsp &nbsp <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $nom . " " . $prenom ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $date_discussion ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $nbcom . " "?> Comments</a></li>
                </ul>
              </div>

            </article><!-- End blog entry -->

          <?php }}}  else { ?>          


          <?php  $reqSelect= "SELECT * FROM forum";

$resultat=mysqli_query($con,$reqSelect);
                               
   if(mysqli_num_rows($resultat) > 0){                   
 while($ligne=mysqli_fetch_assoc($resultat)) 
               {
                $id_discussion = $ligne['id_discussion'];
                $id_utilisateur = $ligne['id_utilisateur'];
                $texte_discussion = $ligne['texte_discussion'];
                $date_discussion = $ligne['date_discussion'];
                $sujet = $ligne['sujet'];
    ?>

            <article class="entry">
              <h2 class="entry-title">
                <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $sujet ?></a>
              </h2>

              <div class="entry-meta">
                <ul>

              <?php 
              $nbcom = 0;
              $commentselect = "SELECT * FROM commentairef WHERE id_publicationf = $id_discussion";
              $cres = mysqli_query($con,$commentselect);
              while($row=mysqli_fetch_assoc($cres)) 
               { $nbcom = $nbcom + 1; }


              $utilselect = "SELECT pseudo,nom,prenom,img_profil FROM utilisateur where id_utilisateur = '$id_utilisateur' ";
              $resutil = mysqli_query($con,$utilselect);
              while($row=mysqli_fetch_assoc($resutil)) 
               { $pseudo = $row['pseudo'];
               $nom = $row['nom'];
               $prenom = $row['prenom'];
               $img_profil = $row['img_profil']; }

              ?>

                  <li class="d-flex align-items-center"><img src="<?php echo "uploads/profil/" . $img_profil?>" class="img-circle img-no-padding img-responsive" style="width: 40px;height: 40px;"> &nbsp &nbsp <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $nom . " " . $prenom ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $date_discussion ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $nbcom . " "?> Comments</a></li>
                </ul>
              </div>

            </article><!-- End blog entry -->

          <?php }}} ?>
          <?php if (isset($_SESSION['user'])) { ?>
            <div class="reply-form">
                <h4>Creez une discussion</h4>
                <p>Votre adresse email ne sera pas affichée</p>
                <form method="post" action="forumpost.php">
                  
                  <div class="row">
                    <div class="col-12 form-group">
                      <input type="text" name="sujet" class="form-control" placeholder="Sujet" ></textarea>
                    </div>
                    <div class="col-12 form-group">
                      <textarea name="text_sujet" class="form-control" placeholder="Texte du sujet" ></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="postsujet">Creer la discussion</button>

                </form>

              </div>
       <?php   } ?>
          

            

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form method="post">
                  <input type="text" name="forumname">
                  <button type="submit" name="forsearch"><i class="icofont-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->



  </main><!-- End #main -->

  



  <?php 
  include ("include/footer.php");?>
  
</body>

</html>
