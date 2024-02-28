<?php

include("include/session.php") ;


$id = $_GET['id'];


$supp = "DELETE FROM participant WHERE (id_utilisateur=$id_session AND id_voyage=$id)";
$resulta = mysqli_query($con,$supp);
if(!$resulta){
                    die("QUERY FAILED".mysqli_error($con));
                }

header('Location:voyage.php?id_voyage='. $id);