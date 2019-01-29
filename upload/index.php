<?php
require('../req_login.php');
require('../local.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<title>File manager</title>
        

		<!-- Require JS (REQUIRED) -->
		<!-- Rename "main.default.js" to "main.js" and edit it if you need configure elFInder options or any things -->
		<script data-main="./main.default.js" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.5/require.min.js"></script> -->
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
        
        <script src="../ext/bootstrap/jquery/jquery.min.js"></script>
        
        <script src="../ext/bootstrap/js/bootstrap.min.js"></script>
       
        <link rel="stylesheet" href="../ext/bootstrap/css/bootstrap.min.css">
        
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
 	
  <h2>Manage files on this server</h2>
  <p>Here you an manage your project folders containing your datasets.</p> 
    
  <nav class="navbar">
  <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li>
          <button type="button" class="btn btn-success navbar-btn" data-toggle="collapse" data-target="#filemanagerPanel">File Manager</button>
        </li>
        <li>
          <button type="button" class="btn btn-warning navbar-btn" data-toggle="collapse" data-target="#convertPanel">Convert</button>
        </li>
      </ul>
    </div>
   </nav>
   
   <div class="panel-group" id="convertPanel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            Convert
            <a class="collapsed" id="convertCollapseLink" data-parent="#convertPanel" data-toggle="collapse" href="#convertPanel" role="button"><span class="close">&times;</span></a>
          </h4>
        </div>
        
    <div class="panel-body">
        <div class="row">
          <div class="col-sm-6 mb-3 mb-md-0">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Single file</h5>
                <p class="card-text">Convert one single file.</p>
                <a href='javascript:selectConvert(1)' class="btn btn-primary">Convert</a>
              </div>
            </div>
          </div>
        
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Stack of images/files</h5>
                <p class="card-text">Convert a set of images/files into one dataset.</p>
                <a href="javascript:selectConvert(2)" class="btn btn-primary">Convert</a>
              </div>
            </div>
          </div>
        </div>
    </div>
   
          <div class="panel-footer">
        </div>
        
       </div>
    </div>
    
    
   
   <div class="panel-collapse collapse" id="imageSinglePanel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            Single Image/RAW Data Conversion
            <a class="collapsed" id="imagePanelCollapseLink" data-parent="#imageSinglePanel" data-toggle="collapse" href="#imageSinglePanel" role="button"><span class="close">&times;</span></a>
          </h4>
        </div>
        
        <div class="panel-collapse">
          <form class="form-horizontal" id="single_form" action="../convert.php" method="post" enctype="multipart/form-data">
          <div class="panel-body">
          <div class="form-row">
              <input type="hidden" name="data_dir" id="data_dir" value="<?php echo $data_dir;?>" />
              <label for="folder_path">Dataset file</label>
              <input type="text" id="folder_path" name="folder_path" class="form-control" onChange="javascript:fileChange()" />
              <button type="button" class="browse" id="imageUpload" onClick="javascript:browseFile(false)" > Browse </button>
			
          </div>
          <div class="form-row">
          <input id="convert-type" name="convert-type" type="hidden" value="single"/>
          
          <script type="text/javascript">
		  // TODO  better handle those selection variables
		    var elf_selected='';
			var was_folder=false;
			
			function processFile(file, is_folder){
				//console.log("selected file "+file);
				if(is_folder){
				  $("#folder_path_stack").val(file);
				  convertStackChange();
				}
				else {
				  $("#folder_path").val(file);
				  fileChange();
				}
			}
			function browseFile(is_folder){
				$('#fileModal').modal();
				var elf = $('#elfinder_select').elfinder({
					url : 'php/connector.minimal.php',  // connector URL (REQUIRED)
					getFileCallback : function(file) {
						processFile(file.url, is_folder);
						$('#fileModal').modal('hide');
					},
					commandsOptions: {
						getfile: {
							//oncomplete: 'destroy',
							folders  : false //is_folder
						}

					},
					handlers : {
						select : function(event, elfinderInstance) {
							var selected = event.data.selected;
							
							if (selected.length) {
							  elf_selected=elfinderInstance.url(selected[0]);
							  
							  was_folder=is_folder;
							}
	
						}
					},
					resizable: true
				}).elfinder('instance');
			}     
			
			function selectFile(){
				$('#fileModal').modal('hide');
				processFile(elf_selected, was_folder);
			}
				
				
          </script>
                
          <script>
              function fileChange(){
                   $.ajax({
                      type: "POST",
                      url: "../image_info.php",
					  data: { dir: $("#data_dir").val()+"/"+$("#folder_path").val() },
                    success: function (data, text) {
                      //console.log(data);
					  //console.log(text);
					  var res=jQuery.parseJSON(data);
					  if(res["err"]){
						  $("#stack_info").html(res["err"]);
					      $("#stack_info").show();
					  }else{
						  
						  var str="Dimensions: "+res["dims"]+"<br/>";
						  var fields=res["fields"]
						  for(var i = 0; i < fields.length; i++) {
								var f = fields[i];
								str+="Data type: "+f;
								var d = f.split("[");
								$("#single_form").find('#dtype').val(d[0]);
								if(d.length > 1)
								  $("#single_form").find('#ncomp').val(d[1].split("]"));
								else 
								  $("#single_form").find('#ncomp').val("1");
								//$("#single_form").find('#dtype>option:eq(2)').prop('selected', true);
						  }
						  
						  var dims = res["dims"].split(" ");
						  $("#single_form").find("#X").val(dims[0]);
						  $("#single_form").find("#Y").val(dims[1]);
						  $("#single_form").find("#Z").val(1);
						  
						  $("#img_info").html(str);
						  $("#img_info").show();
					  }
                    },
                    error: function (request, status, error) {
                        console.log( "Server error: " + error );
                    }
                  });
				 
              };
			  
              </script>
           <blockquote id="img_info" hidden="hidden"></blockquote>
          </div>
          
            <div class="form-row">
            <label>Size</label>
              <div class="col">
              <input type="text" class="form-control" id="X" name="X" size="1" placeholder="Size X"/>
              </div>
              <div class="col">
              <input type="text" class="form-control" id="Y" name="Y" size="1" placeholder="Size Y"/>
               </div>
              <div class="col">
              <input type="text" class="form-control" id="Z" name="Z" size="1" placeholder="Size Z"/>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
              <label for="dtype">Data Type</label>
              <select id="dtype" name="dtype" size="1" class="form-control">
                <option value="float32">float32</option>
                <option value="float64">float64</option>
                <option value="int32">int32</option>
                <option value="int64">int64</option>
                <option value="int8">int8</option>
                <option value="int16">unsigned int16</option>
                <option value="uint32">unsigned int32</option>
                <option value="uint64">unsigned int64</option>
                <option value="uint8">unsigned int8</option>
                <option value="uint16">unsigned int16</option>
              </select>
              </div>
              <div class="col">
              <label for="ncomp">Number of components</label>
              <select id="ncomp" name="ncomp" size="1" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
              </div>
            </div>
          
          </div>
          <div class="panel-footer"><button type="submit" class="btn btn-primary">Convert</button></div>
          </form>
        </div>
        
      </div>
    </div>
    
    <div class="panel-collapse collapse" id="imageStackPanel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            Stack Image/RAW Data Conversion
            <a class="collapsed" id="imageStackPanelCollapseLink" data-parent="#imageStackPanel" data-toggle="collapse" href="#imageStackPanel" role="button"><span class="close">&times;</span></a>
          </h4>
        </div>
        
        <div class="panel-collapse">
          <form class="form-horizontal" id="stack_form" action="../convert.php" method="post" enctype="multipart/form-data">
          <div class="panel-body">
          
          <div class="form-row">
              <input type="hidden" name="data_dir" id="data_dir" value="<?php echo $data_dir;?>" />
              <label for="folder_path_stack">Dataset folder</label>
              <input type="text" id="folder_path_stack" name="folder_path_stack" class="form-control" onChange="javascript:convertStackChange()" />
              <button type="button" class="browse" id="folderUpload" onClick="javascript:browseFile(true)" > Browse </button>
			
          </div>
          <div class="form-row">
          <input id="convert-type" name="convert-type" type="hidden" value="stack"/>
          
          <script>
              function convertStackChange(){
                   $.ajax({
                      type: "POST",
                      url: "../image_info_stack.php",
					  data: { dir: $("#data_dir").val()+"/"+$("#folder_path_stack").val() },
                    success: function (data, text) {
                      //console.log(data);
					  //console.log(text);
					  var res=jQuery.parseJSON(data);
					  if(res["err"]){
						  $("#stack_info").html(res["err"]);
					      $("#stack_info").show();
					  }else{
						  
						  var str="Single file dimensions: "+res["dims"]+"<br/>";
						  str+="Number of files: "+res["count"]+"<br/>";
						  var fields=res["fields"];
						  for(var i = 0; i < fields.length; i++) {
								var f = fields[i];
								str+="Data type: "+f;
								var d = f.split("[");
								$("#stack_form").find('#dtype').val(d[0]);
								if(d.length > 1)
								  $("#stack_form").find('#ncomp').val(d[1].split("]"));
								else 
								  $("#stack_form").find('#ncomp').val("1");
								//$("#single_form").find('#dtype>option:eq(2)').prop('selected', true);
						  }
						  
						  var dims = res["dims"].split(" ");
						  $("#stack_form").find("#X").val(dims[0]);
						  $("#stack_form").find("#Y").val(dims[1]);
						  $("#stack_form").find("#Z").val(res["count"]);
						  
						  $("#stack_info").html(str);
						  $("#stack_info").show();
					  }
                    },
                    error: function (request, status, error) {
                        console.log( "Server error: " + error );
                    }
					
                  });
				 
              };
			  
              </script>
           <blockquote id="stack_info" hidden="hidden"></blockquote>
          </div>
          
            <div class="form-row">
            <label>Size</label>
              <div class="col">
              <input type="text" class="form-control" id="X" name="X" size="1" placeholder="Size X"/>
              </div>
              <div class="col">
              <input type="text" class="form-control" id="Y" name="Y" size="1" placeholder="Size Y"/>
               </div>
              <div class="col">
              <input type="text" class="form-control" id="Z" name="Z" size="1" placeholder="Size Z"/>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
              <label for="dtype">Data Type</label>
              <select id="dtype" name="dtype" size="1" class="form-control">
                <option value="float32">float32</option>
                <option value="float64">float64</option>
                <option value="int32">int32</option>
                <option value="int64">int64</option>
                <option value="int8">int8</option>
                <option value="int16">unsigned int16</option>
                <option value="uint32">unsigned int32</option>
                <option value="uint64">unsigned int64</option>
                <option value="uint8">unsigned int8</option>
                <option value="uint16">unsigned int16</option>
              </select>
              </div>
              <div class="col">
              <label for="ncomp">Number of components</label>
              <select id="ncomp" name="ncomp" size="1" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
              </div>
            </div>
          
          </div>
          <div class="panel-footer"><button type="submit" class="btn btn-primary">Convert</button></div>
          </form>
        </div>
        
      </div>
    </div>
   
     <div class="panel-group collapse" id="filemanagerPanel">
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
    </div>
    
    <script>
	
	$('#imageSinglePanel').on('show.bs.collapse', function (e) {
		$.ajax({
				  type: "POST",
				  url: "../list_folders.php",
				success: function (data, text) {
					//console.log(data);
				    $("#folder_path").html(data);
					fileChange();
				  
				},
				error: function (request, status, error) {
					console.log( "Server error: " + error );
				}
			  });
			  
		$('#filemanagerPanel').removeClass("in"); // workaround to collapse the panel
		$('#convertPanel').addClass("collapse");
		$('#imageStackPanel').collapse("hide");
		
	});
	
	$('#imageStackPanel').on('show.bs.collapse', function (e) {
		$.ajax({
				  type: "POST",
				  url: "../list_folders.php",
				success: function (data, text) {
					//console.log(data);
				    $("#folder_path_stack").html(data);
					convertStackChange();
				  
				},
				error: function (request, status, error) {
					console.log( "Server error: " + error );
				}
			  });
			  
		$('#filemanagerPanel').removeClass("in"); // workaround to collapse the panel
		$('#convertPanel').addClass("collapse");
		$('#imageSinglePanel').collapse("hide");
		
	});
	
	$('#filemanagerPanel').on('show.bs.collapse', function (e) {
		$('#imageSinglePanel').collapse("hide");
		$('#imageStackPanel').collapse("hide");
	});
	
	function selectConvert(n){
		if (n ==1){
			$("#imageSinglePanel").collapse("show");
			$("#convertPanel").collapse("hide");
			$('#filemanagerPanel').collapse("hide");
		}
		else if (n ==2){
			$("#imageStackPanel").collapse("show");
			$("#convertPanel").collapse("hide");
			$('#filemanagerPanel').collapse("hide");
		}
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
    
	</body>
   
</html>
