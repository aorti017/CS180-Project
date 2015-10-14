<?php
// need session_start() in all files
session_start();

// deletes the cookies for the logged in user when the user presses 'logout'
setcookie('username', '', time()-3600);

// deletes the user session
session_unset();
session_destroy();

// sends the user back to index.php
header('Location: index.php');
?>
