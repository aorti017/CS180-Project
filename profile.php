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
				<li><a id="userProf">Profile</a></li>
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
$email = $results[0][6];
$status = $results[0][7];
echo "<br>User name: $username<br>";
echo "Email: $email <br>";
echo "First name: $firstname <br>";
echo "Last name: $lastname <br>";
echo "Birthday: $birthday <br>";
echo "Gender: $gender <br>";
echo "Status: $status <br>";
?>
<script type="text/javascript">
document.getElementById("userProf").setAttribute("href", "profile.php?userVar="+parse());
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

var blockBtn = document.createElement("BUTTON");
blockBtn.setAttribute("id", vars["userVar"]);
blockBtn.setAttribute("value", parse());
blockBtn.onclick=function(){
	$.ajax({
		type:'GET',
		url: './blockUser.php',
		data: {username: this.value, contact: this.id}
	});
};
var newT = document.createTextNode("Block/Unblock User");
blockBtn.appendChild(newT);
document.body.appendChild(blockBtn);
</script>

