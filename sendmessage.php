<?php
	include './database.php';
	$sender = $_POST['username'];
	$reciever = $_POST['recpUser'];
	$newTimeStamp = $_POST['time'];
	$message = $_POST['message'];

	$toInsert =	"INSERT INTO Messages VALUE (".$sender.",".$reciever.",".$newTimeStamp.",".$message.")";
	executeStatement($toInsert);
	echo"success";
	break;
?>
