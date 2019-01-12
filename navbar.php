<?php
require('config.php');
?>
<style>
.navbar
{
	border-bottom:1px solid #999;
	background: #F1F1F1;
}

.navbar-toggle
{
	background-color:#999;
}

.nav>li{
  padding-right: 10px;
  padding-left: 10px;
}

.navbar-nav>li>a:hover {
    color: black;
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
     <a class="navbar-brand" href="https://www.visus.org"><image src="site_logo.gif" height="200%"/></a>
   </div>
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li>
      <a href="index.php" class="btn btn-default navbar-btn">
      <span class="glyphicon glyphicon-home"></span>&nbsp;Home
      </a>
      </li>
      <?php // if(!empty($_SESSION['user'])){ ?>
      <li>
      <a href="datasets.php" class="btn btn-default navbar-btn">
      <span class="glyphicon glyphicon-th-list"></span>&nbsp;Configure
      </a>
      </li>
      <li>
      <a href="upload/" class="btn btn-default navbar-btn">
      <span class="glyphicon glyphicon-import"></span>&nbsp;Data
      </a>
      </li>
      <?php //} ?>
      <li>
      <a href="viewer/" class="btn btn-default navbar-btn">
      <span class="glyphicon glyphicon-picture"></span>&nbsp;View
      </a>
      </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      
      <?php if(!empty($_SESSION['user'])){ ?>
      <li>
      <a href="logout.php" class="btn btn-danger navbar-btn">
      <span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout
      </a>
      </li>
	  <?php } else { ?>
	  <li >
          <a class="btn btn-info navbar-btn" href="login.php"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Login</a>
      </li>
      <?php } ?>
    </ul>
   </div>
  </div>
  
 </nav>
