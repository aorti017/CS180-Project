<?php
	include "./database.php";
	session_start();
	
	$user = "";
	if (isset($_COOKIE['username'])) {
    	$user = $_COOKIE['username'];
	}
	else {
    	header('Location: index.php');
	}
	$lastName = $_POST['lastname'];
	$sql = "UPDATE Users SET lastname= '".$lastName."' WHERE username = '".$user."'"; //update lirst name
	$results = executeStatement($sql);
	$_SESSION['error'] = "updated";	//set a flag to notify user after redirect to profile page that update was success
	header('location: userProfile.php');	//redirect back to profile page
?>
