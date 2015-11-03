<?php
	include './database.php';
	$username = $_GET['username'];
	$contact = $_GET['contact'];
	$sqlStatement = "INSERT INTO Blocked VALUE('".$username."','".$contact."')";
	executeStatement($sqlStatement);
        $sqlStatement = "DELETE FROM Contacts WHERE username='".$username."' AND contact='".$contact."'";
        executeStatement($sqlStatement);
?>
