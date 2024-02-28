<?php
include("include/session.php");
?>
  <!-- Navbar -->
<?php 
include ("include/header.php");?>
  <!-- End Navbar -->
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
    <div class="motto text-center">
        <h1>Poster une publication</h1>
    </div>    
  </div>
  
        
        <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
  <form method="POST" action="" enctype="multipart/form-data" style="margin-top: 100px;">
  <?php if (isset($_GET['msg'])) { ?>
    <div class="form-row">

    <div class="form-group col-md-12">
      <b><h6 class="text-success">Votre publication a bien été postée</h6></b>
    </div>
  </div> 

  <?php
  } ?> 
   

  <div class="form-row">

    <div class="form-group col-md-12">
      <label for="inputText4">Titre de la publication</label>
      <input type="text" name="titre" class="form-control" id="inputText4" placeholder="Titre">
    </div>
  </div>

  <div class="form-row">

    <div class="form-group col-md-12">
      <label for="textarea4">Description de la publication</label>
      <textarea name="description_publication" class="form-control" placeholder="Description" id="textarea4"></textarea>
    </div>
  </div>

  <div class="form-row">

    <div class="form-group col-md-12">
      <label for="inputText5">Commentaire</label>
      <input type="text" name="commentaire" class="form-control" id="inputText5" placeholder="Commentaire">
    </div>
  </div>


  <div class="form-row">
    
    <div class="form-group col-md-4">
      <label for="inputFile4">Ajouter des photos </label>
      <input type="file" class="" id="inputFile4" name="file1" placeholder="">
    </div>
      
  </div>

  <div class="form-row">
    
    <div class="form-group col-md-4">
      <label for="inputFile4">Ajouter des photos </label>
      <input type="file" class="" id="inputFile4" name="file2" placeholder="">
    </div>
      
  </div>

  <div class="form-row">
    
    <div class="form-group col-md-4">
      <label for="inputFile4">Ajouter des photos </label>
      <input type="file" class="" id="inputFile4" name="file3" placeholder="">
    </div>
      
  </div>

  <button type="submit" class="btn btn-primary" name="submit">Confirmer</button>


</form>
        </div>
      </div>


 <?php
  
  if (isset($_POST['submit'])) {
    
    $titre_publication = $_POST['titre'];
    $description_publication = $_POST['description_publication'];
    $comment_pub = $_POST['commentaire'];
    $imgpub1 =$_FILES['file1']['name'];
    $target = 'uploads/publication/' . $imgpub1;
    move_uploaded_file($_FILES['file1']['tmp_name'], $target);
    $imgpub2 =$_FILES['file2']['name'];
    $target = 'uploads/publication/' . $imgpub2;
    move_uploaded_file($_FILES['file2']['tmp_name'], $target);
    $imgpub3 =$_FILES['file3']['name'];
    $target = 'uploads/publication/' . $imgpub3;
    move_uploaded_file($_FILES['file3']['tmp_name'], $target);


  $queryajout = "INSERT INTO publication (id_utilisateur, titre_publication, description_publication, comment_pub, img_publication, image_pub2, image_pub3) VALUES ($id_session, '$titre_publication', '$description_publication', '$comment_pub', '$imgpub1', '$imgpub2', '$imgpub3')";
  $result = mysqli_query($con,$queryajout);  
  if(!$result){
                    die("QUERY FAILED".mysqli_error($con));
                }
    
                header('Location:AjoutPub.php?msg');
  }

 ?>     
      

  <?php 
  include ("include/footer.php");?>
