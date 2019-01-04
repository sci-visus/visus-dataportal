<?php

session_start();

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	
}

$config_file=$_SESSION["config_file"];

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.
header('Content-Type: application/json');

// CHECK REQUEST METHOD
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $input = filter_input_array(INPUT_POST);
} else {
  $input = filter_input_array(INPUT_GET);
}
//var_dump($input);
//file_put_contents("debug.txt", ob_get_clean());

if($input['name'] === '' or $input['url'] === ''){
	echo "invalid input";
	return;
}

$dom=new DOMDocument();
$dom->load($config_file);

$root=$dom->documentElement;

$datasets=$root->getElementsByTagName('dataset');

if ($input['old_name'] === 'NaN') {
	   $newel=$dom->createElement("dataset");
	   $newel->setAttribute("name",$input["name"]);
	   $newel->setAttribute("url", $input["url"]);
           $newel->setAttribute("permissions", "public");
	   $root->appendChild($newel);
  }else{  
	foreach ($datasets as $dataset) {
		$name=$dataset->getAttribute('name');
		// find the old_name (name before the edit in the config file)
		if($name === $input["old_name"]){
			if ($input['action'] === 'edit') {
			  $dataset->setAttribute("name", $input["name"]);
			  $dataset->setAttribute("url", $input["url"]);
			} else if ($input['action'] === 'delete') {	
			  $dataset->parentNode->removeChild($dataset);
			}
		}
	}
}

$dom->save($config_file);

// RETURN OUTPUT
echo json_encode($input);

?>