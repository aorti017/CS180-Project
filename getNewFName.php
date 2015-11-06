<?php
session_start();
?>
<html>
	<body>
    	<form action="updateNewFName.php" method="POST">
				First Name: <br>
                <input type="text" name="firstname" id="firstname"><br><br>
				<input type="submit" value="Update First Name">
		</form>
        <form action="userProfile.php" method="POST">
    		<input type="submit" value="Cancel">
        </form>
	</body>
</html>

