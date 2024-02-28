<?php if (isset($_GET['id'])) {

	include("include/database.php");

	$id = $_GET['id'];
	$queryd = "DELETE FROM voyage where id_voyage = $id";
	$queryde = mysqli_query($con,$queryd);

	header('Location:voyage.php');

} ?>