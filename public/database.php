<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname= "testdb";

	$mysqli = mysqli_connect($servername, $username, $password, $dbname);
	if (!$mysqli)
	{		
		die('Could not connect to db: ' .mysqli_connect_error());
	}

	//$result = $mysqli->query("SELECT * FROM comments");
	//image database
	$result1 = $mysqli->query("CREATE TABLE imgDB(
		id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		userName varchar(30) not null,
		imgAddr varchar(30) not null,
		imgDescript varchar(30) not null
	)");
	//user database
	$mysqli->query("CREATE table IF NOT EXISTS userdb(
			id int(5) UNSIGNED auto_increment,	
			name varchar(20) not null,
			age int(3) not null,
			gender varchar(10) not null,
			email varchar(30) not null,
			username varchar(20) not null,
			password varchar(255) not null,
			primary key(id),
			UNIQUE (username)
	)");






	//echo (mysqli_num_rows($res) ? 1 : 2);
	
 ?>