<?php
include("include/session.php");

if (isset($_GET['id'])) {
	$id_voyage = $_GET['id'];
	$querydelete = "DELETE FROM voyage WHERE id_voyage = $id_voyage";
	mysqli_query($con,$querydelete);

	header('Location:annonce.php');
}

