<?php
require('../req_login.php');
require('../local.php');

$plugins=array();

// use custom list of plugins
//$plugins=array("single", "stack");

// populate plugins
if (count($plugins) == 0 && $handle = opendir('plugins')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && !is_file($entry)) {
            array_push($plugins, $entry);
        }
    }
    closedir($handle);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<title>File manager</title>
        
        <script src="../local.js"></script>
		<script data-main="../ext/elfinder/main.default.js" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.5/require.min.js"></script> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <script src="../ext/bootstrap/jquery/jquery.min.js"></script>
        
        <script src="../ext/bootstrap/js/bootstrap.min.js"></script>
       
        <link rel="stylesheet" href="../ext/bootstrap/css/bootstrap.min.css">
        
        <style>
    .card-body {
      text-align: center;
    }
		.modal-dialog {
		  width: 100%;
		  height: 100%;
		  margin: 0;
		  padding: 0;
		}
		
		</style>
	</head>
	<body>

	<div id="nav-placeholder"></div>
	
      <div id="logModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Conversion Log</h4>
                  </div>
                  
                    <div class="col" style="padding:20px; text-align:center">
                      <textarea class="form-control" id="conv_log" style="min-width: 70%; min-height:500px"></textarea>
                    </div>
                    
                  <div class="modal-footer">
                    <button type="button" class="close" data-dismiss="modal">Close</button>
                  </div>
                </div>
          </div>
      </div>
      
      <div id="fileModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">File/Folder selection</h4>
                  </div>
                  
                    <div class="col" style="padding:20px; text-align:center">
                      <div id="elfinder_select"></div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="close" data-dismiss="modal" onClick="javascript:selectFile()">Select</button>
                  </div>
                </div>
          </div>
      </div>
   
   <script>
   function getLog(id){
	   $.ajax({
			  type: "POST",
			  url: "../get_log.php",
			  data: { id: id },
			success: function (data, text) {
			  //console.log(data);
			  $("#logModal").modal();
			  $("#conv_log").html(data);
			  
			},
			error: function (request, status, error) {
				console.log( "Server error: " + error );
			}
		  });
   }
   
   </script>
   
	<script>
    $(function(){
      $("#nav-placeholder").load("../navbar.php", function(){ 
         $("img[src='site_logo.gif']").attr('src', '../site_logo.gif');
         $("a[href='datasets.php']").attr('href', '../datasets.php');
         $("a[href='index.php']").attr('href', '../index.php');
         $("a[href='viewer/']").attr('href', '../viewer/');
		 $("a[href='upload/']").attr('href', '../upload/');
         $("a[href='logout.php']").attr('href', '../logout.php');
      } );
    });
    </script>
  <div class="container" style="margin-top: 70px">
   
   <div class="panel-group" id="convertPanel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            Plugins
           <!-- <a class="collapsed" id="convertCollapseLink" data-parent="#convertPanel" data-toggle="collapse" href="#convertPanel" role="button"><span class="close">&times;</span></a>-->
          </h4>
        </div>
        
        <div class="panel-body">
            <div class="row">
              <?php foreach($plugins as $plugin): ?>
                <div class="col-sm-4">
                  <?php require("plugins/".$plugin."/".$plugin."_card.php"); ?>
                </div>
              <?php endforeach; ?>
            </div>
       </div>
    </div>

    <div id="dynamic_panel"></div>
   
     <!-- <div class="panel-group collapse" id="filemanagerPanel">
      <div class="panel panel-default" role="tab">
        <div class="panel-heading">
          <h4 class="panel-title">
            Data File Manager <a aria-controls="example1" aria-expanded="true" data-parent="#filemanagerPanel" data-toggle="collapse" href="#filemanagerPanel" role="button"><span class="close">&times;</span></a>
          </h4>
        </div>
        
        <div class="panel-collapse">
        
          <div class="panel-body">
             
              <div id="elfinder"></div>
              
               <div class="panel panel-default" style="margin-top:80px">
        <div class="panel-heading">
            <h3 class="panel-title">Upload Notes</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>Image files (e.g., <strong>JPG, GIF, PNG, TIF</strong>) and <strong>RAW</strong> data are allowed.</li>
                <li>Create one folder for each different dataset to facilitate the conversion process</li>
            </ul>
        </div>
    </div>
    
    </div>
          <div class="panel-footer">
        </div>
        
      </div>
    </div>
    </div> -->
    
  <script>
    function selectPlugin(value){
      $("#dynamic_panel").load("plugins/"+value+"/"+value+".php");
    }
	</script>
   
   <script>
	  function updateConversions(){
		  $.ajax({
                      type: "POST",
                      url: "../db/list_conversions.php",
                    success: function (data, text) {
                      //console.log(data);
					  //console.log(text);
					  $("#conversions>tbody").html(data);
                    },
                    error: function (request, status, error) {
                        console.log( "Server error: " + error );
                    }
                  });
	  }
					  
    </script>

    <div class="panel-group" id="conversionsPanel">
      <div class="panel panel-default" role="tab">
        <div class="panel-heading">
          <h4 class="panel-title">
            Conversions History<a aria-controls="example1" aria-expanded="true" href="javascript:updateConversions()" role="button"><span class="glyphicon glyphicon-refresh close"></span></a>
          </h4>
        </div>
        
        <div class="panel">
        
          <div class="panel-body">
             
            <div class="table-responsive">

               <table class="table table-striped table-hover table-bordered" id="conversions">
                
                <thead><tr><th>Name</th><!--<th>Status</th>--><th>Running</th><th>Type</th><th>Start Time</th><th>Log</th><th>Actions</th></tr></thead>
                
                <tbody>
                  
                </tbody>
                
               </table>
            </div>
  
   		   </div>
          <div class="panel-footer">
        </div>
        
      </div>
    </div>
    
    <script>
	    updateConversions(); 
	</script>

  <script>
    function post(path, params, method='post') {

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    const form = document.createElement('form');
    form.method = method;
    form.action = path;

    for (const key in params) {
        if (params.hasOwnProperty(key)) {
          const hiddenField = document.createElement('input');
          hiddenField.type = 'hidden';
          hiddenField.name = key;
          hiddenField.value = params[key];

          form.appendChild(hiddenField);
        }
      }

      document.body.appendChild(form);
      form.submit();
    }
 </script>

  <?php
    // TODO move this in the box plugin
    $box_id=strip_tags(trim($_GET['box']));
    $box_fname=strip_tags(trim($_GET['name']));

    // if Box import do automatic conversion
    if($box_id){
      echo '<script type="text/javascript">',
            'selectPlugin("stack");',
            '$("#folder_path_stack").val("'.$box_id.'");',
            '$("#folder_path_stack").change();',
            '$("#out_name_stack").val("'.$box_fname.'");',
            'setTimeout(function(){$("#convert_stack_btn").click();},2000);',
            '</script>';
    } 
  ?>

	</body>


   
</html>
