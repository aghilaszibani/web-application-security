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


    <?php  
  if (isset($_GET['id'])) {
    $id_discussion = $_GET['id'];}
    $query = "SELECT * FROM forum where id_discussion = $id_discussion";
    $result = mysqli_query($con,$query);
                      
 while($ligne = mysqli_fetch_assoc($result)) 
               {
                $sujet = $ligne['sujet'];
                $id_utilisateur = $ligne['id_utilisateur'];
                $texte_discussion = $ligne['texte_discussion'];
                $date_discussion = $ligne['date_discussion'];
                }
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


    

  <main id="main">

    <section class="breadcrumbs" style="margin-top: 120px;">
      <div class="container">

        <h2>Details de la discussion</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry">
              <h1 class="entry-title" >
                <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $sujet ?></a>
              </h1>
              <h6 class="entry-title" style="font-size: 15px;font-weight: normal; text-transform: lowercase;">
                <?php echo $texte_discussion ?>
              </h6>

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

                  <li class="d-flex align-items-center"><img src="<?php echo "uploads/profil/" . $img_profil?>" class="img-circle img-no-padding img-responsive" style="width: 40px;height: 40px;"> &nbsp &nbsp <a href="profilp.php?id=<?php echo $id_utilisateur ?>"><?php echo $nom . " " . $prenom ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $date_discussion ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="forum_single.php?id=<?php echo $id_discussion ?>"><?php echo $nbcom . " "?> Comments</a></li>
                </ul>
              </div>

            </article><!-- End blog entry -->

            <div class="blog-comments">

              <h4 class="comments-count"><?php echo $nbcom ?> Commentaires</h4>

              <?php $commentselect = "SELECT * FROM commentairef WHERE id_publicationf = $id_discussion";
              $cres = mysqli_query($con,$commentselect);
              while($row=mysqli_fetch_assoc($cres)) 
               { $id_commentaire = $row['id_commentairef'];
                 $texte_commentaire = $row['texte_commentairef'];
                 $date_commentaire = $row['date_commentairef'];
                 $id_utilisateur = $row['id_utilisateurf']; 


                 $utilselect = "SELECT pseudo,nom,prenom,img_profil FROM utilisateur where id_utilisateur = '$id_utilisateur' ";
              $resutil = mysqli_query($con,$utilselect);
              while($row=mysqli_fetch_assoc($resutil)) 
               { $img_profil = $row['img_profil'];
               $nom = $row['nom'];
               $prenom = $row['prenom']; }
                ?>

              <div id="comment-1" class="comment clearfix">
                <img src="<?php echo "uploads/profil/" . $img_profil ?>" class="comment-img  float-left" alt="">
                <h5><a href="profilp.php?id=<?php echo $id_utilisateur ?>"><?php echo $nom ?></a></h5>
                <time><?php echo $date_commentaire ?></time>
                <p>
                  <?php echo $texte_commentaire ?>
                </p>
              </div><!-- End comment #1 --><?php } ?>
                

              <?php if (isset($_SESSION['user'])) { ?>
                <div class="reply-form">
                <h4>Commenter la publication</h4>
                <p>Votre adresse email ne sera pas affichée</p>
                <form method="post">
                  
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Votre commentaire" ></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="postc">Poster le commentaire</button>

                </form>

                <?php 

                if (isset($_POST['postc'])) {
                  $text = $_POST['comment'];

                  $reqajout = "INSERT INTO commentairef (id_utilisateurf, id_publicationf, texte_commentairef) VALUES ($id_session, $id_discussion, '$text')";
                  mysqli_query($con,$reqajout);
                  header('Location:forum_single.php?id='. $id_discussion);
                }

                ?>

              </div> <?php } ?>

            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form method="post" action="forum.php">
                  <input type="text" name="forumname">
                  <button type="submit" name="forsearch"><i class="icofont-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->


  </main><!-- End #main -->


    <?php 
  include ("include/footer.php");?>