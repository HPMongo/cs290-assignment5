<?php 
	include 'login.php';
	//include 'data.php';
	error_reporting(E_ALL);
	ini_set('display_errors','On');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Video Inventory</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<h4>Add video to the collection</h4>
		<form action="data.php" method="post">
			Title: <input type="text" name="title"><br>
			Category: <input type="text" name="cat"><br>
			Run time: <input type="text" name="time"><br>
			Availability: 	<input type="radio" name="status" value="0"> Rented
							<input type="radio" name="status" value="1"> Available<br>
			<input type="submit" name="addVid" value="Add">
		</form>
		<hr>
		<form action="data.php" method="post">
			<input type="submit" name="listVid" value="Display current collection">
		</form>
	</body>
</html>