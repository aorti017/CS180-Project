<?php
    session_start();
    if(!isset($_COOKIE['username'])) {
        header('Location: index.php');
    }

    setcookie('username', $_SESSION['username'], 0);

	include './database.php';
    $sender = $_GET['username'];
    $lastTimeStamp = $_GET['time'] - 800;
    $sqlStatement = "SELECT message, sender FROM Messages WHERE receiver='".$sender."' and timestamp >= ".$lastTimeStamp." ORDER BY timestamp DESC";
    //selects the most recent messages, ordered by timestamp
    $results = executeStatement($sqlStatement);
    $messageArray = array();
    $senderArray = array();

    foreach($results as $row){
        array_push($messageArray, $row["message"]);
        array_push($senderArray, $row["sender"]);
        }
    $ret = array(
            'message'=>$messageArray,
            'sender'=>$senderArray
            );
    $json = json_encode($ret);
echo $json;
sleep(1);
?>
