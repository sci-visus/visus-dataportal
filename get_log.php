<?php 
	require("req_login.php");
	
	$id=$_POST['id'];
  class MyDB extends SQLite3 {
      function __construct() {
         $this->open('db/conversion.db');
      }
   }
   
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   }

   $sql =<<<EOF
      SELECT params from Conversion WHERE id=$id;
EOF;

   $ret = $db->query($sql);
   
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) { 
	  $params=json_decode($row['params']);
          
          $log=file_get_contents($params->{'dir'}."/convert.log");
          echo $log;
	
	  $ret = $db->exec($sql);
	   if(!$ret) {
		  echo $db->lastErrorMsg();
	   } 
	   $db->close();
	  break;
   } 

   
?>

