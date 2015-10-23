<?php
    if (isset($_COOKIE['username'])) {
        header('Location: profile.php');
    }
session_start();
$_SESSION['error']="none";
?>

<html>
	<head>
		<title>CS180 Project</title>
	</head>
        <form align="center" action="login.php" method="post">
			Username: <input type="username" name="username" placeholder="John Doe"><br>
			Password: <input type="password" name="password"><br>
			<input type="submit" value="Login" name="login">
			<input type="submit" value="Register" name="register">
		</form>
	</body>
</html>
