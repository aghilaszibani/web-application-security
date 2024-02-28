<?php 

include("include/session.php");
include("include/header.php"); ?>

<style type="text/css">
	.nvb {
	color: black !important;
	}

	.img2{
		border-radius: 30px;
	}

	.lien{margin-left: 10px;}

</style>


<section class="breadcrumbs" style="margin-top: 120px; background-color:#ccf2f4;">
      <div class="container">

        <h2>Forum</h2>

      </div>
</section>

<section class="breadcrumbs" style="margin-top: 0; background-color:#a4ebf3;">
      <div class="container">

        <h2>Trouver son compagne de voyage</h2>

      </div>
</section>

<div class="container" style="margin-top: 30px;">
<div class="row">

	<div class="col-md-4 firstpost" style="margin-bottom: 30px;">
            <div class="img-post ">
              <img src="gallery/algeria.jpg" style="width: 100%;" class="img-responsive img2">
            </div>
            <a class="" href="compagnon_voyage.php?categorie=Algeria"><h6 class="post-text" style="margin-top: 8px; margin-left: 20px;">Algeria</h6></a>
            
    </div>

    <div class="col-md-4 firstpost" style="margin-bottom: 30px;">
            <div class="img-post ">
              <img src="gallery/Plage.jpg" style="width: 100%;" class="img-responsive img2">
            </div>
            <a href="compagnon_voyage.php?categorie=Plage"><h6 class="post-text" style="margin-top: 8px;margin-left: 20px;">Plage</h6></a>
            
    </div>

    <div class="col-md-4 firstpost" style="margin-bottom: 30px;">
            <div class="img-post ">
              <img src="gallery/motagne.jpg" style="width: 100%;" class="img-responsive img2">
            </div>
            <a href="compagnon_voyage.php?categorie=Montagne"><h6 class="post-text" style="margin-top: 8px;margin-left: 20px;">Montagne</h6></a>
            
    </div>

</div>

<div class="row">

	<div class="col-md-4 firstpost" style="margin-bottom: 30px;">
            <div class="img-post ">
              <img src="gallery/camping.jpg" style="width: 100%;" class="img-responsive img2">
            </div>
            <a href="compagnon_voyage.php?categorie=Camping"><h6 class="post-text" style="margin-top: 8px;margin-left: 20px;">Camping</h6></a>
            
    </div>

    <div class="col-md-4 firstpost" style="margin-bottom: 30px;">
            <div class="img-post ">
              <img src="gallery/velo.jpg" style="width: 100%;" class="img-responsive img2">
            </div>
            <a href="compagnon_voyage.php?categorie=Velo"><h6 class="post-text" style="margin-top: 8px;margin-left: 20px;">Velo</h6></a>
            
    </div>

    <div class="col-md-4 firstpost" style="margin-bottom: 30px;">
            <div class="img-post ">
              <img src="gallery/tour.jpg" style="width: 100%;" class="img-responsive img2">
            </div>
            <a href="compagnon_voyage.php?categorie=Tour du monde"><h6 class="post-text" style="margin-top: 8px;margin-left: 20px;">Tour du monde</h6></a>
            
    </div>

</div>
</div>

 <main id="main">

<!-- ======= Blog Section ======= -->

<section id="blog" class="blog">

  <div class="container" data-aos="fade-up">
  
    <div class="row">
    
      <div class="col-lg-8 entries">
      <article class="entry e1">
      <a href="poster_voyage.php" class="btn btn-secondary">Poster Annonce</a>
        </article>

<?php 

if (isset($_POST['search'])) {
	$destination = $_POST['destination'];
	$query = "SELECT * FROM voyage WHERE (titre_voyage LIKE '%$destination%') OR (categorie LIKE '%$destination%') OR (pays LIKE '%$destination%')";
}

elseif (isset($_GET['categorie'])) {
	$categorie = $_GET['categorie'];
	$query = "SELECT * FROM voyage WHERE (titre_voyage LIKE '%$categorie%') OR (categorie LIKE '%$categorie%') OR (pays LIKE '%$categorie%')";
}

else {

$query = "SELECT * FROM voyage";}

$search_query = mysqli_query($con,$query);

if(!$search_query){
                    die("QUERY FAILED".mysqli_error($connection));
                }

$numrows = mysqli_num_rows($search_query);

if ($numrows > 0) {
	

while ($row = mysqli_fetch_assoc($search_query)) {
	$id_voyage = $row['id_voyage'];
	$titre_voyage = $row['titre_voyage'];
	$id_utilisateur = $row['id_utilisateur'];
	$date_voyage = $row['date_voyage'];
	$pays = $row['pays'];
	$categorie = $row['categorie'];
	$Description_voyage = $row['Description_voyage'];
	$querynbpar = "SELECT * FROM participant WHERE id_voyage = $id_voyage";
          $resnba = mysqli_query($con,$querynbpar);
          $nb_participants = 0;
          while (mysqli_fetch_assoc($resnba)) {
            $nb_participants = $nb_participants + 1;
          }

$utilselect = "SELECT pseudo,nom,prenom,img_profil FROM utilisateur where id_utilisateur = '$id_utilisateur' ";
              $resutil = mysqli_query($con,$utilselect);
              while($row=mysqli_fetch_assoc($resutil)) 
               { $pseudo = $row['pseudo'];
               $nom = $row['nom'];
               $prenom = $row['prenom'];
               $img_profil = $row['img_profil']; }
?>

<article class="entry">

          

                        <h2 class="entry-title">
                        <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $titre_voyage;  ?></a>
                        </h2>
              
                        <div class="entry-meta">
                          <ul>
                            <li class="d-flex align-items-center"><img src="<?php echo "uploads/profil/" . $img_profil ?>" class="img-circle img-no-padding img-responsive" style="width: 40px;height: 40px;"> &nbsp &nbsp <a href="profilp.php?id=<?php echo $id_utilisateur ?>"><?php echo $nom . " " . $prenom?></a></li>
                            <li class="d-flex align-items-center">Depart le:<i class="icofont-wall-clock"></i> <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><time datetime="2020-01-01">(<?php echo $date_voyage;  ?>)</time></a></li>
                            <li class="d-flex align-items-center">Participant:<a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $nb_participants;  ?></a></li>
                            <!--<li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">12 Comments</a></li>-->
                          </ul>
                          <ul>
                            <li style="margin-top: 5px;" class="d-flex align-items-center"><a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $pays;  ?></a></li>
                            <li style="margin-top: 5px;" class="d-flex align-items-center">Categorie : <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo " " . " " . $categorie;  ?></time></a></li>
                          </ul>
                        </div>
              
                      </article><!-- End blog entry -->
                  

<?php
}} 
if ($numrows == 0){ echo "<h3>Pas de resultats</h3>"; }

?> 

</div>
<div class="col-lg-4 reherche">
      
      <div class="sidebar">
      
        <h3 class="sidebar-title">Search</h3>
        <div class="sidebar-item search-form">
          <form action="" method="post">
            <input type="text" name="destination">
            <button type="submit" name="search"><i class="icofont-search"></i></button>
          </form>
        </div><!-- End sidebar search formn-->

      </div><!-- End sidebar -->


      </div><!-- End blog sidebar -->    

      </div>

      </div>
    </section><!-- End Blog Section -->



  </main><!-- End #main -->














<?php include("include/footer.php"); ?>