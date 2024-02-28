<?php
include("include/session.php");
?>
  <!-- Navbar -->
<?php 
include ("include/header.php");?>


<style type="text/css">
	.nvb {
	color: black !important;
}
</style>

<?php if (isset($_GET['id_voyage'])) {
  $id_voyage = $_GET['id_voyage'];}  
  $queryvoyage ="SELECT * FROM voyage WHERE id_voyage = $id_voyage ";
  $search_queryv =mysqli_query($con,$queryvoyage); 
      while($row = mysqli_fetch_assoc($search_queryv)){
          $id_voyage = $row['id_voyage'];
          $id_utilisateur = $row['id_utilisateur'];
          $titre_voyage = $row['titre_voyage'];
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
 
      }

  ?>

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

<!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <h2 class="entry-title">
                <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $titre_voyage ?></a>
              </h2>

  <?php            $utilselect = "SELECT pseudo,nom,prenom,img_profil FROM utilisateur where id_utilisateur = '$id_utilisateur' ";
              $resutil = mysqli_query($con,$utilselect);
              while($row=mysqli_fetch_assoc($resutil)) 
               { $pseudo = $row['pseudo'];
               $nom = $row['nom'];
               $prenom = $row['prenom'];
               $img_profil = $row['img_profil']; }
?>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><img src="<?php echo "uploads/profil/" . $img_profil ?>" class="img-circle img-no-padding img-responsive" style="width: 40px;height: 40px;"> &nbsp &nbsp <a href="profilp.php?id=<?php echo $id_utilisateur ?>"><?php echo $nom . " " . $prenom?></a></li>
                  <li class="d-flex align-items-center">Depart le:<i class="icofont-wall-clock"></i> <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><time datetime="2020-01-01">(<?php echo $date_voyage;  ?>)</time></a></li>
                  <li class="d-flex align-items-center">Participant:<a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $nb_participants;  ?></a></li>
                </ul>
                <ul>
                            <li style="margin-top: 5px;" class="d-flex align-items-center"><a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo $pays;  ?></a></li>
                            <li style="margin-top: 5px;" class="d-flex align-items-center">Categorie : <a href="voyage.php?id_voyage=<?php echo $id_voyage ?>"><?php echo " " . " " . $categorie;  ?></time></a></li>
                          </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?php echo $Description_voyage ?>
                </p>
            <?php if ($id_utilisateur !== $id_session) {?>     
            <div class="">
                    <?php $verif = "SELECT * FROM participant WHERE (id_utilisateur = $id_session AND id_voyage = $id_voyage)";
                    $verifresult = mysqli_query($con,$verif);
                    $nbpar = 0;
                    while (mysqli_fetch_assoc($verifresult)) {
                      $nbpar = $nbpar + 1;
                    }
                    ?>

                    <?php if($nbpar == 0) {?> 
                    <a href="part.php?id=<?php echo $id_voyage ?>" class="btn btn-primary" style="margin-top: 12px;">Participer</a><?php } ?>
                    <button class="btn btn-primary" style="margin-top: 12px;" onclick="getRandomNumber()">Verifier disponibilité</button>
                    <p id="randomNumber"></p>

                    <script>
        function getRandomNumber() {
            // Replace 'external-link-for-random-number' with the actual link that provides the random number
            fetch('http://www.randomnumberapi.com/api/v1.0/random?min=100&max=1000&count=1')
                .then(response => response.json())
                .then(data => {
                    // Assuming the API response contains a 'number' field
                    const randomNumber = data.number;

                    // Update the HTML content with the random number
                    document.getElementById('randomNumber').innerText = randomNumber;
                })
                .catch(error => console.error('Error fetching random number:', error));
        }
    </script>

                    <?php if($nbpar == 1) {?> 
                    <a href="annulerpart.php?id=<?php echo $id_voyage ?>" class="btn btn-warning" style="margin-top: 12px;">Annuler participation</a><?php } ?>
                </div> <?php } ?>   
            </article><!-- End blog entry -->


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


              

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->    













<?php include("include/footer.php"); ?>