
<?php

include("include/session.php") ;


$id = $_GET['id'];


$ajouter = "INSERT INTO participant (id_utilisateur, id_voyage) VALUES ($id_session, $id)";
$resulta = mysqli_query($con,$ajouter);
if(!$resulta){
                    die("QUERY FAILED".mysqli_error($con));
                }

header('Location:voyage.php?id_voyage='. $id);
