<?php 
   require("req_login.php");
   
    if(!empty($_POST)){ 
	    $dir=$_POST['dir'];
		$img="";
        $dp = opendir ($dir);
		$img_found=false;
		$img_count=0;
        while ($f = readdir($dp)){
			//echo $dir."/".$f."\n";
            $file_parts = pathinfo($dir."/".$f);
			
			$ext = $file_parts['extension'];
			if($ext==="jpg" or $ext==="jpeg" or $ext==="tiff" or $ext==="tif" or $ext==="png" ) {
                if(!$img_found){
				  $img=$dir."/".$f;
				  $img_found=true;
				}
				
				$img_count=$img_count+1;
			}
            
		}
		
		if($img!=""){
			$output=shell_exec("scripts/image_info.sh \"$visus_exe\" \"$img\"");
		   //echo $output;
		   
		   $dpos=strpos($output,"< dims=");
		   $formatpos=strpos($output,"format=");
		   $edpos=strpos($output,"</>");
		   $fpos=strpos($output,"<fields>");
		   $efpos=strpos($output,"</fields>")+strlen("</fields>");
		   $dtypeinfo=substr($output, $fpos, $efpos-$fpos);
		   
		   //print htmlspecialchars($dtypeinfo);
		  
		   $dims=substr($output, $dpos+8, $formatpos-$dpos-strlen("format=")-3);
		   //echo "Image dims: $dims<br />\n";
		   
		   $dom=new DOMDocument();
		   $dom->loadXML($dtypeinfo);
		
		   $root=$dom->documentElement;
		   $fields=$root->getElementsByTagName('field');
		   $fields_array=array();
		   $f_count=0;
		   foreach ($fields as $field) {
			   //$fieldname=$field->getAttribute("name");
			   $dtype=$field->getAttribute("dtype");
			   $fields_array[$f_count]=$dtype;
			   $f_count++;
			   //echo "DataType: $dtype<br />\n";
		   }
		   
		   $res = array('dims' => $dims, 'fields' => $fields_array, 'count' => $img_count);
           $json_res = json_encode($res);
		   echo $json_res;
		   
		   //echo "Num images: $img_count<br />\n";
			
		/*	// Use EXIF info
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
		}*/
		}
		else
		   echo json_encode(array("err" => "No image file found, I can't guess datatype and size...<br />\n"));
    } 
?> 
