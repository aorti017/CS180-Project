<?php
	include './database.php';
	$username = $_GET['username'];
	$contact = $_GET['contact'];
	$sqlStatement = "INSERT INTO Blocked VALUE('".$username."','".$contact."')";
	executeStatement($sqlStatement);
?>
