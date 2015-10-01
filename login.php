<html>
	<body>
		<!--- 
		check if valid username, if not return to sign in page with error message
		check if valid password, if not return to sign in page with error message (use password_verify())
		set login cookies
		-->
		<?php 
			$passwordHash =  password_hash($_POST['password'], PASSWORD_DEFAULT);
			$username = $_POST['username']
		?> 
		
	</body>
</html>
