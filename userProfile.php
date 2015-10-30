<?php
include "./database.php";

session_start();
$user = "";
if (isset($_COOKIE['username'])) {
    $user = $_COOKIE['username'];
}
else {
    header('Location: index.php');
}

$sql = "SELECT * FROM Users WHERE username = '".$user."'";
$results = executeStatement($sql);
$username = $results[0][0];
$firstname = $results[0][2];
$lastname = $results[0][3];
$birthday = $results[0][4];
$gender = $results[0][5];
$email = $email[0][6];

echo $username;
echo $firstname;
echo $lastname;
echo $birthday;
echo $gender;
echo $email;
?>

<html>
    <body>
        hello
    </body>
</html>
