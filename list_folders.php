<?php

require('req_login.php');

$dp = opendir ($data_dir);
while ($folder = readdir($dp)){
	if(!is_file($folder) AND (substr($folder,0,1)!='.')){
		$folders = explode (' ', $folder);
		foreach ($folders as $index => $map){
			echo "<option value=\"$map\">$map</option>";
		}
	}
}

?>