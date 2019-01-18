<?php
require("local.php");
$cSession = curl_init(); 

curl_setopt($cSession,CURLOPT_URL,"$mod_visus_url"."action=configure_datasets");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 

$result=curl_exec($cSession);

curl_close($cSession);

echo "done $result";
?>