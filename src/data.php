<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);


$mysqli = connectToSql($_POST);

if($_POST['action'] == "addVideo")
	setSql($_POST, $mysqli);

getSql($mysqli);

$mysqli->close();	//close connection


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
	else {
		echo "You are connected to MySQL!<br>";
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
	else {
		echo "Data successfully stored!";
	}
	
	$stmt->close();		//close statement
}


function getSql($mysqli) {
	//Variables to get
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
	
	$stmt->close();		//close statement
}

?>



