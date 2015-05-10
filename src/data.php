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
				echo "In stock";
			} else {
				echo "Rented";
			}
			echo "</td>";
			//echo "Click <a href='index.php'> here</a> to go back and correct your entry.<br>";
			//echo "<td>ID is: ".$id."</td>";
			echo "<td> <a href='delete.php?id=".$id."'>Delete</a> </td>";
			echo"</tr>";	
		}
		echo '</table><br>';
	}
/*
	This function will validate add request 
*/
	function addValidate(&$inArr) {
		$validAdd = true;
		$inTitle;
		$inTime; 
		$inCat; 
		$inStat;
		if(isset($_POST['title'])) {
			$inTitle = $_POST['title'];
			if($inTitle != "") {
				echo "Tilte: ".$inTitle."<br>";
			} else {
				echo "Error - Invalid title.<br>";	
			}
		} else {
			echo "Error - Invalid title.<br>";
			$validAdd = false;
		}

		if(isset($_POST['cat'])) {
			$inCat = $_POST['cat'];
			if($inCat != "") {
				echo "Category: ".$inCat."<br>";
			} else {
				echo "Error - Invalid category.<br>";
			}
		} else {
			echo "Error - Invalid category.<br>";
			$validAdd = false;	
		}

		if(isset($_POST['time'])) {
			$inTime = $_POST['time'];
			if(!ctype_digit($inTime)) { 
				echo "Error - Run-time needs be numeric.<br>";
				$validAdd = false;			
			} else {
				echo "Run-time: ".$inTime."<br>";
			}
		} else {
			echo "Error - Invalid run-time.<br>";
			$validAdd = false;		
		}

		if(isset($_POST['status'])) {
			$inStat = $_POST['status'];
			echo "Available: ".$inStat."<br>";
		} else {
			echo "Error - Invalid availability.<br>";
			$validAdd = false;			
		}

		if($validAdd) {
			$inArr[0] = $inTitle;
			$inArr[1] = $inCat;
			$inArr[2] = $inTime;
			$inArr[3] = $inStat;
			return true;
		} else {
			return false;
		}
	}
/*
	This function will add the entry to the table
*/
	function addVideo($inArr, $inConn) {
		$sql = "INSERT INTO video_inventory (name, category, length, rented) VALUES ('$inArr[0]', '$inArr[1]', '$inArr[2]', '$inArr[3]');";
		if(mysqli_query($inConn, $sql)) {
			echo "Record added!<br>";
		} else {
			echo "Error: ".$sql."<br>".mysql_error($inConn);
		}
	}

//echo "Calling login script<br>";
	$addArray = array();
	echo 'Connecting... ';
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if (mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
	            . mysqli_connect_error());
	}
//debug
	echo 'Success... ' . $mysqli->host_info . "<br>";
//
	if(isset($_POST['listVid'])) {
		displayTable($mysqli);
	}

	if(isset($_POST['addVid'])) {
		if(addValidate($addArray)) {
			echo "All is good! Proceed with table update";
			echo "Array: ".$addArray[0]."-".$addArray[1]."-".$addArray[2]."-".$addArray[3]."<br>";
			addVideo($addArray, $mysqli);
		} else {
			echo "There are errors with the input. Click <a href='index.php'> here</a> to go back and correct your entry.<br>";

		}
	}
	//displayTable($mysqli);
	$mysqli->close();
?>