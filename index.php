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
	background: #EAECF9;
}
</style>
      
</head>
<body>
<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header"> 
    <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <a class="navbar-brand" href="#"><image src="site_logo.gif" height="120%"/></a>
   </div>
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
      <li><button type="button" class="btn btn-primary navbar-btn" id='add' for-table='#datasets'>Add Dataset</button>
      </li>
    </ul>
   </div>
  </div>
  
 </nav>
 
<div class="container" style="margin-top:50px">
 	
  <h2>List of datasets</h2>
  <p>This is the list of the datasets on this server</p> 
    
<?php

$dom=new DOMDocument();
$dom->load("visus.config");

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
        },
//  debug: true,
});

$("#add").click(function(e){
    var table = $(this).attr('for-table');  //get the target table selector
    var $tr = $(table + ">tbody>tr:last-child").clone(true, true);  //clone the last row
    var nextID = parseInt($tr.find("input.tabledit-identifier").val()) + 1; //get the ID and add one.
    $tr.find("input.tabledit-identifier").val(nextID);  //set the row identifier
    $tr.find("span.tabledit-identifier").text(nextID);  //set the row identifier
    $(table + ">tbody").append($tr);    //add the row to the table
    $tr.find(".tabledit-edit-button").click();  //pretend to click the edit button
    $tr.find("input:not([type=hidden]), select").val("");   //wipe out the inputs.
});

</script>

</body>
</html>