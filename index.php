<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);

createAddVideoInterface();




/*-------- FUNCTION DEFINITIONS --------*/
function createAddVideoInterface() {
	//Bind database variables
	$columns = 4;	//fixed
	$rows = 1;		//fixed
	$name = "Dummy Name";
	$category = "Dummy Category";	
	$Length = "Dummy Length";
	
	//Draw Interface
	echo "
	<form>
	<fieldset>
		<legend>Add Video</legend>
		
		<label>Name: 
			<input type=text id=name> &nbsp&nbsp&nbsp&nbsp
		</label>
		
		<label>Category: 
			<input type=text id=category> &nbsp&nbsp&nbsp&nbsp
		</label>		

		<label>Length: 
			<input type=text id=length>
		</label>
		
		<input type=button id=addVideo value='Add Video'>	
	</fieldset>	
	</form>	
	";	//end echo
}



?>