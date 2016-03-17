<?php
	$username = isset($_POST["username"])?$_POST["username"]:"";
	$sql = "SELECT id,username FROM user where username = '$username'";
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
	

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$id = $row['id'];
	$sql = "SELECT date, go_sleep, get_up,duration FROM action where id = '$id' and go_sleep!= 0 ORDER BY date DESC LIMIT 7"; 
	$result = $conn->query($sql);

	$ret = array();
	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $ret[$row["date"]]=array($row["duration"]);
    }
    //echo "</table>";
    echo json_encode($ret);
} else {
    echo "0 results";
}
$conn->close();
	
?>