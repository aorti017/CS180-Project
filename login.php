<html>
	<body>
		<!--- 
		check if valid username, if not return to sign in page with error message
		check if valid password, if not return to sign in page with error message (use password_verify())
		set login cookies
		-->
		<?php 
			if($_POST['register']){
				//validate user entered info and add to database
			} 
			else{
				//replace this with code that retrieves the user's hashed password
				$dbPassword =  password_hash($_POST['password'], PASSWORD_DEFAULT);	
				if (password_verify($_POST['password'], $dbPassword)) {
					echo "You're logged in";
				} else{
					echo "You're not logged in";
				}
			}
		?> 		
	</body>
</html>
