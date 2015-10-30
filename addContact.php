<?php
    session_start();
    include './database.php';
    //grab the name of the user the logged in user wants to add
    $contact = $_GET['contact'];
    //get currently logged in user
    $username = $_GET['username'];


    //check if user exists
    // if so add user
    $sqlStatement = "SELECT * FROM Users WHERE username='".$contact."'";
    $results = executeStatement($sqlStatement);
    if(count($results) <= 0 || $contact == $username){
        $_SESSION["error"] = "error";
        header('Location: contacts.php');
    }
    else{
        //add user to contact
        $sqlStatement = "INSERT INTO Contacts VALUE('".$username."','".$contact."')";
        executeStatement($sqlStatement);
        header('Location: contacts.php');
    }
?>
