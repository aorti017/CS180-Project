<?php

include "./database.php";
//$user = $_GET['user'];
$user = "nikita";
$sql = "SELECT * FROM Users WHERE username = '".$user."'";
$results = executeStatement($sql);
$username = $results[0][0];
echo $username;
?>
hello
