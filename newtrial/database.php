<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');
	
	
//Get Video List from MySQL
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'getVideo') {	
	$mysqli = connectToSql($_REQUEST);
	$sqlQuery = getSql($mysqli);
	$jsonStr = json_encode($sqlQuery);		//encode to JSON string
	echo $jsonStr;
}


//Add Video to MySQL
if(isset($_REQUEST['action'])  && $_REQUEST['action'] == 'addVideo') {
	$mysqli = connectToSql($_REQUEST);
	setSql($_REQUEST, $mysqli);
	$return = $_REQUEST['name']; 
	echo $return;
}


//Delete All Videos from MySQL
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "deleteAll") {
	$mysqli = connectToSql($_REQUEST);
	$mysqli->query("DELETE FROM test");
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
	
	//Prepared Statement - execute
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	//Bind results
	if (!$stmt->bind_result($out_name, $out_category, $out_length)) {
	    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	//Store result in array
	$arrOuter = array();
	$arrInner = array();
	while($stmt->fetch()) {
		$arrInner = [$out_name, $out_category, $out_length];
		array_push($arrOuter, $arrInner);		
	}
	
	$stmt->close();	
	return $arrOuter;
}
?>



















