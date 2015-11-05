<?php
    session_start();
    if(!isset($_COOKIE['username'])) {
        header('Location: index.php');
    }

    setcookie('username', $_SESSION['username'], 0);

    include './database.php';
    //gets the username for the logged in user
    $username = $_GET['username'];
    //sql statement to retrieve all of the logged in user's contacts
    $statement = "SELECT contact FROM Contacts WHERE username='".$username."'";
    //returns all of the logged in user's contacts
    $results = executeStatement($statement);
    //get elemtns returned from sql and turn into array
    $contactArray = array();
    foreach($results as $row){
        array_push($contactArray, $row["contact"]);
    }
    //convert results into json to be returned to calling ajax
    $ret = array('contacts'=>$contactArray);
    $json = json_encode($ret);
    //echo json in order to return it
    echo $json;
?>
