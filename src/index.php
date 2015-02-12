<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');
?>

<!--  ADD VIDEO INTERFACE -->
<form action="http://localhost/myhost-exemple/cs290-ass4-p2/src/index.php" method="POST">
<fieldset>
	<legend>Add Video</legend>
	<input type="hidden" name="action" value="addVideo">
	
	<label>Name: 
		<input type="text" name="name"> &nbsp&nbsp&nbsp&nbsp
	</label>
	
	<label>Category: 
		<input type="text" name="category"> &nbsp&nbsp&nbsp&nbsp
	</label>		

	<label>Length: 
		<input type="text" name="length">
	</label>
	
	<button type="submit">Add Video</button>
</fieldset>	
</form>	



<?php 
$mysqli = connectToSql($_POST);		//connect to MySQL

//Add video to database
if(isset($_POST['action']) && $_POST['action'] == "addVideo")
	setSql($_POST, $mysqli);

getSql($mysqli);

$mysqli->close();					//close MySQL connection


/*-------- FUNCTION DEFINITIONS --------*/
function connectToSql($http) {
	//Set database variables
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "test";
	
	//Connect to MySQL Server
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") ". 
		$mysqli->connect_error;
	}
	return $mysqli;
}

function setSql($http, $mysqli) {
	//Variables to set
	$name = $http['name'];
	$category = $http['category'];
	$length = $http['length'];
	
	//Prepared Statement - prepare
	if (!($stmt = $mysqli->prepare("INSERT INTO test(name, category, length) VALUES (?, ?, ?)"))) {
		 echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}	
	
	//Prepared Statement - bind and execute 
	if (!$stmt->bind_param('ssi', $name, $category, $length)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}	
	
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	$stmt->close();		//close statement
}


function getSql($mysqli) {
	$out_name = NULL;
	$out_category = NULL;
	$out_length = NULL;
	
	//Prepared Statement - prepare
	if (!($stmt = $mysqli->prepare("SELECT name, category, length FROM test"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	//Bind results
	if (!$stmt->bind_result($out_name, $out_category, $out_length)) {
	    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	//Display results in table
	echo "<table>";
		echo "<tr> <td colspan=2>Video Listing</td>
			<td colspan=2><form action=http://localhost/myhost-exemple/cs290-ass4-p2/src/index.php method=GET>
				<button type=submit name=video value=true>Delete All</form></td>";
		echo "<tr> <td>Name</td> <td>Category</td> <td>Length</td> <td>Status</td> </tr>";
		while($stmt->fetch()) {
			echo "<tr>";
			echo "<td>".$out_name."</td> <td>".$out_category."</td> <td>".$out_length."</td>";
			echo "</tr>";
		}
	echo "</table>";
	
	//Delete All Videos
	if(isset($_GET['video']) && $_GET['video'] == TRUE) {
		$mysqli->query("DELETE FROM test");
	}
		
	
	
	
	$stmt->close();		//close statement
}

?>



