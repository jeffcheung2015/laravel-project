<?php 
include "database.php";

session_start();

$target_dir = "uploadImgs/";
if($_FILES["fileToUpload"]["name"]==""){
	header("Location: upload.php");
}
//basename is extracting the file name with extension without the parent path
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		$uploadOk = 1;
	} else {
		$uploadOk = 0;
	}
}


//$_FILES["fileToUpload"]["tmp_name"] is the temp file path stored for the uploaded file, the file name is randomly chosen;
//$_FILES["fileToUpload"]["name"] is the file path with a fake parent client path and real file name named in client computer.
//move_uploaded_file() is used to move the temp file from temp folder to exact target location. 

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

$imgd = $_POST["imgDescript"];

echo $_SESSION['username'];
//database insert
$query = $mysqli->query("insert into imgDB(userName, imgAddr,imgDescript) values ('".$_SESSION['username']."','$target_file', '$imgd')");


//redirect back to index.php
header('Location: index.php'); 
?>

