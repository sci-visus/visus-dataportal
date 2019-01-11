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
				if($ext==="jpg" or $ext==="tiff" or $ext==="tif" or $ext==="png" or $ext==="raw") {
					$img=$dir."/".$f;
					break;			
				}
			}
			if($img!==""){
			
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
			
			$params = array('visus_exe' => $visus_exe, 'dir' => $dir, 'fname' => $fname, 'img' => $img, 'dim' => $dim, 'dtype' => $dtype_full);
            $json_params = json_encode($params);
			//echo  $json_params;
			
			// data_dir filename input_file box dim dtype 
			$cmd="scripts/convert_single.sh $visus_exe $dir $fname $img \"$dim\" \"$dtype_full\"";
			
			$logfile="$dir/convert-".strtotime($current_date).".log";
			$pidfile="$dir/convert-".strtotime($current_date).".pid";
			exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $logfile, $pidfile));
			$pid=file_get_contents($pidfile);
			
			$output=file_get_contents($logfile);
			
			/*
			if(strpos($output, "All done") !== false){
				echo '<script type="text/javascript">',
			        'updateStatus('.json_encode($output).', "<b style=\"color: green\">Success</b>", "'.$dir."/".$fname.'.idx","'.$fname.'")',
    			 '</script>';
			}
			else
			   echo '<script type="text/javascript">',
			        'updateStatus('.json_encode($output).', "<b style=\"color: red\">Failed</b>","","")',
    			 '</script>';
				*/ 
		    
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
				  VALUES ('$fname', '$ctype', 'STARTED', '$json_params', '$pid', '$current_date','$logfile'); 
EOF;
			
			   $ret = $db->exec($sql);
			   if(!$ret) {
				  echo $db->lastErrorMsg();
			   } 
			   $db->close();
		}
             }

		header("Location: upload/index.php");
		die("Redirecting to: upload"); 
		
		//print($img." ".$X." ".$Y." ".$Z." ".$ncomp."*".$dtype_full);
        //print('<h3 style="color:red; text-align:center">Login Failed.</h3>'); 
       
    } 
?>