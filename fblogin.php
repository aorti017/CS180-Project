<html>
<body>

<?php


$fbid = $_GET['fbid'];

include './database.php';
$statement = "SELECT username FROM Users WHERE binary fbid='".$_GET['fbid']."'";
$results = executeStatement($statement);
if(count($results) ==0)
{
	header('Location: ./createFBUser.php');
	
}
else
{
	session_start();
	setcookie('username', $results[0][0], 0);
	$_SESSION["username"] = $results[0][0];
	header('Location: ./contacts.php');
}



?>

</body>

</html>
