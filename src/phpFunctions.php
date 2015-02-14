<?php 
/*--------------- PHP FUNCTION DEFINITIONS ---------------*/
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
	}	v
	
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
	
	if(isset($_GET['action']) && $_GET['action'] == 'getVideoList') {
		$stmt->fetch();
		echo $out_name;
	}
	
	
	$stmt->close();		//close statement
}

if(isset($_GET['action']) && $_GET['action'] == 'getVideoList')
	echo "Success";



?>


