<html>
	<body>
		<!--- 
		check if valid username, if not return to sign in page with error message
		check if valid password, if not return to sign in page with error message (use password_verify())
		set login cookies
		-->
		<?php 
			error_reporting(-1);
			include './database.php';
			if($_POST['register']){
				$statement = "SELECT * FROM Users WHERE username='".$_POST['username']."'";
				$results = executeStatement($statement);
				if(count($results) >= 1){
					echo "Username not available";
				} elseif(strlen($_POST['password'])<=0){
					echo "Password not long enough";
				} else{
					$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$statement = "INSERT INTO Users (username, password) VALUE('".$_POST["username"]."', '".$passwordHash."')";
					executeStatement($statement);
					echo "Your account has been created";
				}
			} 
			else{
				$statement = "SELECT password FROM Users WHERE username='".$_POST['username']."'";
				$results = executeStatement($statement);
				$passwordHash = $results[0][0];
				if (password_verify($_POST['password'], $passwordHash)) {
					echo "You're logged in";
					session_start();
					$_SESSION['username'] = $_POST['username'];
					header('Location: profile.html');
				} else{
					echo "Incorrect Password";
				}
			}
		?> 		
	</body>
</html>
