<?php
class MessageItem
{
	var $sender;
	var $receiver;
	var $timestamp;
	//creates a class of the most recent message by each unique user
	function MessageItem($senderr, $receiverr, $timestampp)
	{
		$this->sender = $senderr;
		$this->receiver = $receiverr;
		$this->timestamp = $timestampp;
	}
	
	function printer()
	{
		//this prints out the values for debugging
		if(isset($this))
		{
			echo $this->sender;
			echo $this->receiver;
			echo $this->timestamp;
		}
		else
		{
			echo "this is not defined";
		}
	}
}

//goes to the home page if no one is logged in
session_start();
if(!isset($_COOKIE['username'])) {
	header('Location: index.php');
}

include './database.php';
$statement = "select distinct sender, receiver, timestamp FROM Messages WHERE sender ='" . $_COOKIE['username'] ."'" . " or sender ='" . $_COOKIE['username'] ."'" . " ORDER BY timestamp DESC" ;
//SQL statement that gets all of the messages that the user has sent/received and ordres them by timestamp
$results = executeStatement($statement);
$messageList = array();
$newMessage = new MessageItem($results[0][0], $results[0][1], $results[0][2]);
array_push($messageList, $newMessage);

//We check if the sender and receiver are already in our array of messages, and we put them in if they're not
//Since it is ordered by timestamp, the ones at the top of our array will always be the most recent.
foreach($results as $val){
	//echo $val[0];
	$setflag = 0;
	foreach($messageList as $bal)
	{
		if(($bal->sender ==$val[0] &&  $bal->receiver == $val[1]) || ($bal->sender == $val[1] && $bal->receiver == $val[0]))
			{
				$setflag = 1;
			}
		
	}

	if($setflag == 0)
	{
		array_push($messageList, new MessageItem($val[0], $val[1], $val[2]));
	}


}
$messageSenders = array();
$messageReceiver = array();
$messageTimestamp = array();
foreach($messageList as $resluts)
{
	array_push($messageSenders, $resluts->sender);
	array_push($messageReceiver, $resluts->receiver);
	array_push($messageTimestamp, $resluts->timestamp);
}
$ret = array('sender'=>$messageSenders, 'receiver'=>$messageReceiver,'timestamp'=>$messageTimestamp);
$json = json_encode($ret);
echo $json;
?>


