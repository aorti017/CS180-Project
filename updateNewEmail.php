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
	$email = $_POST['email'];
	$sql = "UPDATE Users SET email= '".$email."' WHERE username = '".$user."'"; //update first name
	$results = executeStatement($sql);
	$_SESSION['error'] = "updated";	//set a flag to notify user after redirect to profile page that update was success
	header('location: userProfile.php');	//redirect back to profile page
?>
