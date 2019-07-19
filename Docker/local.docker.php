
<?php 
  // This is a local site configuration file
	
  // Admin credentials for this server
  $admin_user="admin"; 
  $admin_password="password";
	
  // Default server config file location (on the server's filesystem)	
  $default_config_file="/home/OpenVisus/visus.config";

  // mod_visus_url
  $mod_visus_url="http://localhost:8080/mod_visus?";
 
  /**** The following are internal settings, do not change
         unless you know what you are doing                 ****/

  // Data input directory
  $data_dir="/data";

  // Data output directory
  $out_data_dir="/converted";
    
  // visus executable
  $visus_exe="/opt/conda/lib/python3.7/site-packages/OpenVisus/bin/visus";

  // box client id
  $box_client_id='';

  // box client secret
  $box_client_secret='';

 ?>