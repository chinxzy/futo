<?php 
  require_once 'Dependencies.php';
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

 $target_dir = "Uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



if ($_FILES["fileToUpload"]["size"] > 500000) {
    # "Sorry, your file is too large."; To do..... echoback with json_encode
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    # "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";To do..... echoback with json_encode
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    #"Sorry, your file was not uploaded."; To do..... echoback with json_encode
} 
else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        ## "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."; To do..... echoback with json_encode
    } 
	else {
        #echo "Sorry, there was an error uploading your file."; To do..... echoback with json_encode
    }
}

#To do store all receveived input into Mysql Database.....
	 echo json_encode(0);
?>