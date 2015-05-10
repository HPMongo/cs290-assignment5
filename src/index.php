<?php 
	include 'login.php';
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
		<form action="add.php" method="post">
			<label>Title: </label><input id="1" type="text" name="title"><br>
			<label>Category: </label><input id="1" type="text" name="cat"><br>
			<label>Run time: </label><input id="1" type="text" name="time"><br>
			<label>Availability: </label>
				<input type="radio" name="status" value="0"> Checked out
				<input type="radio" name="status" value="1"> Available<br>
			<input type="submit" name="addVid" value="Add">
		</form>
		<hr>
		<?php include 'display.php';?>
		<form action="delete_all.php" method="post">
			<input type="submit" value="Delete all videos??" onCLick="return confirm('Are you SURE you want to delete all videos?')">
		</form>
	</body>
</html>