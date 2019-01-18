<?php 
	require("req_login.php");
	 
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
				if($ext==="jpg" or $ext==="jpeg" or $ext==="tiff" or $ext==="tif" or $ext==="png" or $ext==="raw") {
					$img=$dir."/".$f;
					break;	
				}
			}
			
			$foldername=basename($dir);
			
			$iX=intval($X);
			$iY=intval($Y);
			$iZ=intval($Z);
			if($iX == 1) $iX = 2;
			if($iY == 1) $iY = 2;
			if($iZ == 1) $iZ = 2;
			$box="0 ".strval($iX-1)." 0 ".strval($iY-1)." 0 ".strval($iZ-1); // not used for single image
			$dim="$X $Y $Z";
			
			date_default_timezone_set('America/Denver');
			$current_date = date('Y-m-d H:i:s');
			
			$params = array('visus_exe' => $visus_exe, 'dir' => $dir, 'fname' => $foldername, 'img' => $img, 'dim' => $dim, 'dtype' => $dtype_full);
            $json_params = json_encode($params);
			//echo  $json_params;
			
			// visus_exe data_dir filename input_file dim dtype 
			$cmd="scripts/convert_single.sh $visus_exe $dir $foldername $img \"$dim\" \"$dtype_full\"";
			
			$logfile="$dir/convert-".strtotime($current_date).".log";
			$pidfile="$dir/convert-".strtotime($current_date).".pid";
			exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $logfile, $pidfile));
			$pid=file_get_contents($pidfile);
			
			$output=file_get_contents($logfile);
		    
			   class MyDB extends SQLite3 {
				  function __construct() {
					 $this->open('db/conversion.db');
				  }
			   }
			   
			   $db = new MyDB();
			   if(!$db){
				  echo $db->lastErrorMsg();
			   }
			
			   $sql =<<<EOF
				  INSERT INTO conversion (name,type,status,params,pid,time,logfile)
				  VALUES ('$foldername', '$ctype', 'STARTED', '$json_params', '$pid', '$current_date','$logfile'); 
EOF;
			
			   $ret = $db->exec($sql);
			   if(!$ret) {
				  echo $db->lastErrorMsg();
			   } 
			   $db->close();
		}
		
		else if($ctype==="stack"){
			$img="";
			$fname="";
			$dp = opendir ($dir);
			$files = array();
			
			$img_count=0;
			while ($f = readdir($dp)){
				//echo $dir."/".$f."\n";
				$file_parts = pathinfo($dir."/".$f);
				
				$ext = $file_parts['extension'];
				if($ext==="jpg" or $ext==="jpeg" or $ext==="tiff" or $ext==="tif" or $ext==="png" ) {
					$img=$dir."/".$f;
					$files[$img_count]=$img;
					
					$img_count++;
				}
				
			}
			
			$foldername=basename($dir);
			
			$iX=intval($X);
			$iY=intval($Y);
			$iZ=intval($Z);
			if($iX == 1) $iX = 2;
			if($iY == 1) $iY = 2;
			if($iZ == 1) $iZ = 2;
			$box_array=array(0, $iX-1, 0, strval($iY-1),  0, strval($iZ-1));
			$box_str=implode(" ",$box_array);
			$box_split=explode(" ", $box_str);
			$dim="$X $Y $Z";
			
			date_default_timezone_set('America/Denver');
			$current_date = date('Y-m-d H:i:s');
			
			$convert_script="$dir/convert-".strtotime($current_date).".sh";
			
			$params = array('visus_exe' => $visus_exe, 'dir' => $dir, 'fname' => $foldername, 'box' => $box_str, 'dtype' => $dtype_full, 'cscript' => $convert_script);
            $json_params = json_encode($params);
			//echo  $json_params;
			
			$cfile = fopen($convert_script, "w") or die("Unable to open file!");
			
			fwrite($cfile, "#!/bin/bash \n");
			fwrite($cfile, "export CONVERT=$visus_exe \n");
			
			$idxfile=$dir.'/'.$foldername.'.idx';
			
			fwrite($cfile, '$CONVERT create "'.$idxfile.'" --box "'.$box_str.'" --fields "data '.$dtype_full.'" --time 0 0 time%05d/'."\n");
			
			sort($files); // sorting input files in alphabetical order
			
			$counter=0;
			foreach ($files as $f) {
				fwrite($cfile,'$CONVERT import "'.$f.'" export "'.$idxfile.'" --field data --box "0 '.$box_split[1].' 0 '.$box_split[3].' '.strval($counter).' '.strval($counter).'" \\'."\n");
				$counter++;
			}
			
			fclose($cfile);
			
			// visus_exe data_dir filename box dtype 
			//$cmd="scripts/convert_demo_hearth.sh $visus_exe $dir $foldername \"$box\" \"$dtype_full\"";
			
			$cmd="sh $convert_script";
			
			$logfile="$dir/convert-".strtotime($current_date).".log";
			$pidfile="$dir/convert-".strtotime($current_date).".pid";
		
			exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $logfile, $pidfile));
			$pid=file_get_contents($pidfile);
			
			
			$output=file_get_contents($logfile);
			
		    
			   class MyDB extends SQLite3 {
				  function __construct() {
					 $this->open('db/conversion.db');
				  }
			   }
			   
			   $db = new MyDB();
			   if(!$db){
				  echo $db->lastErrorMsg();
			   }
			
			   $sql =<<<EOF
				  INSERT INTO conversion (name,type,status,params,pid,time,logfile)
				  VALUES ('$foldername', '$ctype', 'STARTED', '$json_params', '$pid', '$current_date','$logfile'); 
EOF;
			
			   $ret = $db->exec($sql);
			   if(!$ret) {
				  echo $db->lastErrorMsg();
			   } 
			   $db->close();
		}

		header("Location: upload/index.php");
		die("Redirecting to: upload"); 
		
    } 
	
	
?>