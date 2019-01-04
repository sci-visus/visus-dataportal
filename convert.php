<?php 
    require("config.php");
	require("local.php"); 
	 
    if(!empty($_POST)){ 
	    $folder=strip_tags(trim($_POST['folder_path']));
        $X=strip_tags(trim($_POST['X']));
        $Y=strip_tags(trim($_POST['Y']));
		$Z=strip_tags(trim($_POST['Z']));
		$ncomp=strip_tags(trim($_POST['ncomp']));
		$dtype=strip_tags(trim($_POST['dtype']));
        
		print($folder." ".$X." ".$Y." ".$Z." ".$ncomp."*".$dtype);
		
        //print('<h3 style="color:red; text-align:center">Login Failed.</h3>'); 
       
    } 
?> 
