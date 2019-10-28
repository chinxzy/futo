<?php 
     session_start();
     require_once 'Dependencies.php';
     header("Content-Type: application/json; charset=UTF-8");
     $Instruction = json_decode($_POST["x"], false);

	 $C = ($Instruction->Count+1);
	 $sql = "SELECT * FROM Data ORDER BY UploadTime DESC";
     $result=$Connection->query($sql);
     $Data=array();
     $Data[0]=array('Size'=>($result->num_rows),'Check'=>(false),'DbLimit'=>($result->num_rows));
	 $count=1;
     for ( ; $count <= $Data[0]['Size']  ; ++$count)
     {
	   $row  = $result->fetch_array(MYSQLI_ASSOC);
	   $Data[$count]= array('Name'=>$row['Name'],'Phone'=>$row['Phone'],
	                       'Level'=>$row['Level'],'LodgeName'=>$row['LodgeName'],
	                       'Location'=>$row['Location'],'Description'=>$row['Description'],
	                       'Image'=>$row['Image']);
	 }

	 $Request[0]=array('Size'=>5);
	 $ReqCount=0;

	 #---Checking if the size of Request is more than what we have in database. if false.---
	 #---it just automatically makes the RequesSize the total size of whats in the Database---
	 if($Request[0]['Size'] > $Data[0]['Size'])
	 {
	  $ReqCount = $Data[0]['Size'];
	  $Request[0]['Size']=$ReqCount;
	  $Request[0]['Check']=false;
	 }
	
	 else
	 {
	      $ReqCount = 5;  #---if this is executed that means there are so much data in the database that needs to be splitted up into a number of request---
		   $Request[0]['Check']=true;
     }
	 #$--Request[0]['Check'] is for Client Side use only. for checking if the Server Used the original Request Count or Re-wrote it by using total number of data in DB--
	 

	 #----Transfering All Data To Request Array To be sent to the Client-----
	 for ($count = 1  ; $count <= $ReqCount ; ++$count)
     {
	   if(empty($Data[$C]))
	      break;

	   $Request[$count]= $Data[$C];
	   $C++;
	 }
	 $Request[0]['Size']=sizeof($Request);
	 
	 echo json_encode($Request);
?>