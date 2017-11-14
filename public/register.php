<?php 
	include "database.php";
	//echo $_POST['name'];
	$nameErr = $ageErr = $genderErr = $emailErr = $usernameErr = $passwordErr = false;
	
	function verifyInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if(isset($_POST['submit'])){

		
		$name = verifyInput($_POST['name']);
		//only letters are allowed
		$nameErr = !ctype_alpha($name);

		$age = verifyInput($_POST['age']);
		$ageErr = !is_numeric($age);

		$gender = verifyInput($_POST['gender']);
		if(!($gender == "female" || $gender == "male")){
			$genderErr = true;
		}

		$email = verifyInput($_POST['email']);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = true; 
		}

		$username = verifyInput($_POST['username']);
		//only letters are allowed
		$usernameErr = !ctype_alpha($username);;

		$password = verifyInput($_POST['password']);
		//only letters and numbers
		$passwordErr = !ctype_alnum($password);

		if($nameErr || $ageErr || $genderErr || $usernameErr || $passwordErr){
			//any errors should go back login.php
			echo $name."|".$age."|".$gender."|".$email."|".$username."|".$password."<br>";
			echo $nameErr."|".$ageErr."|".$emailErr."|".$genderErr."|".$usernameErr."|".$passwordErr;
			//header("location:login.php");
		}
		else{
			$hashedpw = password_hash($password, PASSWORD_DEFAULT, array("cost" => 10));

			$mysqli->query("insert into userdb(name, age, gender, email, username, password) values(
				'$name', '$age', '$gender', '$email', '$username', '$hashedpw'
			)");


			//finished register process
			header("location:index.php");

		}


	}	
 ?>