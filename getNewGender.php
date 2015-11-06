<?php
session_start();
?>
<html>
	<body>
    	<form action="updateNewGender.php" method="POST">	
			Gender: <br>
			<input type="radio" name="gender" value="Male" >Male
			<input type="radio" name="gender" value="Female">Female
			<br>
			<input type="submit" value="Update First Name">
		</form>

        <form action="userProfile.php" method="POST">
    		<input type="submit" value="Cancel">
        </form>
	</body>
</html>

