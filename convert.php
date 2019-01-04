<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="ext/bootstrap-3.3.7/css/bootstrap.min.css">
    <script src="ext/bootstrap-3.3.7/jquery/jquery.min.js"></script>
    <script src="ext/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    
    <script src="ext/bootstrap-3.3.7/jquery/jquery.tabledit.min.js"></script>


</head>

<body>

 <div class="modal-dialog">

            <!-- Download Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Data Conversion</h4>
              </div>
              
                <div class="col" style="padding:20px; text-align:center">
                  <p id="status">Conversion in progress...</p>
                  <textarea class="form-control" id="log" style="min-width: 100%"></textarea>
                </div>
                
              <div class="modal-footer">
                <form action="datasets.php" method="post" enctype="multipart/form-data"> 
                        <input type="hidden" name="furl" id="furl" value="" />                          
                        <input type="hidden" name="fname" id="fname" value="" /> 
                        <input type="submit" id="fadd" class="btn btn-info" value="Add as new dataset" disabled /> 
                </form> 
              </div>
            </div>

          </div>
          <script>
		  	function updateStatus(visuslog, status, url, name){
				$("#log").html(visuslog);
				$("#status").html(status);
				if(status.indexOf('Success') !== -1){
					$("#furl").val(url);
					$("#fname").val(name);
					$("#fadd").prop('disabled', false);
				}
				
			}
		  </script>

<?php 
	require("req_login.php");
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
			$box="0 ".strval($iX-1)." 0 ".strval($iY-1)." 0 ".strval($iZ-1); // not used for single image
			$dim="$X $Y $Z";
			
			// data_dir filename input_file box dim dtype 
		    $output=shell_exec("scripts/convert_single.sh \"$visus_exe\" \"$dir\" \"$fname\" \"$img\" \"$dim\" \"$dtype_full\"");
			
			if(strpos($output, "All done") !== false){
				echo '<script type="text/javascript">',
			        'updateStatus('.json_encode($output).', "<b style=\"color: green\">Success</b>", "'.$dir."/".$fname.'.idx","'.$fname.'")',
    			 '</script>';
			}
			else
			   echo '<script type="text/javascript">',
			        'updateStatus('.json_encode($output).', "<b style=\"color: red\">Failed</b>","","")',
    			 '</script>';
				 
		    
		}
		
		//print($img." ".$X." ".$Y." ".$Z." ".$ncomp."*".$dtype_full);
        //print('<h3 style="color:red; text-align:center">Login Failed.</h3>'); 
       
    } 
?> 

</body>
</html>

