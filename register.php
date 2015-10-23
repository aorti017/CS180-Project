<?php
    session_start();
	if ($_SESSION['error'] == "err") {
		echo "Please fill out all the input fields";
		$_SESSION['error'] = "none";
	}
?>
<html>
	<head>
		<title>Register Profile</title>
	</head>
	<body>
    	<form action="makeUser.php" method="POST">
				<input type="text" name="username" id="username" placeholder="*Username"><br><br>
				<input type="password" name="password" id="password" placeholder="*Password"><br><br>
				<input id="firstname" name="firstname" placeholder="First Name"><br><br>
				<input id="lastname" name="lastname" placeholder="Last Name"><br><br>
				<input type="date" name="birthdate" id="birthdate"><br><br>
				<input id="email" name="email" placeholder="Obama@whitehouse.gov"><br><br>
				<input name="gender" value="Male" type="radio">Male
				<input name="gender" value="Female" type="radio">Female
				<br>
				<input type="submit" value="Create Account">
		</form>
	</body>
</html>
