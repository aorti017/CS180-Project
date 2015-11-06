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

	if(strlen($_POST['password']) <= 0)	//checks to make sure the new password they are trying to update is valid
	{
		$_SESSION['error'] = "password"; //if it was invalid, set a flag to notify user after redirect to profile page
	}
	else	//if it is valid, update the SQL table with the new password
	{
		$sql = "SELECT * FROM Users WHERE username = '".$user."'";
		$newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$sql = "UPDATE Users SET password= '".$newPassword."' WHERE username = '".$user."'";
		$results = executeStatement($sql);
		$_SESSION['error'] = "updated";	//set a flag to notify user after redirect to profile page that update was success
	}
	header('location: userProfile.php');	//either way, redirect back to profile page
?>
