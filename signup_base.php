<?php
	$user = 'root';
	$password = '123456';
	$db = 'inventory';
	$host = '127.0.0.1';
	$port = 3306;
	
	$conn = new mysqli(
	   $host, 
	   $user, 
	   $password,
	   "myDB",
	   3306
	);
	$username = isset($_POST["username"])?$_POST["username"]:"";

	$sql = "SELECT id,username FROM user where username = '$username'";
	$result = $conn->query($sql);
	$int = $result->num_rows;
	if($result->num_rows === 0){
		$sql = "INSERT INTO user (username) VALUES ('$username')";
		$conn->query($sql);
		$ret = array("info"=>"success!");

	}else{
		$ret = array("info"=>"Username already exist -.-");
	};

	echo json_encode($ret);

	
	
	
	
	



?>