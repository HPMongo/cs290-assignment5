<?php 
	include 'login.php';
	include 'data.php';
	error_reporting(E_ALL);
	ini_set('display_errors','On');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Video Inventory</title>
		<link rel="stylesheet" href="style.css">
		<script src="gists.js"></script>
	</head>
	<body>
		<table id="inputTable">
			Add new video to the collection<br>
			<form action="data.php" method="get">
				Title: <input type="text" name="title"><br>
				Category: <input type="text" name="cat"><br>
				Run time: <input type="text" name="time"><br>
				Status: <input type="text" name="status"><br>
				<input type="submit" value="Add">
			</form>
		</table>
		<table id="resultTable">
			<tr>
				<td>Results</td>
				<td>ID</td>
				<td>Description</td>
				<td>Link</td>
			</tr>
		</table>
	</body>
</html>