<?php
    session_start();
?>
<html>
	<head>
		<title>Register Profile</title>
	</head>
	<body>
    	<form action="addContact.php" method="get" align="center">
				<input type="text" id="username" placeholder="Username"><br><br>
				<input type="text" id="password" placeholder="Password"><br><br>
				<input id="firstname" placeholder="First Name"><br><br>
				<input id="lastname" placeholder="Last Name"><br><br>
				<input id="email" placeholder="Obama@whitehouse.gov"><br><br>
				<input type="date" id="birthdate"><br><br>
				<div id="sex" class="dropdown-menu">
					<input name="gender" value="male" type="radio">Male
					<input name="gender" value="female" type="radio">Female
				</div>
		</form>
	</body>
</html>
