<?php
include("include/session.php");
include("include/header.php") ?>
<?php $pseudo = $_SESSION['user'];
              $queryad = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' ";
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

        <?php $queryfollow="SELECT * FROM ami WHERE id_utilisateur=$id_session";
        $queryresultf = mysqli_query($con,$queryfollow);
        $nbfollow=0 ;
        while (mysqli_fetch_assoc($queryresultf)) {
          $nbfollow = $nbfollow + 1;
        }
         ?>
         <?php $queryfollow="SELECT * FROM ami WHERE id_ami=$id_session";
        $queryresultf = mysqli_query($con,$queryfollow);
        $nbfollowers=0 ;
        while (mysqli_fetch_assoc($queryresultf)) {
          $nbfollowers = $nbfollowers + 1;
        }
         ?>
        <div class="follow" style="margin-bottom: 20px;">
          <a href="follow.php" style="margin-right: 20px; color: black;font-size: 20px;"><?php echo $nbfollow . " " ?> Follows</a><a href="followers.php" style="color: black;font-size: 20px;"><?php echo $nbfollowers . " " ?>Followers</a>
        </div>
        <div class="row">
        <div class="col-md-6 ml-auto mr-auto text-center">
          <a href="modify_profil.php"><btn class="btn btn-outline-default btn-round"><i class="fa fa-cog"></i> Modifier profil</btn></a></br></br>
        </div>
      </div>
      </div>
    </div></div>
    <?php $queryfollow="SELECT * FROM forum WHERE id_utilisateur=$id_session";
        $queryresultf = mysqli_query($con,$queryfollow);
        while ($row = mysqli_fetch_assoc($queryresultf)) {
          $id_discussion = $row['id_discussion'];
          $sujet = $row['sujet'];
          ?>

          <div class="row">
            <div class="col-md-4 ml-auto mr-auto">
              <ul class="list-unstyled follows">
                <li>
                  <div class="row">
                    <div class="col-lg-7 col-md-4 col-4  ml-auto mr-auto">
                      <a href="forum_single.php?id=<?php echo $id_discussion ?>"><h6><?php echo $sujet ?>
                        <br/>
                        
                      </h6></a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-4  ml-auto mr-auto">
                      <div class="form-check">
                        <label class="form-check-label">
                          <a href="deleteforum.php?id=<?php echo $id_discussion ?>" class="btn btn-warning">Supprimer</a>
                        </label>
                      </div>
                    </div>
                  </div>
                </li>
                <hr />
              </ul>
            </div>
          </div>

        <?php }
         ?>
      
<?php include ("include/footer.php");?>
</body>

</html>
