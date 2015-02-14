<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/plain');


if(isset($_REQUEST['name']))
	echo "Hello " . $_REQUEST['name'];
?>