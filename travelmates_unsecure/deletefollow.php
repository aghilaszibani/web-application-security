
<?php

include("include/session.php") ;


$id = $_GET['id'];
$ida = $_GET['ida'];

$supp = "DELETE FROM ami WHERE (id_utilisateur=$id AND id_ami=$ida)";
$resulta = mysqli_query($con,$supp);
if(!$resulta){
                    die("QUERY FAILED".mysqli_error($con));
                }

header('Location:profil.php');
