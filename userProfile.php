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
		<div>
			<nav class="main-menu">
        		<ul>
            		<li><a href="logout.php">Logout</a></li>
					<li><a href="contacts.php">Contacts</a></li>
					<li><a href="actualMessageList.php">Message List</a></li>
					<li id="currentpage"><a href="">My Profile</a></li>
                	<li><a id="userProf">Profile</a></li>
            	</ul>
            </nav>
		</div>
		<br>
    <script type="text/javascript">
        document.getElementById("userProf").setAttribute("href", "profile.php?userVar="+parse());
    </script>
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
	
	$sql = "SELECT * FROM Users WHERE username = '".$user."'";	//following lines extracts all of current users info
	$results = executeStatement($sql);
	$username = $results[0][0];
	$firstname = $results[0][2];
	$lastname = $results[0][3];
	$birthday = $results[0][4];
	$gender = $results[0][5];
	$email = $results[0][6];
?>
<html>
	<body>
    <br>
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

	Email: <?php echo"$email"?> <form action="getNewEmail.php" method="post">
	<input type="submit" value="Edit Email">
	</form>

	</body>
</html>
