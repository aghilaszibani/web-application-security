<?php
include("include/session.php");
include("include/header.php") ?>
<?php if (isset($_GET['id'])) {
  $id_utilisateurget = $_GET['id'];
}
              $queryad = "SELECT * FROM utilisateur WHERE id_utilisateur = '$id_utilisateurget' ";
              $queryadm = mysqli_query($con,$queryad);
              if(!$queryadm){
                    die("QUERY FAILED".mysqli_error($con));
                    }
              while($row = mysqli_fetch_assoc($queryadm)){
                        $id_ut = $row['id_utilisateur'];
                        $pseudo = $row['pseudo'];
                        $nom = $row['nom'];
                        $prenom  = $row['prenom'];
                        $email = $row['email'];
                        $date_naissance = $row['date_naissance'];
                        $mot_de_passe = $row['mot_de_passe'];
                        $num_tel = $row['num_tel'];
                        $pays = $row['pays'];
                        $sexe = $row['sexe'];
                        $role = $row['role']; 
                        $adress = $row['adress'];
                        $zip = $row['zip'];
                        $ville = $row['ville'];
                        $image = $row['img_profil'];  
                        
                        }     

              ?>
  <!-- End Navbar -->
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
  <div class="section profile-content">
    <div class="container">
      <div class="owner">
        <div class="avatar">
          <img src="<?php echo "uploads/profil/" . $image?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
        </div>
        <div class="name">
          <h4 class="title"><?php echo $nom . " " . $prenom?> 
          </h4>
        </div>
        <?php if (isset($_SESSION['user'])){ ?>
        <div class="row">
        <div class="col-md-6 ml-auto mr-auto text-center"><?php $queryami = "SELECT * FROM ami WHERE (id_utilisateur = $id_session AND id_ami=$id_utilisateurget)";
          $resultami = mysqli_query($con,$queryami);
          if (mysqli_fetch_array($resultami) == false){
         ?>
          <a href="add_friend.php?id=<?php echo $id_session ?>&ida=<?php echo $id_utilisateurget ?>"><btn class="btn btn-outline-success btn-round"><i class="fa fa-user-plus"></i> Follow</btn></a></br></br>    <?php } else { ?>

            <a href="delete_friend.php?id=<?php echo $id_session ?>&ida=<?php echo $id_utilisateurget ?>"><btn class="btn btn-outline-warning btn-round"><i class="fa fa-user-minus"></i> Unfollow</btn></a></br></br>


        <?php  }} ?>
          <h2 class="text-center" style="margin-top: 0;">Publications</h2>
        </div>
      </div>
      </div>
    </div></div>

    <div class="container align-items-center justify-content-center">
      <?php $queryp = "SELECT * FROM publication WHERE id_utilisateur = '$id_ut' ";
              $querypu = mysqli_query($con,$queryp);
              if(!$querypu){
                    die("QUERY FAILED".mysqli_error($con));
                    } 
      while($row = mysqli_fetch_assoc($querypu)){
                        $id_publication = $row['id_publication'];
                        $titre_publication = $row['titre_publication'];
                        $img_publication = $row['img_publication'];
                        $date_publication = $row['date_publication'];
                                      
                    ?>
      <div class="card mr-auto ml-auto" style="width: 30rem;">
      <img class="card-img-top" src="<?php echo "uploads/publication/" . $img_publication ?>" alt="Card image cap">
      <div class="card-body">
      <div class="row">
      <a href="Rechp_single.php?id=<?php echo$id_publication ?>"><p class="card-text" style="font-size: 20px; margin-left:10px; "><?php echo $titre_publication . " " . $date_publication ?></p></a>
      </div>
      </div>
      </div>
      <?php } ?>
    </div>
      
<?php include ("include/footer.php");?>
</body>

</html>
