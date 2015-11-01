<?php
include "./database.php";

session_start();
$user = $_GET["username"];
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
}

$sql = "SELECT * FROM Users WHERE username = '".$user."'";
$results = executeStatement($sql);
$username = $results[0][0];
$firstname = $results[0][2];
$lastname = $results[0][3];
$birthday = $results[0][4];
$gender = $results[0][5];
$email = $results[0][6];

echo $username;
echo $firstname;
echo $lastname;
echo $birthday;
echo $gender;
echo $email;
?>

<html>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<form action="./blockUser.php" method="get">
<input type="button"value="Block User">

</form>
</html>
