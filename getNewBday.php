<?php
session_start();
?>
<html>
	<body>
    	<form action="updateNewBday.php" method="POST">
				First Name: <br>
				<input type="date" name="birthdate" id="birthdate"><br><br>
				<input type="submit" value="Update Brithdate">
		</form>
        <form action="userProfile.php" method="POST">
    		<input type="submit" value="Cancel">
        </form>
	</body>
</html>

