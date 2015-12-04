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
	<link href='registerdesign.css' rel='stylesheet' type='text/css'>
	<body>
        <div align="center">
			<div class="wrapper" align="center">
    			<h1>Edit Account</h1>
				<p>To edit your account, please input the fields you would like to change in
				the contact form below. Please use valid credentials.</p>
				<form action="updateuserinfo.php" method="POST">
					<input type="password" name="updatepassword" id="password" placeholder="Password"><br><br>
                	<input type="text" name="updatefirstname" id="updatefirstname" placeholder="First Name"><br><br>
					<input type="text" name="updatelastname" id="updatelastname" placeholder="Last Name"><br><br>
                	<input type="date" name="updatebirthdate" id="updatebirthdate" placeholder="yyyy/mm/dd"><br><br>
                	<input type="email" name="updateemail" id="updateemail" placeholder="Email"><br><br>
                	<input type="radio" name="updategender" value="Male"><span class="sex">Male</span>
					<input type="radio" name="updategender" value="Female"><span class="sex">Female</span>
					<br>
					<br>
					<input type="checkbox" name="privacy" value="private"><span class="sex">Update privacy</span>
					<br>
					<br>
					<input type="submit" value="Update">
				</form>

                <form action="deleteAccount.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
                    <input type="submit" value="Delete Account">
                </form>

                <form action="profile.php?userVar=<?php echo $userVar?>" method="post">
    				<input type="submit" value="Cancel">
        		</form>
        	</div>
        </div>
	</body>
</html>
