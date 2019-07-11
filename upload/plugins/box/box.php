<!-- This plugin depends on the plugin "stack" see bottom php stuff -->
<?php $module_id = basename(__FILE__, '.php'); ?>

<div class="panel-collapse" id="<?php print $module_id; ?>_panel">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        Box Data Conversion
        <a class="collapsed" id="imagePanelCollapseLink" data-parent="#imageSinglePanel" data-toggle="collapse" href="#imageSinglePanel" role="button"><span class="close">&times;</span></a>
      </h4>
    </div>
    
    <div class="panel-collapse">
      <form class="form-horizontal" action="<?php print "plugins/".$module_id."/".$module_id."_submit.php"; ?>" method="post" enctype="multipart/form-data">
      <div class="panel-body">
      <div class="form-row">
          <label for="url">Box folder URL</label>
          <input type="text" id="url" name="url" class="form-control"/>
          <button type="submit" class="btn btn-warning">Import</button>
  
        </div>
      </div>
     </form>
    </div>

    <div class="panel-footer">
    </div>
    
  </div>
</div>


<?php
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