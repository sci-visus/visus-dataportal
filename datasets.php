<?php
require('req_login.php');

if(isset($_POST["config_path"])){
	 //echo "Set current config file to: ". htmlspecialchars($_POST["config_path"]);
	 $_SESSION["config_file"]=htmlspecialchars($_POST["config_path"]);	
}

if(!isset($_SESSION["config_file"]))
  $_SESSION["config_file"] = $default_config_file;
  
?>

<html lang="en">
<head>
<!-- Force latest IE rendering engine or ChromeFrame if installed -->
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta charset="utf-8">
<title>ViSUS Config</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap styles -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-tabledit@1.0.0/jquery.tabledit.min.js"></script>

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
 
<div class="container" style="margin-top: 50px">
 	
  <h2>List of datasets</h2>
  <p>This is the list of the datasets defined in the following config file:</p> 
  
    <form action="datasets.php" method="post" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="text" name="config_path" value="<?php echo $_SESSION["config_file"]; ?>"/>
        <button type="submit" class="btn btn-success">Reload</button>
    </form>

  <nav class="navbar">
  <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li>
          <button type="button" class="btn btn-default navbar-btn" id='add' for-table='#datasets'>Add Dataset</button>
        </li>
      </ul>
    </div>
   </nav>
<?php

$dom=new DOMDocument();
$dom->load($_SESSION["config_file"]);

$root=$dom->documentElement;

$datasets=$root->getElementsByTagName('dataset');

echo '<div class="table-responsive">';

echo '<table class="table table-striped table-hover table-bordered" id="datasets">';

echo "<thead>";
echo "<tr>",'<th hidden> Old Name</th>','<th>Name</th>','<th>URL</th>',"</tr>";
echo "</thead>";

echo "<tbody>";
foreach ($datasets as $dataset) {
	$name=$dataset->getAttribute('name');
	$url=$dataset->getAttribute('url');

#    $name=$dataset->getElementsByTagName('name')->item(0)->textContent;
	echo "<tr>","<td hidden>$name</td>",'<td style="word-wrap: break-word;min-width: 60px;max-width: 60px;">'."$name</td>",'<td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">'."$url</td>","</tr>";

}

echo "<tr hidden>","<td hidden>NaN</td>",'<td style="word-wrap: break-word;min-width: 60px;max-width: 60px;">'."</td>",'<td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">'."</td>","</tr>";

echo "</tbody>";
echo "</table>";
echo "</div>";

?>
</div>

<script>
$('#datasets').Tabledit({
	url: 'edit.php',
	columns: {
	  identifier: [0, 'old_name'],                    
	  editable: [[1, 'name'], [2, 'url']]
	},
  
  restoreButton: false,
	
  onAjax: function(action, serialize) { 
	
		console.log("on Ajax"); 
		console.log("action : ", action); 
		console.log("data : ", serialize); 
  },
	
  onSuccess: function(data, textStatus, jqXHR) {
      console.log(data);
      console.log(textStatus);
      console.log(jqXHR);
  },
  
  onFail: function(jqXHR, textStatus, errorThrown) {
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
	  
	  console.log("found "+ $("tr:last>td>span").text());
	  if($("tr:last>td>span")[0].innerHTML=="NaN") {
		  console.log("Invalid content, removing new dataset")
		  $("tr:last").remove();
	  }
  },
//  debug: true,
});

$("#add").click(function(e){
    var table = $(this).attr('for-table');  //get the target table selector
    var $tr = $(table + ">tbody>tr:last-child").clone(true, true);  //clone the last row
	$tr.show();
	
    var nextID = parseInt($tr.find("input.tabledit-identifier").val()) + 1; //get the ID and add one.
    $tr.find("input.tabledit-identifier").val(nextID);  //set the row identifier
    $tr.find("span.tabledit-identifier").text(nextID);  //set the row identifier
    $(table + ">tbody").append($tr);    //add the row to the table
    $tr.find(".tabledit-edit-button").click();  //pretend to click the edit button
    $tr.find("input, select").val("");   //wipe out the inputs.
	//$tr.find("input:not([type=hidden]), select").val("");   //was no hidden
	//$tr.find(".tabledit-edit-button").attr("disabled", "disabled");
	//$tr.find(".tabledit-delete-button").attr("disabled", "disabled");
});

</script>

</body>
</html>