<?php
	session_start();
	include './database.php';
	//print_r($_POST);
	if($_POST['username'] != "" && $_POST['password'] != "" &&
	   isset($_POST['firstname']) && isset($_POST['lastname']) &&
	   isset($_POST['birthdate']) && isset($_POST['gender']) && isset($_POST['email'])) {
		$statement = "SELECT * FROM Users WHERE username='".$_POST['username']."'";
		$results = executeStatement($statement);
		if(count($results) >= 1) {
			echo "Username not available";
		}
        elseif(strlen($_POST['password']) <= 0) {
			echo "Password not long enough";
		}
        else{
			$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$statement = "INSERT INTO Users (username, password, firstname, lastname, birthday, gender, email) VALUE('".$_POST["username"]."', '".$passwordHash."', '".$_POST["firstname"]."', '".$_POST["lastname"]."', '".$_POST["birthdate"]."', '".$_POST["gender"]."', '".$_POST["email"]."')";
			executeStatement($statement);
			echo "Your account has been created";
		}
	}
	else{
		$_SESSION['error'] = "err";
		header('Location: register.php');
	}
?>
