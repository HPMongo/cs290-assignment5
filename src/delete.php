<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
?>
<?php
	function deleteItem($inItem) {
		include 'login.php';
		echo 'Connecting... ';
		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		
		if (mysqli_connect_error()) {
		    die('Connect Error (' . mysqli_connect_errno() . ') '
		            . mysqli_connect_error());
		}
	//debug
		echo 'Success... ' . $mysqli->host_info . "<br>";

		$sql="DELETE FROM video_inventory WHERE id = '$inItem';";

		if(mysqli_query($mysqli, $sql)) {
			echo "Record deleted!<br>";
			header ""
		} else {
			echo "Error: ".$sql."<br>".mysql_error($mysqli);
		}
	}

	if(isset($_GET['id'])) {
		$inID = $_GET['id'];
		if(!ctype_digit($inID)) {
			echo "Invalid input for delete<br>";
		} else {
			echo "Deleting item #".$inID."<br>";
			deleteItem($inID);
		}
	}
?>