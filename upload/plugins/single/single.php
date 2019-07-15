<?php
  require("../../../req_login.php");
   
  $module_id = basename(__FILE__, '.php'); ?>

   <div class="panel-collapse" id="<?php print $module_id; ?>_panel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            Single Image/RAW Data Conversion
            <a class="collapsed" id="imagePanelCollapseLink" data-parent="#<?php print $module_id; ?>Panel" data-toggle="collapse" href="#<?php print $module_id; ?>Panel" role="button"><span class="close">&times;</span></a>
          </h4>
        </div>
        
        <div class="panel-collapse">
          <form class="form-horizontal" id="single_form" action="<?php print "plugins/".$module_id."/".$module_id."_submit.php"; ?>" method="post" enctype="multipart/form-data">
          <div class="panel-body">
          <div class="form-row">
              <input type="hidden" name="data_dir" id="data_dir" value="<?php echo $data_dir;?>" />
              <label for="folder_path">Dataset file</label>
              <input type="text" id="folder_path" name="folder_path" class="form-control" onChange="javascript:fileChange()" />
              <button type="button" class="btn btn-warning" id="imageUpload" onClick='javascript:browseFile("folder_path")' > Browse </button>
			
          </div>
          <div class="form-row">
          <input id="convert-type" name="convert-type" type="hidden" value="single"/>
          
          <script type="text/javascript">
		        var elf_selected='';

      			function browseFile(target){
      				$('#fileModal').modal();
      				target_selected=target;
      				
      				var elf = $('#elfinder_select').elfinder({
      					url : DATAPORTAL_ROOT_FOLDER+'ext/elfinder/php/connector.minimal.php',  // connector URL (REQUIRED)
      					getFileCallback : function(file) {
      						elf_selected=file.url;
                  selectFile();
      						
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
      							}
      	
      						}
      					},
      					resizable: true
      				}).elfinder('instance');
      			}     
      			
            function selectFile(){
                $('#fileModal').modal('hide');
                $("#folder_path").val(elf_selected)
                fileChange();
            }

              function fileChange(){
          				  var fullPath= $("#folder_path").val();
          				  var filename = fullPath.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
          				  var folderPath= fullPath.match(/(.*)[\/\\]/)[1]||'';
          				  $('#out_name_single').val(filename);
          				  $('#out_dir_single').val(folderPath);
          				  
                    $.ajax({
                      type: "POST",
                      url: DATAPORTAL_ROOT_FOLDER+"utils/image_info.php",
					            data: { dir: $("#data_dir").val()+"/"+$("#folder_path").val() },
                      success: function (data, text) {
                      console.log(data);
          					  console.log(text);
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
          
            <div class="input-group">
              <label>Size</label>
              <div class="col">
              <span class="input-group-btn"><input type="text" class="form-control" id="X" name="X" size="15" placeholder="Size X"/></span>
              
              <span class="input-group-btn"><input type="text" class="form-control" id="Y" name="Y" size="15" placeholder="Size Y"/></span>
               
              <span class="input-group-btn"><input type="text" class="form-control" id="Z" name="Z" size="15" placeholder="Size Z"/></span>
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
            
            <div class="form-row">
              <label for="out_dir_single">Output directory</label>
              <input type="text" id="out_dir_single" name="out_dir_single" class="form-control"/>
              <button type="button" class="btn btn-warning" id="folderOut" onClick='javascript:browseFile("out_dir_single")' > Browse </button>
            </div>
            <div class="form-row">
              <label for="out_name_single">Output name</label>
              <input type="text" id="out_name_single" name="out_name_single" class="form-control"/>
            </div>
            
          </div>
          <div class="panel-footer"><button type="submit" class="btn btn-primary">Convert</button></div>
          </form>
        </div>
        
      </div>
    </div>

