<?php

    $con=mysqli_connect('localhost','root','','projetgl');

    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
?>