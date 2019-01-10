<?php 
	require("../req_login.php");
	
	function isRunning($pid){
			try{
				$result = shell_exec(sprintf("ps %d", $pid));
				if( count(preg_split("/\n/", $result)) > 2){
					return true;
				}
			}catch(Exception $e){}
		
			return false;
	}
	
  class MyDB extends SQLite3 {
      function __construct() {
         $this->open('conversion.db');
      }
   }
   
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   }

   $sql =<<<EOF
      SELECT * from Conversion ORDER BY time DESC;
EOF;

   $ret = $db->query($sql);
   
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
	 $pid = $row['pid'];
     $status = $row['status'];
     $name = $row['name'];
     $isrun= isRunning($pid)?"YES":"NO";
   
	  echo '<tr>\n';
      echo "<td>". $row['name'] . "</td>\n";
      
	  $params=json_decode($row['params']);
      $log=file_get_contents($params->{'dir'}."/convert.log");
	  if(strpos($log, "All done") !== false){
		if($status!=="DONE"){
        $sql =<<<EOF
	    UPDATE Conversion set status = "DONE" where name="$name";
EOF;
          $ret = $db->query($sql);
	      $status="DONE";
		}
	  }
	  else if(strpos($log, "Error") !== false){
		  $status="ERROR";
	  }
	  
	  echo "<td>". $status ."</td>\n";
	  
	  echo "<td>". $isrun ."</td>\n";
      echo "<td>". $row['type'] ."</td>\n";
	  echo "<td>". $row['time'] ."</td>\n";
	  echo "<td><a class=\"btn btn-warning\" href=\"javascript:getLog(".$row['id'].")\">Log</a></td>\n";
	  
	 // if($status==="DONE"){
	  echo '<td> <form action="../datasets.php" method="post" enctype="multipart/form-data"> 
                        <input type="hidden" name="furl" id="furl" value="'.$params->{"dir"}."/".$params->{"fname"}.".idx".'" />                          
                        <input type="hidden" name="fname" id="fname" value="'.$params->{"fname"}.'" /> 
                        <input type="submit" id="fadd" class="btn btn-info" value="Add to server"/> 
                </form> </td>';
	  //}else
	  //echo "<td/>";
	
	  echo '</tr>\n';
	  echo '</tr>\n';
   } 

   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } 
   $db->close();
?>

