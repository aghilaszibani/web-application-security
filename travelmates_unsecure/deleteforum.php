<?php
include("include/session.php");

if (isset($_GET['id'])) {
	$id_voyage = $_GET['id'];
	$querydelete = "DELETE FROM forum WHERE id_discussion = $id_voyage";
	mysqli_query($con,$querydelete);

	header('Location:discussion.php');
}