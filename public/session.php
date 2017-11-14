<?php 
	//validate login info
	include "database.php";
	session_start();



	//echo "session php".$_POST['username']."|".$_POST['password'] ;
	if(!empty($_POST['username']) && !empty($_POST['password'])){
		if(!($sqlQuery = $mysqli->query("select * from userdb where username = '".$_POST['username']."';"))) {
			die('Query error: '.mysqli_error($mysqli));
		}

		
		if($row = $sqlQuery->fetch_assoc()){
			if(password_verify($_POST['password'],$row['password'])){
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['age'] = $row['age'];
				$_SESSION['gender'] = $row['gender'];

				header('Location: index.php');				
			}
			else{
				//incorrect username / password

				header("location:login.php");
			}
		}
		else{
			//no username matches

			header("location:login.php");

		}

	}
	


 ?>