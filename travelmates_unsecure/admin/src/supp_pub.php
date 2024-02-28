<?php if (isset($_GET['id'])) {

	include("include/database.php");

	$id = $_GET['id'];
	$queryd = "DELETE FROM publication where id_publication = $id";
	$queryde = mysqli_query($con,$queryd);

	header('Location:publications.php');

} ?>