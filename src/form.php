<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);


?>


<form action="http://localhost/myhost-exemple/cs290-ass4-p2/src/data.php" method="POST">
<fieldset>
	<legend>Add Video</legend>
	
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





