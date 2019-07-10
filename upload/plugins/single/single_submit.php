<?php 
	require("req_login.php");
	 
  if(!empty($_POST)){ 
    $ctype=strip_tags(trim($_POST['convert-type']));

    $X=strip_tags(trim($_POST['X']));
    $Y=strip_tags(trim($_POST['Y']));
		$Z=strip_tags(trim($_POST['Z']));
		$ncomp=strip_tags(trim($_POST['ncomp']));
		$dtype=strip_tags(trim($_POST['dtype']));
        
		$dtype_full="$ncomp*$dtype";	
	
	if($ctype==="single"){
                      
		$img=$data_dir."/".strip_tags(trim($_POST['folder_path']));
          $dir=$out_data_dir."/".strip_tags(trim($_POST['out_dir_single']));//dirname($img);
          $fname = strip_tags(trim($_POST['out_name_single']));
		if (!file_exists($dir)) {
                          mkdir($dir, 0777, true);
                      }
		//$file_parts = pathinfo($img);
			
	    //$ext = $file_parts['extension'];
		 //$file_parts['filename'];
			
		/*$dp = opendir ($dir);
		while ($f = readdir($dp)){
			//echo $dir."/".$f."\n";
			$file_parts = pathinfo($dir."/".$f);
			
			$ext = $file_parts['extension'];
			$fname = $file_parts['filename'];
			if($ext==="jpg" or $ext==="jpeg" or $ext==="tiff" or $ext==="tif" or $ext==="png" or $ext==="raw") {
				$img=$dir."/".$f;
				break;	
			}
		}*/
		
		//$foldername=basename($dir);
		
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
		
		// visus_exe data_dir filename input_file dim dtype 
		$cmd="scripts/convert_single.sh $visus_exe $dir $fname $img \"$dim\" \"$dtype_full\"";
		
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
			  VALUES ('$fname', '$ctype', 'STARTED', '$json_params', '$pid', '$current_date','$logfile'); 
EOF;
		
		   $ret = $db->exec($sql);
		   if(!$ret) {
			  echo $db->lastErrorMsg();
		   } 
		   $db->close();
	}
	else
		echo "Conversion type not supported", $ctype;

	// perform add to server automatically after conversion
	echo '<form action="datasets.php" id="myForm" method="post" enctype="multipart/form-data">',
      '<input type="hidden" name="furl" id="furl" value="'.$idxfile.'" />',
      '<input type="hidden" name="fname" id="fname" value="'.$fname.'" />',
      '</form>';

   echo '<script type="text/javascript">',
           'document.getElementById("myForm").submit();',
         '</script>';

  } 
?>

