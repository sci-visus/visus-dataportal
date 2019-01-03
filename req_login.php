<?php 
    require("config.php");
    require('local.php');

    if(empty($_SESSION['user'])) 
    {
        header("Location: login.php");
        die("Redirecting to login.php"); 
    }
?>