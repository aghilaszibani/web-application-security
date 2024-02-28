<?php
include("include/session.php");



if (isset($_GET['id'])) {
	$id_voyage = $_GET['id'];
	$queryidf = "SELECT id_utilisateur FROM forum WHERE id_discussion = $id_voyage";
              $resultidf = mysqli_query($con,$queryidf);
              while ($row = mysqli_fetch_assoc($resultidf)) {
                    $id_f = $row['id_utilisateur'];
                  }

	if($id_f == $id_session){
	$querydelete = "DELETE FROM forum WHERE id_discussion = $id_voyage";
	mysqli_query($con,$querydelete);

	header('Location:discussion.php');}
	else{echo("error");}
}