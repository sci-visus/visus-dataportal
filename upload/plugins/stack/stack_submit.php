<?php 
require("../../../req_login.php");

if(!empty($_POST)){ 
    $ctype=strip_tags(trim($_POST['convert-type']));

    $X=strip_tags(trim($_POST['X']));
    $Y=strip_tags(trim($_POST['Y']));
		$Z=strip_tags(trim($_POST['Z']));
		$ncomp=strip_tags(trim($_POST['ncomp']));
		$dtype=strip_tags(trim($_POST['dtype']));
        
		$dtype_full="$ncomp*$dtype";	
		
		if($ctype==="stack"){
            $dir=$data_dir."/".strip_tags(trim($_POST['folder_path_stack']));
			
            $outdir=$out_data_dir."/".strip_tags(trim($_POST['out_dir_stack']));
            $fname = strip_tags(trim($_POST['out_name_stack']));
			if (!file_exists($outdir)) {
                            mkdir($outdir, 0777, true);
                        }
			
			$img="";
			$dp = opendir ($dir);
			$files = array();
			
			$is_dicom=false;

			$img_count=0;
			while ($f = readdir($dp)){
				//echo $dir."/".$f."\n";
				$file_parts = pathinfo($dir."/".$f);
				
				$ext = $file_parts['extension'];
				if($ext==="jpg" or $ext==="jpeg" or $ext==="tiff" or $ext==="tif" or $ext==="png" or $ext==="dcm") {
					$img=$dir."/".$f;
					$files[$img_count]=$img;
					
					if($ext==="dcm")
						$is_dicom=true;

					$img_count++;
				}
				
			}
			
			$cmd="";

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
			
			$convert_script="$outdir/convert-".strtotime($current_date).".sh";
			
			$params = array('visus_exe' => $visus_exe, 'dir' => $outdir, 'indir' => $dir, 'fname' => $fname, 'box' => $box_str, 'dtype' => $dtype_full, 'cscript' => $convert_script);
            $json_params = json_encode($params);
			//echo  $json_params;
			
			$idxfile=$outdir.'/'.$fname.'.idx';

			if($is_dicom){
				$cmd="python ../../../scripts/convert_dcm.py -f ".$dir." -i ".$idxfile;
			}
			else{
				$cfile = fopen($convert_script, "w") or die("Unable to open file $convert_script!"); 
				
				fwrite($cfile, "#!/bin/bash \n");
				fwrite($cfile, "export CONVERT=$visus_exe \n");

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
			}
			
			$logfile="$outdir/convert-".strtotime($current_date).".log";
			$pidfile="$outdir/convert-".strtotime($current_date).".pid";
		
			exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $logfile, $pidfile));
			$pid=file_get_contents($pidfile);
			
			
			$output=file_get_contents($logfile);
			
		   class MyDB extends SQLite3 {
			  function __construct() {
				 $this->open('../../../db/conversion.db');
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

//		header("Location: upload/index.php");
//		die("Redirecting to: upload"); 

		// perform add to server automatically after conversion
		echo '<form action="../../../datasets.php" id="myForm" method="post" enctype="multipart/form-data">',
        '<input type="hidden" name="furl" id="furl" value="'.$idxfile.'" />',
        '<input type="hidden" name="fname" id="fname" value="'.$fname.'" />',
        '</form>';

     echo '<script type="text/javascript">',
             'document.getElementById("myForm").submit();',
           '</script>';

  } 
?>

