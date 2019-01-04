<?php 
    require("config.php");
    require('local.php');

    if(empty($_SESSION['user'])) 
    {
		$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

		if (strpos($url,'upload') !== false) 
		  header("Location: ../login.php");
		else
          header("Location: login.php");
        die("Redirecting to login.php"); 
    }
?>