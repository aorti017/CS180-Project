<?php
    session_start();
    if (isset($_COOKIE['username'])) {
        header('Location: contacts.php');
    }

    $_SESSION['error']="none";
?>

<html>
	<link href='logindesign.css' rel='stylesheet' type='text/css'>
	<head>
		<title>CS180 Project</title>
	</head>
	<body>
		</<div class="logo"></div>
		<div class="login-block">
	    	<h1>Login</h1>
        	<form action="login.php" method="post">
				<font id="e" color="red" style="display: none;">Incorrect username and/or password!</font>
				<input type="username" name="username" placeholder="Username" id="username"><br>
				<input type="password" name="password" placeholder="Password" id="password"><br>
				<button>Submit</button>
				</<input type="submit" value="Login" name="login"> 
			</form>
	    	<form action="register.php" method="post">
    			<button>Register</button>
    			</<input type="submit" value="Register">
        	</form>
    	</div>
	</body>
	<script>
		var parts = window.location.href;
		var error = parts.substring(parts.indexOf("=")+1, parts.length);
		if(error == "login"){
			console.log(document.getElementById("e"));
			document.getElementById("e").style.display="inline";
		}
	</script>
</html>
