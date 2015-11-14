<?php
    session_start();
	if ($_SESSION['error'] == "err") {
		echo "Please fill out all the input fields";
		$_SESSION['error'] = "none";
	}
    elseif ($_SESSION['error'] == "date") {
        echo "Please fill out your birthday according to the specified format";
        $_SESSION['error'] = "none";
    }
?>
<html>
	<head>
		<title>Register Profile</title>
	</head>
	<link href='registerdesign.css' rel='stylesheet' type='text/css'>
	<body>
		<div align="center">
        <div class="wrapper" align="center">
			<h1>Register For An Account</h1>
			<p>To sign-up for a free basic account please provide us with some basic information using
			the contact form below. Please use valid credentials.</p>
			<form action="makeUser.php" method="POST">
				<input type="text" name="username" id="username" placeholder="Username*"><br><br>
				<input type="password" name="password" id="password" placeholder="Password*"><br><br>
				<input type="text" name="firstname" id="firstname" placeholder="First Name"><br><br>
				<input type="text" name="lastname" id="lastname" placeholder="Last Name"><br><br>
				<input type="date" name="birthdate" id="birthdate" placeholder="yyyy/mm/dd"><br><br>
				<input type="email" name="email" id="email" placeholder="Email"><br><br>
				<input type="radio" name="gender" value="Male"><span class="sex">Male</span>
				<input type="radio" name="gender" value="Female"><span class="sex">Female</span>
				<br>
				<br>
				<input type="submit" value="Create Account">
			</form>
			<form action="index.php" method="POST">
				<input type="submit" value="Cancel">
			</form>
            <p>* Indicates required fields.</p>
		</div>
        </div>
	</body>
</html>
