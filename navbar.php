<?php
require('config.php');
?>

  <style>
.navbar
{
	border-bottom:1px solid #999;
	background: #F1F1F1;
}

.nav>li{
  padding-right: 10px;
  padding-left: 10px;
}
</style>
      
<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header"> 
    <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <a class="navbar-brand" href="https://www.visus.org"><image src="site_logo.gif" height="120%"/></a>
   </div>
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li>
      <button type="button" class="btn btn-default navbar-btn">
      <a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
      </button>
      </li>
      <li>
      <button type="button" class="btn btn-default navbar-btn">
      <a href="datasets.php"><span class="glyphicon glyphicon-th-list"></span>&nbsp;Configure</a>
      </button>
      <!--<button type="button" class="btn btn-primary navbar-btn btn-lg" onclick='javascript:location.href ="datasets.php"'>Data</button> -->
      </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li hidden>
      <button type="button" class="btn-info navbar-btn btn-lg" hidden>
          <a href="settings.php"><span class="glyphicon glyphicon-wrench"></span></a>
        </button>
      </li>
      <?php if(!empty($_SESSION['user'])){ ?>
      <li>
      <button type="button" class="btn btn-warning navbar-btn">
      <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a>
      </button>
      <?php } ?>
      </li>
	  
	  
    </ul>
   </div>
  </div>
  
 </nav>
