<?php
	include './database.php';
	$sender = $_GET['username'];
	$receiver = $_GET['recpUser'];
	if(!($receiver == "")){
	    $sqlStatement = "SELECT * FROM Blocked WHERE (username='".$sender."' AND blocked='".$receiver."') OR (username='".$receiver."' AND blocked='".$sender."')";
	    $results = executeStatement($sqlStatement);
        if(!(count($results)>0)){
            $newTimeStamp = $_GET['time'];
            $message = $_GET['message'];
            $toInsert =	"INSERT INTO Messages VALUE ('".$sender."','".$receiver."','".$newTimeStamp."','".$message."')";
            executeStatement($toInsert);
        }
    }
?>
