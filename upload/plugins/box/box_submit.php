 <?php
  require('../../../req_login.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>ViSUS Data Portal - Import from Box</title>
  <style>
    body{margin:0;}
progress{display:inline-block;vertical-align:baseline;}
@media print{
*,:after,:before{color:#000!important;text-shadow:none!important;background:0 0!important;-webkit-box-shadow:none!important;box-shadow:none!important;}
}
*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff;}
h4{font-family:inherit;font-weight:500;line-height:1.1;color:inherit;}
h4{margin-top:10px;margin-bottom:10px;}
h4{font-size:18px;}
.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;-webkit-overflow-scrolling:touch;outline:0;}
.modal-dialog{position:relative;width:auto;margin:10px;}
.modal-content{position:relative;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #999;border:1px solid rgba(0,0,0,.2);border-radius:6px;outline:0;-webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);box-shadow:0 3px 9px rgba(0,0,0,.5);}
.modal-header{padding:15px;border-bottom:1px solid #e5e5e5;}
.modal-title{margin:0;line-height:1.42857143;}
@media (min-width:768px){
.modal-dialog{width:600px;margin:30px auto;}
.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,.5);box-shadow:0 5px 15px rgba(0,0,0,.5);}
}
.modal-header:after,.modal-header:before{display:table;content:" ";}
.modal-header:after{clear:both;}
.show{display:block!important;}
</style>
</head>

<body>
  <div id="downloadModal" class="modal show" role="dialog">
          <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Downloading from Box...</h4>
                  </div>
                    <div class="col" style="padding:20px; text-align:center">
                      <progress id="progressor" value="0" max="100" style=""></progress>  
                      <span id="percentage">0</span> <br/>
                      <span id="fname">Downloading...</span>
                    </div>
                </div>
          </div>
      </div>
</body>
</html>


<?php

  $box_url=strip_tags(trim($_POST["url"]));
  $url_parts=parse_url($box_url);
  //print_r($url_parts);
  $port=parse_url($mod_visus_url)["port"];

  if(isset($_GET['res_id']))
    $res_id=$_GET['res_id'];
  else
    $res_id = explode('/', $url_parts['path'])[2];
  //print_r(explode('/', $url_parts['path'])[2]);

  $folder_id=$res_id;
  
  include('../../../ext/BoxPHPAPI/BoxAPI.class.php');
 
  $client_id  = $box_client_id;
  $client_secret  = $box_client_secret;
  $redirect_uri   = 'http://127.0.0.1';
  if($port)
    $redirect_uri.=':'.$port;
  $redirect_uri.='/upload/plugins/box/box_submit.php?res_id='.$res_id;
  
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

  // refresh page if token just acquired
  if(isset($_GET['res_id']) && !isset($_GET['refresh'])){
    echo '<script language="javascript"> window.location = "/upload/plugins/box/box_submit.php?code='.$_GET['code'].'&res_id='.$_GET['res_id'].'&refresh=1"; </script>';
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
    //usleep(20000);
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

  echo '<script language="javascript"> window.location = "/upload/index.php?plugin=stack&box='.$res_id.'&name='.$folder_name.'"; </script>';
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
