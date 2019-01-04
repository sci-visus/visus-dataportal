<?php

$cSession = curl_init(); 

curl_setopt($cSession,CURLOPT_URL,"http://localhost/mod_visus?action=list");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 

$result=curl_exec($cSession);

$dom=new DOMDocument();
$dom->loadXML($result);

$root=$dom->documentElement;

$datasets=$root->getElementsByTagName('dataset');

$str_datasets="";
foreach ($datasets as $dataset) {
	$name=$dataset->getAttribute('name');
	$url=$dataset->getAttribute('url');
	$str_datasets = $str_datasets.",". $name;
}
curl_close($cSession);

echo "$str_datasets";
?>