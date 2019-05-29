 
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
    <progress id='progressor' value="0" max='100' style=""></progress>  
    <span id="percentage">0</span> <br/>
    <span id="fname">Downloading...</span>
    <br/>
</body>
</html>

<?php
  require('req_login.php');
  require('local.php');

  $box_url=strip_tags(trim($_POST["url"]));
  $url_parts=parse_url($box_url);
  //print_r($url_parts);
  $port=parse_url($mod_visus_url)["port"];

  $res_id = explode('/', $url_parts['path'])[2];
  //print_r(explode('/', $url_parts['path'])[2]);

  $folder_id=$res_id;
  
  include('ext/BoxPHPAPI/BoxAPI.class.php');
 
  $client_id  = 'xd4r7ohya087jittg5cilu0v68g1yamk';
  $client_secret  = 'uNcNHCUk0oAzz1yC14r5hRzBtYxRIj8t';
  $redirect_uri   = 'http://127.0.0.1';
  if($port)
    $redirect_uri.=':'.$port;
  $redirect_uri.='/box.php';
  
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
  
  // User details
  //$box->get_user();
  
  // Get folder details
  $fdetails=$box->get_folder_details($folder_id);
  $folder_name=$fdetails['name'];

  //echo "<br/><br/>";

  // Get folder items list
  //print_r($box->get_folder_items($folder_id));
  
  //echo "<br/><br/>";
  // All folders in particular folder
  //$box->get_folders($folder_id);
  
  // All Files in a particular folder
  $files = $box->get_files($folder_id);
  
  //print_r($files);
  //print(count($files));

  $dir_path=$data_dir."/".$res_id;
  if (!file_exists($dir_path)) {
    mkdir($dir_path, 0770, true);
  }

  $count=count($files);

  ob_flush();
  flush();

  foreach($files as $i=>$f) {
    $box->download_file($f['id'], $dir_path."/".$f['name']);
    //printf("File %s downloaded... %.0f\%\n", $f['name'], ($i*100)/$count);
    //echo "File ".$f['name']." downloaded ".($i*100)/$count."%</br>";

    $curr_perc=ceil((($i+1)*100)/$count);
    echo '<script language="javascript">',
         'var pBar = document.getElementById("progressor");',
         'pBar.value='.$curr_perc.';',
         'var perc = document.getElementById("percentage");',
         'perc.innerHTML = '.$curr_perc.'+"%";',
         'var fname = document.getElementById("fname");',
         'fname.innerHTML = "Downloading: '.$f['name'].'";',
         '</script>';

    ob_flush();
    flush();
  }

  echo '<script language="javascript"> window.location = "/upload/index.php?box='.$res_id.'&name='.$folder_name.'"; </script>';
  //header('Location: /upload/index.php?box='.$res_id.'&name='.$folder_name);

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
