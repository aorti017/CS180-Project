<?php
	include "./database.php";
	session_start();

	$userVar = "";
	if (isset($_COOKIE['username'])) {
    	$userVar = $_COOKIE['username'];
	}
	else {
    	header('Location: index.php');
	}

?>
<html>
	<body>
    	<form action="updateuserinfo.php" method="POST">
				Password*: <br>
                <input type="password" name="updatepassword" id="password"><br><br>
				First Name: <br>
                <input type="text" name="updatefirstname" id="updatefirstname" placeholder="John"><br><br>
                Last Name: <br>
				<input type="text" name="updatelastname" id="updatelastname" placeholder="Doe"><br><br>
				Birthday: <br>
                <input type="date" name="updatebirthdate" id="updatebirthdate" placeholder="yyyy/mm/dd"><br><br>
				Email: <br>
                <input type="text" name="updateemail" id="updateemail" placeholder="Obama@whitehouse.gov"><br><br>
				Gender: <br>
                <input type="radio" name="updategender" value="Male" >Male
				<input type="radio" name="updategender" value="Female">Female
				<br>
				<input type="submit" value="Update">
		</form>

        <form action="deleteAccount.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <!--<button type="button" onclick="confirmDelete();">Delete Account</button>
            <input type="hidden" id="confirmation" name="confirmation" value="">-->
            <input type="submit" value="Delete Account">
        </form>

		<form action="profile.php?userVar=<?php echo $userVar?>" method="post">
    		<input type="submit" value="Cancel">
        </form>
	</body>

</html>
<!--
<script type="text/javascript">
    function confirmDelete() {
        var x = confirm('Are you sure you want to delete your account?');
        document.getElementById('confirmation').value = x;
    }
</script>-->
