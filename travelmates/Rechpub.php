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
        <?php $title = $_POST['titre'];
        $sanitized_title = mysqli_real_escape_string($con, $_POST['titre']); ?>
        <h2>Resultats de la recherche <?php echo $title;?></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <?php if (isset($_SESSION['user'])) { ?>
<a href="AjoutPub.php" class="btn btn-danger" style="margin-bottom: 30px;">Poster un publication</a>  <?php } ?>

        <div class="row">

          <div class="col-lg-8 entries">

          	<?php


                         if (isset($_POST['btsubmit'])) 
                         {
 $tit=$_POST['titre'];

 $reqSelect= "SELECT * FROM publication WHERE (titre_publication LIKE '%$tit%') ";

                           }


                                $resultat=mysqli_query($con,$reqSelect);
                               
   if(mysqli_num_rows($resultat) > 0){                   
 while($ligne=mysqli_fetch_assoc($resultat)) 
               {
               	$id_publication = $ligne['id_publication'];
    ?>

            <article class="entry">

              <div class="entry-img">
                <img src="<?php echo "uploads/publication/" . $ligne['img_publication']?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="Rechp_single.php?id=<?php echo$id_publication ?>"><?php echo $ligne['titre_publication']?></a>
              </h2>

              <?php 
              $id_utilisateur = $ligne['id_utilisateur'];
              $nbcom = 0;
              $commentselect = "SELECT * FROM commentaire WHERE id_publication = $id_publication";
              $cres = mysqli_query($con,$commentselect);
              while($row=mysqli_fetch_assoc($cres)) 
               { $nbcom = $nbcom + 1; }


              $utilselect = "SELECT pseudo,nom,prenom FROM utilisateur where id_utilisateur = '$id_utilisateur' ";
              $resutil = mysqli_query($con,$utilselect);
              while($row=mysqli_fetch_assoc($resutil)) 
               { $pseudo = $row['pseudo'];
               $nom = $row['nom'];
               $prenom = $row['prenom']; }

              ?>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="Rechp_single.php?id=<?php echo$id_publication ?>"><?php echo $nom . " " . $prenom?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="Rechp_single.php?id=<?php echo$id_publication ?>"><?php echo $ligne['date_publication']?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="Rechp_single.php?id=<?php echo$id_publication ?>"><?php echo $nbcom; ?></a></li>
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?php echo $ligne['description_publication']?>
                </p>
                <div class="read-more">
                  <a href="Rechp_single.php?id=<?php echo$id_publication ?>">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->

            <?php  }  }
                    else {

                       ?>
                         <article class="entry">
                         	<div class="row">           		
             <h1 class="col-5" style="margin:0; font-size: 30px;">Pas de resultats</h1>
             <a href="index.php" class="btn btn-round btn-warning">Retourner vers la recherche</a>
             </div>
            </article><!-- End blog entry -->
                     <?php }
                     ?>

            

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
    </section><!-- End Blog Section -->

  </main><!-- End #main -->




















  <?php 
  include ("include/footer.php");?>
</body>

</html>