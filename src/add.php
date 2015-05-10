<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	include_once 'login.php';
?>
<?php
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
			echo "Error - missing title.<br>";
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
			echo "Error - missing category.<br>";
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
			echo "Error - missing run-time.<br>";
			$validAdd = false;		
		}

		if(isset($_POST['status'])) {
			$inStat = $_POST['status'];
			echo "Available: ".$inStat."<br>";
		} else {
			echo "Error - missing availability.<br>";
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
			echo "Error: ".$sql."<br>";
			echo "Error code:".mysqli_error($inConn)."<br>";
			$inConn->close();
			echo "There are errors with the input. Click <a href='index.php'> here</a> to go back and correct your entry.<br>";
		}
	}

/*
	Main logic of the script
*/
	$addArray = array();
// 	Connecting to the database ;
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if (mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
	            . mysqli_connect_error());
	}
//	Add new entry to the table
	if(isset($_POST['addVid'])) {
		if(addValidate($addArray)) {
			echo "All is good! Proceed with table update";
			echo "Array: ".$addArray[0]."-".$addArray[1]."-".$addArray[2]."-".$addArray[3]."<br>";
			addVideo($addArray, $mysqli);
// 	Close the database connection
			$mysqli->close();
//	Redirect to homepage
//			header('Location: index.php');
		} else {
// 	Close the database connection
			$mysqli->close();
			echo "There are errors with the input. Click <a href='index.php'> here</a> to go back and correct your entry.<br>";
		}
	}
?>