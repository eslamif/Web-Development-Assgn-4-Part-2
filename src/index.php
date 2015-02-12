<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

include "phpFunctions.php";


/*--------------- MAIN PROGRAM ---------------*/
?>
<script src="http://localhost/myhost-exemple/cs290-ass4-p2/src/jsFunctions.js"></script>

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

<div id="videoList">Video List from Database goes here!</div>


<?php 
$mysqli = connectToSql($_POST);		//connect to MySQL

//Add video to database
if(isset($_POST['action']) && $_POST['action'] == "addVideo")
	setSql($_POST, $mysqli);

getSql($mysqli);									//get video list from MySQL
echo "<script> httpRequest(); </script>";			//display video list to user
$mysqli->close();									//close MySQL connection






?>



