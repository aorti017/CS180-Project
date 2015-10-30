<html>
	<body>
		<!---
		check if valid username, if not return to sign in page with error message
		check if valid password, if not return to sign in page with error message (use password_verify())
		set login cookies
		-->
		<?php
			include './database.php';
			if(isset($_POST['register'])) {
				$statement = "SELECT * FROM Users WHERE username='".$_POST['username']."'";
				$results = executeStatement($statement);
				if(count($results) >= 1) {
					echo "Username not available";
				}
                elseif(strlen($_POST['password']) <= 0) {
					echo "Password not long enough";
				}
                else{
					$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$statement = "INSERT INTO Users (username, password) VALUE('".$_POST["username"]."', '".$passwordHash."')";
					executeStatement($statement);
					echo "Your account has been created";
				}
			}
			else{
				$statement = "SELECT password FROM Users WHERE username='".$_POST['username']."'";
				$results = executeStatement($statement);
				if (count($results) == 0) {
                    echo "Invalid username";
                }
                else {
                    $passwordHash = $results[0][0];
                    if (password_verify($_POST['password'], $passwordHash)) {
                        session_start();
                        $_SESSION['username'] = $_POST['username'];
                        header('Location: messages.php');
                    }
                    else {
                        echo "Invalid password";
                    }
                }
			}
		?>
	</body>
</html>
