<?php
session_start();
?>
<html>
	<body>
    	<form action="updateNewEmail.php" method="POST">
				Email: <br>
                <input type="text" name="email" id="email"><br><br>
				<input type="submit" value="Update Email">
		</form>
        <form action="userProfile.php" method="POST">
    		<input type="submit" value="Cancel">
        </form>
	</body>
</html>

