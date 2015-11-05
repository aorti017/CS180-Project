<?php
	session_start();
	include './database.php';
	//print_r($_POST);
	if($_POST['username'] != "" && $_POST['password'] != "") {
		$statement = "SELECT * FROM Users WHERE username='".$_POST['username']."'";
		$results = executeStatement($statement);
        $birthday = $_POST["birthdate"];
        if ($birthday != "" && $birthday != NULL) {
            $year = intval($birthday[0] . $birthday[1] . $birthday[2] . $birthday[3]);
            $month = intval($birthday[5] . $birthday[6]);
            $day = intval($birthday[8] . $birthday[9]);
            if (!checkdate($month, $day, $year)) {
                $_SESSION['error'] = "date";
                header('location: register.php');
                break;
            }
        }

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

            setcookie('username', $_POST["username"], 0);
            $_SESSION["username"] = $_POST["username"];
            header('Location: contacts.php');
		}
	}
	else{
		$_SESSION['error'] = "err";
		header('Location: register.php');
	}
?>
