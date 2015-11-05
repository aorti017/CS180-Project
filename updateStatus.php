<?php
    include './database.php';
    $status = $_GET["status"];
    $user = $_COOKIE["username"]; 
    $sqlStatement = "UPDATE Users SET status='".$status."' WHERE username='".$user."'";
    executeStatement($sqlStatement);
    header('Location: ./profile.php?userVar='.$user);
?>
