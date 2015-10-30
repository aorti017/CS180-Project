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
echo $username;
?>

<html>
    <body>
        hello
    </body>
</html>
