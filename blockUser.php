<?php
	include './database.php';
	$username = $_GET['username'];
	$contact = $_GET['contact'];
	$sqlStatement = "SELECT * FROM Blocked WHERE username='".$username."' AND blocked='".$contact."'";
	$results = executeStatement($sqlStatement);
	if(count($results)>0){
		$sqlStatement = "DELETE FROM Blocked WHERE username='".$username."' AND blocked='".$contact."'";
		executeStatement($sqlStatement);
	}
    else {
        $sqlStatement = "INSERT INTO Blocked VALUE('".$username."','".$contact."')";
        executeStatement($sqlStatement);
        $sqlStatement = "DELETE FROM Contacts WHERE username='".$username."' AND contact='".$contact."'";
        executeStatement($sqlStatement);
    }
?>
