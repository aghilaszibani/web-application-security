<?php
include("include/session.php");
?>
  <!-- Navbar -->
  <?php 
  include ("include/header.php");?>

  

  <div class="page-header" data-parallax="true" style="background-image: url('assets/img/background.jpg');">
    <div class="filter"></div>
    
    <div class="container">


      <div class="motto text-center">
        <h1>TravelMates</h1>
        </br>
        <form class="box m-auto" action="Rechpub.php" method="post">

          <input type="text" placeholder="Votre recherche" class="stext" name="titre" required="required">
          <button type="submit" class="sbutton" name="btsubmit"><i class="fa fa-search" aria-hidden="true"></i></button>
          
        </form>
         <div class="slinks ml-auto mr-auto d-flex justify-content-center align-items-center">
          <a href="https://booking.kayak.com/?&sid=08d1f4063de84a9bca58612ad4d3b055&aid=309654&label=booking-be-fr-X4aBIQZicMhpQ5zEtMZNJgS272866884841%3Apl%3Ata%3Ap1%3Ap22.563.000%3Aac%3Aap%3Aneg%3Afi%3Atikwd-15106320%3Alp9069716%3Ali%3Adec%3Adm%3Appccp%3DUmFuZG9tSVYkc2RlIyh9YcsZ-Id2vkzIfTmYhvC5HOg" class="linkbox" target="_blank">
            <i class="fas fa-plane"></i>
            <p>Vols</p>
          </a>
          <a href="https://www.booking.com/country/fr.fr.html?aid=309654;label=booking-be-fr-X4aBIQZicMhpQ5zEtMZNJgS272866884841:pl:ta:p1:p22.563.000:ac:ap:neg:fi:tikwd-15106320:lp9069716:li:dec:dm:ppccp=UmFuZG9tSVYkc2RlIyh9YcsZ-Id2vkzIfTmYhvC5HOg;ws=&gclid=Cj0KCQiA7YyCBhD_ARIsALkj54rxg0ppoJrN2ul4Hjir0qDRfXN1lHRW0nNiYaPfSoyADO3U-XdwCcsaAjFiEALw_wcB" class="linkbox" target="_blank">
            <i class="fas fa-hotel"></i>
            <p>Hotel</p>
          </a>
          <a href="https://www.booking.com/cars/index.fr.html?label=gen173rf-1FEgRjYXJzKIICOOgHSDNYA2hAiAEBmAENuAEXyAEM2AEB6AEB-AELiAIBmAIiqAIDuALg_Y2CBsACAdICJDcxMTRiMDU2LWM4YmMtNDE3Ny04MjdjLWFkODM2NTE1MGFiNtgCBuACAQ;sid=08d1f4063de84a9bca58612ad4d3b055;keep_landing=1&" class="linkbox" target="_blank">
            <i class="fas fa-car"></i>
            <p>Voiture</p>
          </a>
        </div>


      </div>

    </div>
    <video autoplay loop muted class="banner__video" poster="assets/img/background.jpg">
      <source src="video.webm" type="video/webm">
      <source src="video.mp4" type="video/mp4">
    </video>
  </div>

  <div class="main">

    <div class="section section-dark text-center" id="jointravelgo">
      <div class="joinwrapper ml-auto mr-auto" style="width: 90%;">
        <h2 class="title">Rejoignez TravelGO</h2>
        <br/>
        <br/>
        <div class="row">
          <div class="col-md-4">
          <img class="img-responsive" data-aos="fade-up" id="joinimg" src="https://www.coopcar.fr/cache/image_0b73f3fedde0918f4fe4163d583cb80f.jpeg" alt="Card image cap" style="width: 100%;height: 400px;border-radius: 2%;">
          <h4 class="title">Planifiez vos voyages</h2>
          </div>  
          <div class="col-md-4">
           <img class="img-responsive" data-aos="fade-up" data-aos-delay="50" id="joinimg" src="https://maralion.ma/wp-content/uploads/2019/10/5d02a993e2dfa.png" alt="Card image cap" style="width: 100%;height: 400px;border-radius: 2%;">
           <h4 class="title">Partagez votre experience</h2> 
          </div>
          <div class="col-md-4">
           <img class="img-responsive" data-aos="fade-up" data-aos-delay="100" id="joinimg" src="https://www.thetravelteam.com/wp-content/uploads/2018/07/group_travel_app.jpg" alt="Card image cap" style="width: 100%;height: 400px;border-radius: 2%;">
           <h4 class="title">Suivez d'autres voyageurs</h2> 
          </div>
        </div>
      </div>  
    </div>

    <div class="section pt-o" id="carousel">
      
        <h2 class="title text-center">Destinations</h2>
          <div class="col-md-8 ml-auto mr-auto">
            
            <div class="card page-carousel">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <img class="d-block img-fluid" src="./assets/img/slider/cancun.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p style="font-size: 1.5rem;color: #f5593d;font-weight: bold;">Cancun,Mexique</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="./assets/img/slider/paris.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p style="font-size: 1.5rem;color: #f5593d;font-weight: bold;">Paris,France</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="./assets/img/slider/london.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p style="font-size: 1.5rem;color: #f5593d;font-weight: bold;">London,UK</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="./assets/img/slider/newyork.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p style="font-size: 1.5rem;color: #f5593d;font-weight: bold;">New York,USA</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="./assets/img/slider/hawai.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p style="font-size: 1.5rem;color: #f5593d;font-weight: bold;">Maui,Hawai</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="./assets/img/slider/venise.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p style="font-size: 1.5rem;color: #f5593d;font-weight: bold;">Venise,Italy</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="./assets/img/slider/lasvegas.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                      <p style="font-size: 1.5rem;color: #f5593d;font-weight: bold;">Las Vegas,USA</p>
                    </div>
                  </div>
                </div>
                <a class="left carousel-control carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        
      
    </div>

    <div class="section latest_posts">
      <h2 class="m-0 text-center">Publication recentes</h2>
    </br></br></br>
      <div class="container">
        <div class="row">

    <?php $query = "SELECT * FROM publication ORDER BY id_publication DESC LIMIT 2";

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

    
        
    
          <div class="col-md-6 firstpost" style="margin-bottom: 30px;">
            <div class="img-post ">
              <img src="<?php echo "uploads/publication/" . $img_publication?>" style="width: 100%;" class="img-responsive img2">
            </div>
            <a href="Rechp_single.php?id=<?php echo $id_publication ?>"><h6 class="post-text" style="margin-top: 8px;"><?php echo $titre_publication?></h6></a>
            <a href="Rechp_single.php?id=<?php echo $id_publication ?>"><h6 class="post-auteur" style="margin-top: 8px;"><i class="fas fa-user"> &nbsp <?php echo $pseudo ?></i></h6></a>
          </div>

        <?php } ?>
          
        </div>

        <div class="row">

    <?php $query = "SELECT * FROM publication ORDER BY id_publication ASC LIMIT 3";

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

    
        
    
          <div class="col-md-4 firstpost" style="margin-bottom: 30px;">
            <div class="img-post ">
              <img src="<?php echo "uploads/publication/" . $img_publication?>" style="width: 100%;" class="img-responsive img2">
            </div>
            <a href="Rechp_single.php?id=<?php echo $id_publication ?>"><h6 class="post-text" style="margin-top: 8px;"><?php echo $titre_publication?></h6></a>
            <a href="Rechp_single.php?id=<?php echo $id_publication ?>"><h6 class="post-auteur" style="margin-top: 8px;"><i class="fas fa-user"> &nbsp <?php echo $pseudo ?></i></h6></a>
          </div>

        <?php } ?>
          
        </div>
        
      </div>
    </div>

    <div class="section landing-section " id="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="text-center">Contact</h2>
            <form class="contact-form">
              <div class="row">
                <div class="col-md-6">
                  <label>Nom</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="nc-icon nc-single-02"></i>
                      </span>
                    </div>
                    <input id="name" type="text" class="form-control" placeholder="Nom">
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="nc-icon nc-email-85"></i>
                      </span>
                    </div>
                    <input id="email" type="text" class="form-control" placeholder="Email">
                  </div>
                </div>
              </div>
              <label>Message</label>
              <textarea id="body" class="form-control" rows="4" placeholder="Votre message ..."></textarea>
              <div class="row">
                <div class="col-md-4 ml-auto mr-auto">
                  <button class="btn btn-danger btn-lg btn-fill" onclick="sendEmail()" value="Send and Email">Envoyer Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php 
  include ("include/footer.php");?>

  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
        function sendEmail() {
            var name = $("#name");
            var email = $("#email");
            var body = $("#body");

            if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(body)) {
                $.ajax({
                   url: 'sendEmail.php',
                   method: 'POST',
                   dataType: 'json',
                   data: {
                       name: name.val(),
                       email: email.val(),
                       body: body.val()
                   }, success: function (response) {
                        $('#myForm')[0].reset();
                        $('.sent-notification').text("Message Sent Successfully.");
                   }
                });
            }
        }

        function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');

            return true;
        }
    </script>
  
</body>

</html>
