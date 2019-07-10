<?php $module_id = basename(__FILE__, '.php'); ?>

<div class="panel-collapse" id="<?php print $module_id; ?>_panel">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        Single Image/RAW Data Conversion
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