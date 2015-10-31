<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script src="javascript.js"></script>
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
				<li><a href="contacts.php">Contacts</a></li>
				<li><a href="messages.php">Messages</a></li>
				<li><a href="userProfile.php">Profile</a></li>
			</ul>
		</div>
		<br>
    </body>
</html>

<?php
include "./database.php";

session_start();
$user = $_GET['userVar'];
$sql = "SELECT * FROM Users WHERE username = '".$user."'";
$results = executeStatement($sql);
$username = $results[0][0];
$firstname = $results[0][2];
$lastname = $results[0][3];
$birthday = $results[0][4];
$gender = $results[0][5];
$email = $email[0][6];

echo "User name: $username <br>";
echo "First name: $firstname <br>";
echo "Last name: $lastname <br>";
echo "Birthday: $birthday <br>";
echo "Gender: $gender <br>";
?>
<script type="text/javascript">
var vars = {};
var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
console.log(vars["userVar"]);
var btn = document.createElement("BUTTON");
btn.setAttribute("id", "contactBtn_");
btn.setAttribute("value", vars["userVar"]);
btn.onclick=function(){
window.location.replace("./messages.php?contacts="+this.value);
};
var t = document.createTextNode(vars["userVar"]);
btn.appendChild(t);
document.body.appendChild(btn);
</script>

