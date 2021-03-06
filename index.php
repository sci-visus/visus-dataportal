<?php
require('config.php');
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ViSUS DataPortal</title>

    <link rel="stylesheet" href="ext/bootstrap/css/bootstrap.min.css">
    <script src="ext/bootstrap/jquery/jquery.min.js"></script>
    <script src="ext/bootstrap/js/bootstrap.min.js"></script>
      
      <style>
	  .card{
	    padding-bottom: 20px;
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
    <div class="container" style="padding-top:20px">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">&gt;ViSUS DataPortal</h1>
        <p class="lead" style="text-align:center">Ciao, you are working on the host <b><?php print gethostname(); ?></b>, from here you can:</p>
        <!-- <a href="datasets.php" class="btn btn-primary btn-lg" >Configure</a> -->
      </header>

      <!-- Page Features -->
      <div class="row text-center justify-content-md-center">

        <div class="col-md-2 col-md-offset-3 box">
          <div class="card">
            <span style="font-size:70px" class="glyphicon glyphicon-th-list"></span>
           
            <div class="card-body">
              <h4 class="card-title">Configure</h4>
              <p class="card-text">Configure the data served by this ViSUS server installation.</p>
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
              <h4 class="card-title">Manage Data</h4>
              <p class="card-text">Manage, import and convert your data.</p>
            </div>
            <div class="card-footer">
              <a href="upload/" class="btn btn-primary">Data</a>
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
              <a href="viewer/" class="btn btn-primary">View</a>
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
    
    <div class="panel-group" id="conversionsPanel">
      <div class="panel panel-default" role="tab">
        <div class="panel-heading">
          <h4 class="panel-title">
            List of datasets on this server<a aria-controls="example1" aria-expanded="true" href="javascript:updateList()" role="button"><span class="glyphicon glyphicon-refresh close"></span></a>
          </h4>
        </div>
        
        <div class="panel">
        
          <div class="panel-body">
             
            <div class="table-responsive">

               <table class="table table-striped table-hover table-bordered" id="datasets">
                <!--
                <thead><tr><th>Name</th><th>Running</th><th>Type</th><th>Start Time</th><th>Log</th><th>Actions</th></tr></thead>-->
                
                <tbody>
                  
                </tbody>
                
               </table>
            </div>
  
   		   </div>
          <div class="panel-footer">
        </div>
        
      </div>
    </div>
    
    <script src="viewer/config.js"></script>
    <script>
	   function view(name){
		   var url="ext/visus/viewer.html?server="+encodeURI(DEFAULT_SERVER)+"&dataset="+encodeURI(name);
		   window.location=url;
	   }
	   
	   function updateList(){
			$.ajax({
			  type: "POST",
			  url: "list_datasets.php",
			success: function (data, text) {
				names=data.split(",");
				console.log(names);
				var rows;
				for(var i = 0; i < names.length; i++) {
					var n = names[i];
					if(n=="") continue;
					rows+="<tr><td>"+n+'</td><td><a type="button" class="btn btn-default navbar-btn" href=\'javascript:view(\"'+n+'\")\'>View</a></td></tr>';
				}
				
				$('#datasets > tbody').html(rows);
				
				/*$('#datasets > tbody > tr').each( function() {
				   var name=$(this).children("td:eq(1)").children("input").val();
				   if(names.indexOf(name) != -1){
					 $(this).children("td:eq(1)").attr("style", "color:green");
				   }
				   else
					 $(this).children("td:eq(1)").attr("style", "color:red");
				});*/
			  
			},
			error: function (request, status, error) {
				console.log( "Server error: " + error );
			}
		  });    
		}
	
	    updateList(); 
	</script>

  </body>

</html>
