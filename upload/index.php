<?php
require('../req_login.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<title>File manager</title>
        
        <link rel="stylesheet" href="../ext/bootstrap-3.3.7/css/bootstrap.min.css">
        <script src="../ext/bootstrap-3.3.7/jquery/jquery.min.js"></script>
        <script src="../ext/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    

		<!-- Require JS (REQUIRED) -->
		<!-- Rename "main.default.js" to "main.js" and edit it if you need configure elFInder options or any things -->
		<script data-main="./main.default.js" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.5/require.min.js"></script>
		<script>
			define('elFinderConfig', {
				// elFinder options (REQUIRED)
				// Documentation for client options:
				// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
				defaultOpts : {
					url : 'php/connector.minimal.php' // connector URL (REQUIRED)
					,commandsOptions : {
						edit : {
							extraOptions : {
								// set API key to enable Creative Cloud image editor
								// see https://console.adobe.io/
								creativeCloudApiKey : '',
								// browsing manager URL for CKEditor, TinyMCE
								// uses self location with the empty value
								managerUrl : ''
							}
						}
						,quicklook : {
							// to enable CAD-Files and 3D-Models preview with sharecad.org
							sharecadMimes : ['image/vnd.dwg', 'image/vnd.dxf', 'model/vnd.dwf', 'application/vnd.hp-hpgl', 'application/plt', 'application/step', 'model/iges', 'application/vnd.ms-pki.stl', 'application/sat', 'image/cgm', 'application/x-msmetafile'],
							// to enable preview with Google Docs Viewer
							googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/postscript', 'application/rtf'],
							// to enable preview with Microsoft Office Online Viewer
							// these MIME types override "googleDocsMimes"
							officeOnlineMimes : ['application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation']
						}
					}
					// bootCalback calls at before elFinder boot up 
					,bootCallback : function(fm, extraObj) {
						/* any bind functions etc. */
						fm.bind('init', function() {
							// any your code
						});
						// for example set document.title dynamically.
						var title = document.title;
						fm.bind('open', function() {
							var path = '',
								cwd  = fm.cwd();
							if (cwd) {
								path = fm.path(cwd.hash) || null;
							}
							document.title = path? path + ':' + title : title;
						}).bind('destroy', function() {
							document.title = title;
						});
					}
				},
				managers : {
					// 'DOM Element ID': { /* elFinder options of this DOM Element */ }
					'elfinder': {}
				}
			});
		</script>
        
        <style>
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
  <div class="container" style="margin-top: 50px">
 	
  <h2>Manage files on this server</h2>
  <p>Here you an manage your project folders containing your datasets.</p> 
    
  <nav class="navbar">
  <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li>
          <button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target="#fileManagerModal">File Manager</button>
        </li>
        <li>
          <button type="button" class="btn btn-warning navbar-btn" data-toggle="collapse" data-target="#imagePanel1">Convert Image Data</button>
        </li>
      </ul>
    </div>
   </nav>
   
   <div class="panel-group collapse" id="imagePanel1">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            Image Data Conversion
          </h4>
        </div>
        <div class="panel-collapse">
          <div class="panel-body">Select dataset folder
          <div class="form-group">
          <select id="folder-select" name="folder-select" size="1" class="form-control">
		  <option value="-1"></option>
          <?php 		
			$dir = "../upload/files/";
			$dp = opendir ($dir);
			while ($folder = readdir($dp)){
				if(!is_file($folder) AND (substr($folder,0,1)!='.')){
					$folders = explode (' ', $folder);
					foreach ($folders as $index => $map){
						echo "<option value=\"$index\">$map</option>";
					}
				}
			}
			?>
          </select>
          
          <script>
		  $("#folder-select"). change(function(){
             var dir = $(this).children("option:selected").text();
			/* $.ajax({
				  type: "POST",
				  url: "list_files.php",
				success: function (data, text) {
				  
				},
				error: function (request, status, error) {
					console.log( "Server error: " + error );
				}
			  });*/ 
		  });
		  </script>
          
          <select id="dataset-type" name="dataset-type" size="1" class="form-control">
          <option></option>
          </select>
          
          </div>
          </div>
          <div class="panel-footer"></div>
        </div>
      </div>
    </div>
   
	<div id="fileManagerModal" class="modal fade modal-fullscreen" role="dialog">
          <div class="modal-dialog">
            <!-- Share Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">File Manager</h4>
              </div>
             
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
              <div class="modal-footer">
              
                 <button type="button" class="btn btn-default" data-dismiss="modal">I'm done with those files</button> 
              </div>
            </div>
          </div>
        </div>
		
   </div>
   
	</body>
</html>
