<?php
sleep(1);
    session_start();
    if(!isset($_COOKIE['username'])) {
        header('Location: index.php');
    }

    setcookie('username', $_SESSION['username'], 0);

	include './database.php';
    $sender = $_GET['username'];
    $lastTimeStamp = $_GET['time'];
while(true){
    	    //$lastTimeStamp = (time()*1000);
	    $sqlStatement = "SELECT message, sender, timestamp FROM Messages WHERE receiver='".$sender."' and timestamp >= ".$lastTimeStamp." ORDER BY timestamp DESC";
	    //selects the most recent messages, ordered by timestamp
	    $results = executeStatement($sqlStatement);
	    $senderArray = array();
	    $messageArray = array();	
	    $timeArray = array();
	    foreach($results as $row){
	        array_push($senderArray, $row["sender"]);
		array_push($messageArray, $row["message"]);
		array_push($timeArray, $row["timestamp"]);
        	}
	    $ret = array(
		    'message'=>$messageArray,
	            'sender'=>$senderArray,
		    'times'=>$timeArray,
		    'time'=>time()*1000
            );
	    $json = json_encode($ret);
	    echo $json;
	    //sleep(1);
	    break;
}
?>

