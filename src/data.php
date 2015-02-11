<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysqli = connectToSql($_POST);
storeData($_POST, $mysqli);


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

function storeData($http, $mysqli) {
	//Fetch data from http request
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
	
	$stmt->close();
}



?>



