 <main id="main">

<!-- ======= Blog Section ======= -->

<section id="blog" class="blog">

  <div class="container" data-aos="fade-up">
  
    <div class="row">
    
      <div class="col-lg-8 entries">
      <article class="entry e1">
      <button type="button" class="btn btn-secondary voyage"><a href="poster_voyage.php">Poster Annonce</a></button>
        </article>

<?php 

$query = "SELECT * FROM voyage";

$search_query = mysqli_query($con,$query);

if(!$search_query){
                    die("QUERY FAILED".mysqli_error($connection));
                }

while ($row = mysqli_fetch_assoc) {
	$id_voyage = $row['id_voyage'];
	$titre_voyage = $row['titre_voyage'];
	$id_utilisateur = $row['id_utilisateur'];
	$date_voyage = $row['date_voyage'];
	$pays = $row['pays'];
	$categorie = $row['categorie'];
	$Description_voyage = $row['Description_voyage'];
	$nb_participants = $row['nb_participants'];
?>

<article class="entry">

          

                        <h2 class="entry-title">
                        <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $titre_voyage;  ?></a>
                        </h2>
              
                        <div class="entry-meta">
                          <ul>
                            <li class="d-flex align-items-center"><i class="icofont-user"></i><a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $id_utilisateur;  ?></a></li>
                            <li class="d-flex align-items-center">Depart le:<i class="icofont-wall-clock"></i> <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><time datetime="2020-01-01">(<?php echo $date_voyage;  ?>)</time></a></li>
                            <li class="d-flex align-items-center">Participant:<a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $nb_participants;  ?></a></li>
                            <!--<li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">12 Comments</a></li>-->
                          </ul>
                          <ul>
                            <li class="d-flex align-items-center">* <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $pays;  ?></a></li>
                            <li class="d-flex align-items-center">categorie : <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $categorie;  ?></time></a></li>
                          </ul>
                        </div>
              
                        <div class="entry-content">
                         
                          <div class="read-more">
                              <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>">Participer</a>
                          </div>
                        </div>
              
                      </article><!-- End blog entry -->

<?php
}}

?> 


<div class="col-lg-4 reherche">
      
      <div class="sidebar">
      
        <h3 class="sidebar-title">Search</h3>
        <div class="sidebar-item search-form">
          <form action="">
            <input type="text" name="destination">
            <button type="submit" name="search"><i class="icofont-search"></i></button>
          </form>
        </div><!-- End sidebar search formn-->

        <h3 class="sidebar-title">Preparer son voyage</h3>
        <div class="sidebar-item categories">
          <ul>
            <li><a href="#">Vol <span>(25)</span></a></li>
            <li><a href="#">Hotel <span>(12)</span></a></li>
            <li><a href="#">Voiture <span>(5)</span></a></li>
       
          </ul>
        </div><!-- End sidebar categories-->

      </div><!-- End sidebar -->


      </div><!-- End blog sidebar -->       