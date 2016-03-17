<?php
	//This php file handle the form submitted by users. Update sql by ensuring that each person has one line data per day. 
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
	
	if(mysqli_connect_errno()) {
		echo "Connect failed";
	}
	/*
	$sql = "CREATE DATABASE myDB";
	
	
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}*/

	$username = isset($_POST["username"])?$_POST["username"]:"";
	$sql = "SELECT id,username FROM user where username = '$username'";
	$result = $conn->query($sql);
	$boolean = true;
	if($result->num_rows === 0){
		$warn = "user not exist";
		$boolean = false;
	}
	$row = $result->fetch_assoc();
	$id = $row['id'];
	$time_bed = isset($_POST["time_bed"])?$_POST["time_bed"]:"00:00";
	$time_up = isset($_POST["time_up"])?$_POST["time_up"]:"00:00";
	$current_date = isset($_POST["theDate"])?$_POST["theDate"]:"1970-1-1";
	
	function timeDiff($firstTime,$lastTime){
		if( ! ini_get('date.timezone') ){
    		date_default_timezone_set('GMT');
		}		
		//calculate time difference, return date object.
		$firstTime=strtotime($firstTime);
		$lastTime=strtotime($lastTime);
		
		$timeDiff=$firstTime-$lastTime;
		if($timeDiff>0){
			$newTimeDiff = 24-$timeDiff;
		}
		else{
			$newTimeDiff = -$timeDiff;
		}
		$hoursminsandsecs = date('H:i:s',$newTimeDiff);
		
		return $hoursminsandsecs;
	}
	//echo timeDiff($time_bed,$time_up);
	$duration = timeDiff($time_bed,$time_up);
	
	$sql = "SELECT date FROM action 
			where date = '$current_date' and id = '$id'";

	$result = $conn->query($sql);
	if($result->num_rows === 0){

		
		$sql = "INSERT INTO action (id, date, go_sleep, get_up, duration)
				VALUES ('$id','$current_date','$time_bed', '$time_up', '$duration')";
		$conn->query($sql);

		$sql = "UPDATE user SET numbers = numbers+1 WHERE id = '$id'";

	}
	
	else{
		$sql = "UPDATE action 
				SET go_sleep = '$time_bed', get_up = '$time_up', duration = '$duration' 
				WHERE date='$current_date' and id = '$id'";
	}
	
	$conn->query($sql);
	
	$ret = array("boolean"=>$boolean, "duration"=>$duration,"warn"=>$warn);
	echo json_encode($ret);
	

?>