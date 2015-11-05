<html>
	<body>
		<!---
		check if valid username, if not return to sign in page with error message
		check if valid password, if not return to sign in page with error message (use password_verify())
		set login cookies
		-->
		<?php
			include './database.php';
            $statement = "SELECT password FROM Users WHERE BINARY username='".$_POST['username']."'";
            $results = executeStatement($statement);
            if (count($results) == 0) {
                echo "Invalid username";
            }
            else {
                $passwordHash = $results[0][0];
                if (password_verify($_POST['password'], $passwordHash)) {
                    session_start();
                    $_SESSION['username'] = $_POST['username'];
                    //header('Location: profile.php?userVar='.$_POST['username']);
                    header('Location: contacts.php');
                }
                else {
                    echo "Invalid password";
                }
            }
		?>
	</body>
</html>
