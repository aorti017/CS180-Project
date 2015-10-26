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
				Username*: <br>
                <input type="text" name="username" id="username" placeholder="jdoe001"><br><br>
				Password*: <br>
                <input type="password" name="password" id="password"><br><br>
				First Name: <br>
                <input type="text" name="firstname" id="firstname" placeholder="John"><br><br>
                Last Name: <br>
				<input type="text" name="lastname" id="lastname" placeholder="Doe"><br><br>
				Birthday: <br>
                <input type="date" name="birthdate" id="birthdate" placeholder="mm/dd/yyyy"><br><br>
				Email: <br>
                <input type="text" name="email" id="email" placeholder="Obama@whitehouse.gov"><br><br>
				Gender: <br>
                <input type="radio" name="gender" value="Male" >Male
				<input type="radio" name="gender" value="Female">Female
				<br>
				<input type="submit" value="Create Account">
		</form>
	</body>
</html>
