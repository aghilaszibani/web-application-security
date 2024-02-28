
<?php

include("include/session.php") ;


$id = $_GET['id'];
$ida = $_GET['ida'];

$ajouter = "INSERT INTO ami (id_utilisateur, id_ami) VALUES ($id, $ida)";
$resulta = mysqli_query($con,$ajouter);
if(!$resulta){
                    die("QUERY FAILED".mysqli_error($con));
                }

header('Location:profilp.php?id='. $ida);
