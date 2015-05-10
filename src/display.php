<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	include_once 'login.php';
?>
<?php
/*
	This function will display the current video inventory
*/
	function displayTable($mysqli) {
		$sql = "SELECT * FROM video_inventory";
		$result = $mysqli->query($sql);
		
		//Populate result table
		echo "<link rel='stylesheet' href='style.css'>";
		echo '<h3>',"My videos",'</h3>';
		echo '<table cellpadding="0" cellspacing="0" class="db-table">';
		echo "<tr><th>ID</th>
				  <th>Title</th>
				  <th>Category</th>
				  <th>Run-time</th>
				  <th>Availability</th>
				  <th>Action</th></tr>";
		while($row = mysqli_fetch_array($result)) {
			$id = $row['id'];
			$title = $row['name'];
			$category = $row['category'];
			$runtime = $row['length'];
			$avai = $row['rented'];
			echo "<tr>";
			echo "<td>".$id."</td>";
			echo "<td>".$title."</td>";
			echo "<td>".$category."</td>";
			echo "<td>".$runtime."</td>";
			echo "<td>";
			if($avai==0) {
				echo "<a href='update.php?id=".$id."&stat=1"."' title='Click to check out'>Available</a>";
			} else {
				echo "<a href='update.php?id=".$id."&stat=0"."' title='Click to check in'>Checked out</a>";
			}
			echo "</td>";
			echo "<td> <a href='delete.php?id=".$id."'>Delete</a> </td>";
			echo"</tr>";	
		}
		echo '</table><br>';
	}
/*
	Main logic of the script
*/
// 	Connecting to the database ;
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if (mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
	            . mysqli_connect_error());
	}
//	Display the table if a list video request is true
	displayTable($mysqli);
//	Close the connection
	$mysqli->close();
?>