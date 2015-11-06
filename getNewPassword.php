<?php
session_start();
?>
<html>
	<body>
    	<form action="updateNewPassword.php" method="POST">
				Password*: <br>
                <input type="password" name="password" id="password"><br><br>
				<input type="submit" value="Update Password">
		</form>
        <form action="userProfile.php" method="POST">
    		<input type="submit" value="Cancel">
        </form>
	</body>
</html>

