<?php
    include "./database.php";
	session_start();

	$userVar = "";
	if (isset($_COOKIE['username'])) {
    	$userVar = $_COOKIE['username'];
	}
	else {
    	header('Location: index.php');
	}

    $sql = "DELETE FROM Users WHERE username='".$userVar."'";	//following lines extracts all of current users info
	executeStatement($sql);
    $sql = "DELETE FROM Messages WHERE sender='".$userVar."' OR receiver='".$userVar."'";
    executeStatement($sql);
    $sql = "DELETE FROM Contacts WHERE username='".$userVar."' OR contact='".$userVar."'";
    executeStatement($sql);
    $sql = "DELETE FROM Blocked WHERE username='".$userVar."' OR blocked='".$userVar."'";
    executeStatement($sql);

    // deletes the cookies for the logged in user when the user presses 'logout'
    setcookie('username', '', time()-3600);

    // deletes the user session
    session_unset();
    session_destroy();

    header('Location: index.php');
?>
