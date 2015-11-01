<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script src="javascript.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="navigation.css">
	</head>

	<body>
		<div id="navigation">
        	<ul>
            	<li><a href="logout.php">Logout</a></li>
				<li><a href="contacts.php">Contacts</a></li>
				<li><a href="messages.php">Messages</a></li>
				<li id="currentpage"><a href="">Profile</a></li>
			</ul>
		</div>
		<br>
    </body>
</html>

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

	if($_SESSION['error'] == "updated")	//checks to see if an update was successful or not
	{
		echo "Your information has been updated!<br>";	//if it is, let user be notified
		$_SESSION['error'] = "none";
	}
	else if($_SESSION['error'] == "password")	//if flag was set to password, then prompt user of error
	{
		echo "Password not long enough!<br>";
		$_SESSION['error'] = "none";
	}
	else if($_SESSION['error'] == "date")	//if flag was set to date, then prompt user of error
	{
		echo "Birthday not proper input!<br>";
		$_SESSION['error'] = "none";
	}

	$sql = "SELECT * FROM Users WHERE username = '".$user."'";	//following lines extracts all of current users info
	$results = executeStatement($sql);
	$username = $results[0][0];
	$firstname = $results[0][2];
	$lastname = $results[0][3];
	$birthday = $results[0][4];
	$gender = $results[0][5];
	$email = $email[0][6];
?>
<html>
	<body>
	Username: <?php echo"$username"?> <br>

	Password:<form action="getNewPassword.php" method="post">
	<input type="submit" value="Edit Password">
	</form>
	
	First Name: <?php echo"$firstname"?> <form action="getNewFName.php" method="post">
	<input type="submit" value="Edit First Name">
	</form>
	
	Last Name: <?php echo"$lastname"?> <form action="getNewLName.php" method="post">
	<input type="submit" value="Edit Last Name">
	</form>
	
	Birthday: <?php echo"$birthday"?> <form action="getNewBday.php" method="post">
	<input type="submit" value="Edit Birthday">
	</form>

	Gender: <?php echo"$gender"?> <form action="getNewGender.php" method="post">
	<input type="submit" value="Edit Gender">
	</form>

	email: <?php echo"$email"?> <form action="getNewEmail.php" method="post">
	<input type="submit" value="Edit Email">
	</form>
	
	</body>
</html>
