<?php 
    require("config.php");
	require("local.php"); 
	 
    if(!empty($_POST)){ 
	    $dir=$data_dir."/".strip_tags(trim($_POST['folder_path']));
		
        $X=strip_tags(trim($_POST['X']));
        $Y=strip_tags(trim($_POST['Y']));
		$Z=strip_tags(trim($_POST['Z']));
		$ncomp=strip_tags(trim($_POST['ncomp']));
		$dtype=strip_tags(trim($_POST['dtype']));
        
		$dtype_full="$ncomp*$dtype";
		
		$ctype=strip_tags(trim($_POST['convert-type']));
		
		if($ctype==="single"){
			$img="";
			$fname="";
			$dp = opendir ($dir);
			while ($f = readdir($dp)){
				//echo $dir."/".$f."\n";
				$file_parts = pathinfo($dir."/".$f);
				
				$ext = $file_parts['extension'];
				$fname = $file_parts['filename'];
				if($ext==="jpg" or $ext==="tiff" or $ext==="tif" or $ext==="png" or $ext==="raw") 
					$img=$dir."/".$f;			
			}
			
			$iX=intval($X);
			$iY=intval($Y);
			$iZ=intval($Z);
			if($iX == 1) $iX = 2;
			if($iY == 1) $iY = 2;
			if($iZ == 1) $iZ = 2;
			$box="0 ".strval($iX-1)." 0 ".strval($iY-1)." 0 ".strval($iZ-1);
			$dim="$X $Y $Z";
			
			// data_dir filename input_file box dim dtype 
		    print(shell_exec("scripts/convert_single.sh $dir $fname $img \"$box\" \"$dim\" \"$dtype_full\""));
		}
		
		//print($img." ".$X." ".$Y." ".$Z." ".$ncomp."*".$dtype_full);
		
		
		
        //print('<h3 style="color:red; text-align:center">Login Failed.</h3>'); 
       
    } 
?> 
