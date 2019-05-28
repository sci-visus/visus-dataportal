<?php

  include('ext/BoxPHPAPI/BoxAPI.class.php');
 
  $client_id  = 'xd4r7ohya087jittg5cilu0v68g1yamk';
  $client_secret  = 'uNcNHCUk0oAzz1yC14r5hRzBtYxRIj8t';
  $redirect_uri   = 'http://127.0.0.1:8000/box.php';
  
  $box = new Box_API($client_id, $client_secret, $redirect_uri);
  
  if(!$box->load_token()){
    if(isset($_GET['code'])){
      $token = $box->get_token($_GET['code'], true);
      if($box->write_token($token, 'file')){
        $box->load_token();
      }
    } else {
      $box->get_code();
    }
  }
  
  $folder_id='77869106217';
  
  // User details
  $box->get_user();
  
  // Get folder details
  //$box->get_folder_details($folder_id);
  
  // Get folder items list
  //print($box->get_folder_items($folder_id));
  
  // All folders in particular folder
  //$box->get_folders($folder_id);
  
  // All Files in a particular folder
  $files = $box->get_files($folder_id);
  
  print_r($files);

  $box->download_file($files[0]['id'], $files[0]['name']);

  print("\nfile ".$files[0]['name']." downloaded")

  /*
  // All Web links in a particular folder
  $box->get_links('FOLDER ID');
  
  // Get folder collaborators list
  $box->get_folder_collaborators('FOLDER ID');
  
  // Create folder
  $box->create_folder('FOLDER NAME', 'PARENT FOLDER ID');
  
  // Update folder details
  $details['name'] = 'NEW FOLDER NAME';
  $box->update_folder('FOLDER ID', $details);
  
  // Share folder
  $params['shared_link']['access'] = 'ACCESS TYPE'; //open|company|collaborators
  print_r($box->share_folder('FOLDER ID', $params));
  
  // Delete folder
  $opts['recursive'] = 'true';
  $box->delete_folder('FOLDER ID', $opts);
  
  // Get file details
  $box->get_file_details('FILE ID');
  
  // Upload file
  $box->put_file('RELATIVE FILE URL', 'FILE NAME', 'FOLDER ID');
  
  // Update file details
  $details['name'] = 'NEW FILE NAME';
  $details['description'] = 'NEW DESCRIPTION FOR THE FILE';
  $box->update_file('FILE ID', $details);
  
  // Share file
  $params['shared_link']['access'] = 'ACCESS TYPE'; //open|company|collaborators
  print_r($box->share_file('File ID', $params));
  
  // Delete file
  $box->delete_file('FILE ID');
  
  if (isset($box->error)){
    echo $box->error . "\n";
  }
  */

?>