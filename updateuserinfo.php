<?php
	include "./database.php";
	session_start();

	$userVar = "";
	if (isset($_COOKIE['username'])) {
    	$userVar = $_COOKIE['username'];
	}
	else {
    	header('Location: index.php');
	}

	$sql = "SELECT * FROM Users WHERE username = '".$userVar."'";	//following lines extracts all of current users info
	$results = executeStatement($sql);
	$password = $results[0][1];
	$firstname = $results[0][2];
	$lastname = $results[0][3];
	$birthday = $results[0][4];
	$gender = $results[0][5];
	$email = $results[0][6];
	$privacy = $results[0][9];
	
	//check if any new information was editted, if it was keep it, and sicard previous, otherwise keep old user values
	if($_POST['updatepassword'] !='')
	{
		$password = $_POST['updatepassword'];
		$newPassword = password_hash($password, PASSWORD_DEFAULT);
		$sql = "UPDATE Users SET password= '".$newPassword."' WHERE username = '".$userVar."'";
		$results = executeStatement($sql);
	}
	if($_POST['updatefirstname'] != '')
	{
		$firstname = $_POST['updatefirstname'];
		$sql = "UPDATE Users SET firstname='".$firstname."' WHERE username = '".$userVar."'"; //update first name
		$results = executeStatement($sql);
	}
	if($_POST['updatelastname'] != '')
	{
		$lastname = $_POST['updatelastname'];
		$sql = "UPDATE Users SET lastname= '".$lastname."' WHERE username = '".$userVar."'"; //update last name
		$results = executeStatement($sql);
	}
	if($_POST['updatebirthdate'] != '')
	{
		$birthday = $_POST['updatebirthdate'];
		$year = intval($birthday[0] . $birthday[1] . $birthday[2] . $birthday[3]);
        $month = intval($birthday[5] . $birthday[6]);
        $day = intval($birthday[8] . $birthday[9]);
        if (checkdate($month, $day, $year))
        {
			$sql = "UPDATE Users SET birthday= '".$birthday."' WHERE username = '".$userVar."'"; //update birthday
			$results = executeStatement($sql);
		}
	}
	if($_POST['updategender'] != '')
	{
		$gender = $_POST['updategender'];
		$sql = "UPDATE Users SET gender= '".$gender."' WHERE username = '".$userVar."'"; //update gender 
		$results = executeStatement($sql);
	}
	if($_POST['updateemail'] != '')
	{
		$email = $_POST['updateemail'];
		$sql = "UPDATE Users SET email= '".$email."' WHERE username = '".$userVar."'"; //update email
		$results = executeStatement($sql);
	}
	if($_POST['privacy'] != '') {
		if ($privacy == 'n') {
			$sql = "UPDATE Users SET privacy='y' WHERE username = '".$userVar."'"; //update privacy
			$results = executeStatement($sql);
		}
		else {
			$sql = "UPDATE Users SET privacy='n' WHERE username = '".$userVar."'"; //update privacy
			$results = executeStatement($sql);
		}
	}
	
	header('location: profile.php?userVar='.$userVar);	//redirect back to profile page
?>
