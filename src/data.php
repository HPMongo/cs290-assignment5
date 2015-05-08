<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
?>
<?php
	echo "Calling login script<br>";
	include 'login.php';
	echo 'Connecting... ';
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if (mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
	            . mysqli_connect_error());
	}

	echo 'Success... ' . $mysqli->host_info . "\n";

	$sql = "SELECT * FROM video_inventory";
	$result = $mysqli->query($sql);

	while($row = $result->fetch_assoc()) {
		echo " id = ".$row['id']."<br>";
		echo " name =".$row['name']."<br>";
	}
	$mysqli->close();
	echo "After calling login script<br>";
?>