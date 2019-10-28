<?php 
     session_start();
     require_once 'Dependencies.php';
     header("Content-Type: application/json; charset=UTF-8");
     $UserInfo=json_decode($_POST["x"], false);

     $Name =  $_POST['uname'];
     $Phone =  $_POST['phone'];
     $Level =     $_POST['level'];
     $Location=   $_POST['location'];
     $LodgeName= $_POST['lodge'];
     $Description= $_POST['description'];
     $Image = $_FILES["filename"]["name"];

     $target_dir = "Uploads/";
     $target_file = $target_dir . basename($_FILES["filename"]["name"]);

     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

     if($imageFileType != "jpg" && $imageFileType != "png" && 
         $imageFileType != "jpeg" && $imageFileType != "gif" ){
         header("Location: ErrorPage/j_Img.html");//echo json_encode("Sorry, only JPG, JPEG, PNG & GIF files are allowed");
     return;}

    else {
      move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file); 
	}

    if (!preg_match("/^[0-9]*$/",$Level)) {
               header("Location: ErrorPage/j_Level.html"); // echo json_encode("Only Values are allowed in your Level details input field, e.g 100, 200,...500");
	   return; }

    elseif (!preg_match("/^[0-9]*$/",$Phone)){
		    header("Location: ErrorPage/j_Phone.html"); //echo json_encode("Only Values are allowed in your Phone details input field, e.g 08022222222");
			return;}

	elseif (!preg_match("/^[a-zA-Z0-9]*$/",$Name)) {
	         header("Location: ErrorPage/j_Name.html"); //echo json_encode("Only Numbers and Values are allowed for your Username field, no special characters are required");
			 return;}

    else{
	      #----Succefully uploaded redirecting to Home Page----
		$Sql = "INSERT INTO Data (Name, Phone, Level, LodgeName, Location, Description, Image) 
        VALUES ('$Name' ,'$Phone','$Level', '$Location', '$LodgeName', '$Description', '$Image')";
	    $Connection->query($Sql);
		header("Location: ../Client/j.html");}
?>