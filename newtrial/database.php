<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/plain');



if(isset($_REQUEST['action'])  && $_REQUEST['action'] == 'addVideo') {
	$mysqli = connectToSql($_REQUEST);
	setSql($_REQUEST, $mysqli);
}




/*------------------- PHP FUNCTION DEFINITIONS -------------------*/
function connectToSql($http) {
	//Database access info
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
	//$category = $http['category'];
	//$length = $http['length'];
	
	//Prepared Statement - prepare
	if (!($stmt = $mysqli->prepare("INSERT INTO test(name) VALUES (?)"))) {
		 echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}	
	
	//Prepared Statement - bind and execute 
	if (!$stmt->bind_param('s', $name)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}	
	
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	$stmt->close();		//close statement
}
?>