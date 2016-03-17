<?php
	$user = 'root';
	$password = 123456;
	$db = 'myDB';
	$host = '127.0.0.1';
	$port = 3306;
	
	$conn = new mysqli(
	   $host, 
	   $user, 
	   $password,
	   $db,
	   $port
	);
	$username = isset($_POST["username"])?$_POST["username"]:"";
	$sql = "SELECT id,username FROM user where username = '$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$id = $row['id'];

	$sql = "SELECT user.id, (COUNT(action.duration))/(user.numbers) from action,user where action.duration>'7:00' AND user.id = action.id group by user.id ORDER by -COUNT(duration)/(user.numbers)";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$n=0;
    	while($row = $result->fetch_assoc()) {
        	$ret[$row["date"]]=array($row["duration"]);
        	$n=$n+1;
        	if($row["id"]==$id){
        		$rank = $n;
        		$percentage = $row["(COUNT(action.duration))/(user.numbers)"];
        	}
    	}
	}

	$sql = "SELECT MAX(duration), MIN(duration) from action WHERE id = '$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$MAX = $row["MAX(duration)"];
	$MIN = $row["MIN(duration)"];
	$ret = array("rank"=>$rank, "total"=>$n,"percentage"=>$percentage, "max"=>$MAX,"min"=>$MIN);
	echo json_encode($ret);



?>