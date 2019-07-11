<?php
  require("../../../req_login.php");
   
  $module_id = basename(__FILE__, '.php'); ?>

<div class="panel-collapse" id="<?php print $module_id; ?>_panel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            Stack Image/RAW Data Conversion
            <a class="collapsed" id="imageStackPanelCollapseLink" data-parent="#imageStackPanel" data-toggle="collapse" href="#imageStackPanel" role="button"><span class="close">&times;</span></a>
          </h4>
        </div>
        
        <div class="panel-collapse">
          <form class="form-horizontal" id="stack_form" action="<?php print
          "plugins/".$module_id."/".$module_id."_submit.php"; ?>" method="post" enctype="multipart/form-data">
          <div class="panel-body">
          
          <div class="form-row">
              <input type="hidden" name="data_dir" id="data_dir" value="<?php echo $data_dir;?>" />
              <label for="folder_path_stack">Dataset folder</label>
              <input type="text" id="folder_path_stack" name="folder_path_stack" class="form-control" onChange="javascript:convertStackChange()" />
              <button type="button" class="btn btn-warning" id="folderUpload" onClick='javascript:browseFile("folder_path_stack")' > Browse </button>
      
          </div>
            
          <div class="form-row">
          <input id="convert-type" name="convert-type" type="hidden" value="stack"/>
          
          <script>
            var elf_selected;

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

              function convertStackChange(){
                var fullPath= $("#folder_path_stack").val();
                var foldername = fullPath.split(/[\\/]/).pop();
                
                $('#out_name_stack').val(foldername);
                $('#out_dir_stack').val(fullPath);
                
               $.ajax({
                  type: "POST",
                  url: DATAPORTAL_ROOT_FOLDER+"utils/image_info_stack.php",
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

              function selectFile(){
                  $('#fileModal').modal('hide');
                  $("#folder_path_stack").val(elf_selected)
                  convertStackChange();
              }
        
              </script>
           <blockquote id="stack_info" hidden="hidden"></blockquote>
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
              <label for="out_dir_stack">Output directory</label>
              <input type="text" id="out_dir_stack" name="out_dir_stack" class="form-control"/>
              <button type="button" class="btn btn-warning" id="folderOutStack" onClick='javascript:browseFile("out_dir_stack")' > Browse </button>
            </div>
            <div class="form-row">
              <label for="out_name_stack">Output name</label>
              <input type="text" id="out_name_stack" name="out_name_stack" class="form-control"/>
            </div>
            
          </div>
          <div class="panel-footer"><button id="convert_stack_btn" type="submit" class="btn btn-primary">Convert</button></div>
          </form>
        </div>
        
      </div>
    </div>

<?php
    $box_id=strip_tags(trim($_GET['box']));
    $box_fname=strip_tags(trim($_GET['name']));

    // if Box import do automatic conversion
    if($box_id){
      echo '<script type="text/javascript">',
            '$("#folder_path_stack").val("'.$box_id.'");',
            '$("#folder_path_stack").change();',
            '$("#out_name_stack").val("'.$box_fname.'");',
            'setTimeout(function(){$("#convert_stack_btn").click();},2000);',
            '</script>';
    } 
?>
