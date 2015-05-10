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
			Title: <input type="text" name="title"><br>
			Category: <input type="text" name="cat"><br>
			Run time: <input type="text" name="time"><br>
			Availability: 	<input type="radio" name="status" value="0"> Checked out
							<input type="radio" name="status" value="1"> Available<br>
			<input type="submit" name="addVid" value="Add">
		</form>
		<hr>
		<?php include 'display.php';?>
	</body>
</html>