<?php
session_start();
?>
<html>
	<body>
    	<form action="updateNewLName.php" method="POST">
				First Name: <br>
                <input type="text" name="lastname" id="lastname"><br><br>
				<input type="submit" value="Update Last Name">
		</form>
        <form action="userProfile.php" method="POST">
    		<input type="submit" value="Cancel">
        </form>
	</body>
</html>

