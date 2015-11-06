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

	$birthday = $_POST["birthdate"];
	if ($birthday != "" && $birthday != NULL)	//check to see if birthday was properly inputed by parsing 
	{
		$year = intval($birthday[0] . $birthday[1] . $birthday[2] . $birthday[3]);
		$month = intval($birthday[5] . $birthday[6]);
		$day = intval($birthday[8] . $birthday[9]);
		if (!checkdate($month, $day, $year))
		{
			$_SESSION['error'] = "date";	//if not correct format, set flag and identify
		}
		$sql = "UPDATE Users SET birthday= '".$birthday."' WHERE username = '".$user."'"; //update birthday
		$results = executeStatement($sql);
		$_SESSION['error'] = "updated";	//set a flag to notify user after redirect to profile page that update was success
    }
    else
    {
		$_SESSION['error'] = "date";
	}
	header('location: userProfile.php');	//redirect back to profile page
?>
