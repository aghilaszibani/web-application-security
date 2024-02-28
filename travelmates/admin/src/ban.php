<?php if (isset($_GET['id'])) {

	include("include/database.php");

	$id = $_GET['id'];
	$queryd = "DELETE FROM utilisateur where id_utilisateur = $id";
	$queryde = mysqli_query($con,$queryd);

	$queryd = "DELETE FROM publication where id_utilisateur = $id";
	$queryde = mysqli_query($con,$queryd);

	$queryd = "DELETE FROM voyage where id_utilisateur = $id";
	$queryde = mysqli_query($con,$queryd);

	$queryd = "DELETE FROM forum where id_utilisateur = $id";
	$queryde = mysqli_query($con,$queryd);

	$queryd = "DELETE FROM commentairef where id_utilisateurf = $id";
	$queryde = mysqli_query($con,$queryd);

	$queryd = "DELETE FROM commentaire where id_utilisateur = $id";
	$queryde = mysqli_query($con,$queryd);

	$queryd = "DELETE FROM ami where id_utilisateur = $id";
	$queryde = mysqli_query($con,$queryd);

	$queryd = "DELETE FROM ami where id_ami = $id";
	$queryde = mysqli_query($con,$queryd);

	header('Location:utilisateurs.php');

} ?>