<?php
require('config.php');
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ViSUS DataPortal</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/heroic-features.css" rel="stylesheet">

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
      
</head>
<body>
 <div id="nav-placeholder"></div>
<script>
$(function(){
  $("#nav-placeholder").load("navbar.php");
});
</script>

    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">&gt;Welcome to the ViSUS DataPortal</h1>
        <p class="lead" style="text-align:center">From here you can configure your ViSUS server and import/convert your data.</p>
        <!-- <a href="datasets.php" class="btn btn-primary btn-lg" >Explore the data on this server</a> -->
      </header>

      <!-- Page Features -->
      <div class="row text-center justify-content-md-center">

        <div class="col-md-2 col-md-offset-3 box">
          <div class="card">
            <span style="font-size:70px" class="glyphicon glyphicon-th-list"></span>
           
            <div class="card-body">
              <h4 class="card-title">List and configure</h4>
              <p class="card-text">Explore and configure the data served by this ViSUS server installation.</p>
            </div>
            <div class="card-footer">
              <a href="datasets.php" class="btn btn-primary">Configure</a>
            </div>
          </div>
        </div>

        <div class="col-md-2 box">
          <div class="card">
            <span style="font-size:70px" class="glyphicon glyphicon-import"></span>
            <div class="card-body">
              <h4 class="card-title">Import data</h4>
              <p class="card-text">Import data from image format and NetCDF files.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Import Data</a>
            </div>
          </div>
        </div>

        <div class="col-md-2 box">
          <div class="card">
            <span style="font-size:70px" class="glyphicon glyphicon-picture"></span>
            <div class="card-body">
              <h4 class="card-title">Explore Data</h4>
              <p class="card-text">Visualize data currently hosted on this ViSUS server.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">View</a>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark" hidden>
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; ViSUS.org 2019</p>
      </div>
      <!-- /.container -->
    </footer>

  </body>

</html>
