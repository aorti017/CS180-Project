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
        <form action="login.php" method="post">
			Username: <input type="username" name="username" placeholder="John Doe"><br>
			Password: <input type="password" name="password"><br>
			<input type="submit" value="Login" name="login">
		</form>
	    <form action="register.php" method="post">
    		<input type="submit" value="Register">
        </form>
	</body>
</html>
