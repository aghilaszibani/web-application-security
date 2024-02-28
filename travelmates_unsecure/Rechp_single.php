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
    $id_publication = $_GET['id'];}
    $query = "SELECT * FROM publication where id_publication = $id_publication";
    $result = mysqli_query($con,$query);
                      
 while($ligne = mysqli_fetch_assoc($result)) 
               {
                $titre_publication = $ligne['titre_publication'];
                $id_utilisateur = $ligne['id_utilisateur'];
                $description_publication = $ligne['description_publication'];
                $id_publication = $ligne['id_publication'];
                $date_publication = $ligne['date_publication'];
                $img_publication = $ligne['img_publication'];
                $img_publication2 = $ligne['image_pub2'];
                $img_publication3 = $ligne['image_pub3'];
                $comment_pub = $ligne['comment_pub'];}
                $nbcom = 0;
              $commentselect = "SELECT * FROM commentaire WHERE id_publication = $id_publication";
              $cres = mysqli_query($con,$commentselect);
              while($row=mysqli_fetch_assoc($cres)) 
               { $nbcom = $nbcom + 1; }

    ?>
    

  <main id="main">

    <section class="breadcrumbs" style="margin-top: 120px;">
      <div class="container">

        <h2>Details de la publication</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">
              <div class="owl-carousel portfolio-details-carousel">
                <?php if (isset($img_publication)) {
                  
                ?>
            <img src="<?php echo "uploads/publication/" . $img_publication ?>" class="img-fluid" alt=""> <?php } ?>
            <?php if ($img_publication2 !== "") {
                  
                ?>
            <img src="<?php echo "uploads/publication/" . $img_publication2 ?>" class="img-fluid" alt=""> <?php } ?>

            <?php if ($img_publication3 !== "") {
                  
                ?>
            <img src="<?php echo "uploads/publication/" . $img_publication3 ?>" class="img-fluid" alt=""> <?php } ?>
            
          </div>
              

              <h2 class="entry-title">
                <a href=""><?php echo $titre_publication ?></a>
              </h2>
              <?php $querynom = "SELECT nom,prenom FROM utilisateur where id_utilisateur = '$id_utilisateur' ";
              $resultnom = mysqli_query($con,$querynom);
              while ($rown = mysqli_fetch_assoc($resultnom)) {
                $nom_pub = $rown['nom'];
                $prenom_pub = $rown['prenom'];
              }

              ?>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="profilp.php?id=<?php echo $id_utilisateur ?>"><?php echo $nom_pub . " " . $prenom_pub ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href=""><time datetime="2020-01-01"><?php echo $date_publication ?></time></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href=""><?php echo $nbcom ?></a></li>
                </ul>
              </div>

              <div class="entry-content">
                
                <p>
                  <?php echo $description_publication ?>
                </p>

                <blockquote>
                  <i class="icofont-quote-left quote-left"></i>
                  <p>
                    <?php echo $comment_pub ?>
                  </p>
                  <i class="las la-quote-right quote-right"></i>
                  <i class="icofont-quote-right quote-right"></i>
                </blockquote>

              </div>

              

            </article><!-- End blog entry -->

            <div class="blog-comments">

              <h4 class="comments-count"><?php echo $nbcom ?> Commentaires</h4>

              <?php $commentselect = "SELECT * FROM commentaire WHERE id_publication = $id_publication";
              $cres = mysqli_query($con,$commentselect);
              while($row=mysqli_fetch_assoc($cres)) 
               { $id_commentaire = $row['id_commentaire'];
                 $texte_commentaire = $row['texte_commentaire'];
                 $date_commentaire = $row['date_commentaire'];
                 $id_utilisateur = $row['id_utilisateur']; 


                 $utilselect = "SELECT pseudo,nom,prenom,img_profil FROM utilisateur where id_utilisateur = '$id_utilisateur' ";
              $resutil = mysqli_query($con,$utilselect);
              while($row=mysqli_fetch_assoc($resutil)) 
               { $img_profil = $row['img_profil'];
               $nom = $row['nom'];
               $prenom = $row['prenom']; }
                ?>

              <div id="comment-1" class="comment clearfix">
                <img src="<?php echo "uploads/profil/" . $img_profil ?>" class="comment-img  float-left" alt="">
                <h5><a href="profilp.php?id=<?php echo $id_utilisateur ?>"><?php echo $nom . " " . $prenom ?></a></h5>
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
                      <textarea name="comment" class="form-control" placeholder="Votre commentaire"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="postc">Poster le commentaire</button>

                </form>

                <?php 

                if (isset($_POST['postc'])) {
                  $text = $_POST['comment'];

                  $reqajout = "INSERT INTO commentaire (id_utilisateur, id_publication, texte_commentaire) VALUES ($id_session, $id_publication, '$text')";
                  mysqli_query($con,$reqajout);
                  header('Location:Rechp_single.php?id='. $id_publication);
                }

                ?>

              </div>
             <?php } ?>
                

            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="Rechpub.php" method="post">
                  <input type="text" name="titre">
                  <button type="submit" name="btsubmit"><i class="icofont-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">
                <?php $query = "SELECT * FROM publication ORDER BY id_publication DESC LIMIT 5";

    $result = mysqli_query($con,$query);
                
                if(!$result){
                    die("QUERY FAILED".mysqli_error($con));
                }
                
                
                    
                    while($row = mysqli_fetch_assoc($result)){
                        $id_publication = $row['id_publication'];
                        $id_utilisateur  = $row['id_utilisateur'];
                        $titre_publication = $row['titre_publication'];
                        $date_publication = $row['date_publication'];
                        $description_publication = $row['description_publication'];
                        $img_publication = $row['img_publication'];

                    $pquery = "SELECT pseudo FROM utilisateur where id_utilisateur = $id_utilisateur";
                    $psquery = mysqli_query($con,$pquery);  
                    while($row = mysqli_fetch_assoc($psquery)){
                      $pseudo = $row['pseudo'];
                    }
                      
            ?>
                <div class="post-item clearfix">
                  <img src="<?php echo "uploads/publication/" . $img_publication ?>" alt="">
                  <h4><a href="Rechp_single.php?id=<?php echo$id_publication ?>"><?php echo $titre_publication ?></a></h4>
                  <time datetime="2020-01-01"><?php echo $date_publication ?></time>
                </div>
            <?php } ?>    
                

              </div><!-- End sidebar recent posts-->

             

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->


  </main><!-- End #main -->


    <?php 
  include ("include/footer.php");?>