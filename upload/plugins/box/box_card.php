<?php $module_id = basename(__FILE__, '_card.php'); ?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title"><img src="box_logo.jpg" width="80px"/></h5>
    <p class="card-text">Import files from Box</p>
    <?php if($box_client_id !== '' && $box_client_secret !== '') : ?>
    <a href='javascript:selectPlugin("<?php print $module_id; ?>")' class="btn btn-primary">Convert</a>
    <?php else : ?>
    <p class="card-text" style="color:red">Box client info are not defined properly in local.php</p>
    <?php endif; ?>
  </div>
</div>

