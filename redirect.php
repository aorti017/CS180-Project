<?php
session_start()
?>
<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="navigation.css">
	</head>
	
	<body>
		<div id="navigation">
        	<ul>
            	<li><a href="logout.php">Logout</a></li>
				<li id="currentpage"><a href="">Home</a></li>
				<li><a href="profile.php">Messages</a></li>
			</ul>
		</div>
		<br>
		<p>Welcome to WhatsApp</p>
	</body>
</html>
