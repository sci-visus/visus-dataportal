<?php 
   
    if(!empty($_POST)){ 
	    $dir=$_POST['dir'];
		$img="";
        $dp = opendir ($dir);
        while ($f = readdir($dp)){
			//echo $dir."/".$f."\n";
            $file_parts = pathinfo($dir."/".$f);
			
			$ext = $file_parts['extension'];
			if($ext==="jpg" or $ext==="tiff" or $ext==="tif" or $ext==="png" ) 
                $img=$dir."/".$f;
            
		}
		//"/Users/steve/Research/SCI/workspace/datasets/ceramic/CGN_B-Stg_center_0988.tif";
		//"/Users/steve/Research/SCI/workspace/visusdataportal/upload/files/new_project_2/pip_1958_1332.tif";
		if($img!=""){
        $exif = exif_read_data($img, 'IFD0');
		echo $exif===false ? "<b>No header data found.</b>\n" : "<b>Image contains headers</b><br />\n";
		if($exif){
			$exif = exif_read_data($img, 0, true);
			foreach ($exif as $key => $section) {
				foreach ($section as $name => $val) {
					if($key==="COMPUTED" and $name==="Height")
						echo "Height: $val<br />\n";
					else if($key==="COMPUTED" and $name==="Width")
						echo "Width: $val<br />\n";
					else if($key==="IFD0" and $name==="SamplesPerPixel")
						echo "SamplesPerPixel: $val<br />\n";
					else if($key==="IFD0" and $name==="BitsPerSample")
						echo "BitsPerSample: $val<br />\n";
					//echo "$key.$name: $val<br />\n";
				}
			}
		}
		}
		else
		   echo "No image file found, I can't guess datatype and size...<br />\n";
    } 
?> 
