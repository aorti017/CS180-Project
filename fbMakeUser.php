<html>
<body>
<?php
include './database.php';
$uname = $_GET['username'];
$password = password_hash($_GET['password'], PASSWORD_DEFAULT);
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$birthday = $_GET['birthday'];
$gender = $_GET['gender'];
$email = $_GET['email'];
$fbid = $_GET['fbid'];

$statement = "SELECT * FROM Users WHERE BINARY username='".$_GET['uname']."'";
$results = executeStatement($statement);

if(count($results)==0)
{}
else
{

                header('Location: ./createFBUser.php?error=login');
}



$statement = "INSERT INTO Users (username, password, firstname, lastname, birthday, gender,email, fbid)VALUE('".$uname."', '".$password."', '".$firstname."', '".$lastname."', '".$birthday."', '".$gender."', '".$email."', '".$fbid."')";
executeStatement($statement);
setcookie('username', $uname, 0);
session_start();
$_SESSION["username"] = $uname;
header('Location: contacts.php');

?>

</body>
</html>
