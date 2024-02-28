<?php if (isset($_GET['id'])) {

	include("include/database.php");

	$id = $_GET['id'];
	$queryd = "DELETE FROM forum where id_discussion = $id";
	$queryde = mysqli_query($con,$queryd);

	header('Location:foruma.php');

} ?>