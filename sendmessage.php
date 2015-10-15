<?php
	include './database.php';
	$sender = $_GET['username'];
	$receiver = $_GET['recpUser'];
	$newTimeStamp = $_GET['time'];
	$message = $_GET['message'];
	
	$toInsert =	"INSERT INTO Messages VALUE ('".$sender."','".$receiver."','".$newTimeStamp."','".$message."')";
	executeStatement($toInsert);
	break;
?>
