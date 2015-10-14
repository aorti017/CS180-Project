<?php
	include './database.php';
	$sender = $_GET['username'];
	$receiver = $_GET['recpUser'];
	$lastTimeStamp = $_GET['time'];
	while(true){
		if($lastTimeStamp == null){
			//make query to db to get all messages between users
			//then turn that array into json, add timestamp
			//echo it to ajax 
			$sqlStatement = "SELECT message FROM Messages WHERE sender='".$sender."' AND receiver='".$receiver."' OR sender='".$receiver."' AND receiver='".$sender."'";
			$results = executeStatement($sqlStatement);
			$sqlStatement = "SELECT MAX(timestamp) FROM Messages WHERE sender='".$sender."' AND receiver='".$receiver."' OR sender='".$receiver."' AND receiver='".$sender."'";
	
			$tsr = executeStatement($sqlStatement);
			$time = $tsr[0][0];
			$oldMessages = array();
			foreach($results as $row){
				array_push($oldMessages, $row["message"]);
			} 
			$ret = array(
				'message'=>$oldMessages,
				'timestamp'=>$time
			);
			$json = json_encode($ret);
			echo $json;
			break;
		} 
		else{
			//get the largest time from the db, if its greater than the last saved time
			//then display all the messages from current saved time to largest time
			//then update the saved time
			$sqlStatement = "SELECT MAX(timestamp) FROM Messages WHERE sender='".$sender.
				"' AND receiver='".$receiver."' OR sender='".$receiver."' AND receiver='".$sender."'";
			$results = executeStatement($sqlStatement);
			$newTimeStamp = $results[0][0];
			if($newTimeStamp > $lastTimeStamp){
				//get new message(s) and return
				$sqlStatement = "SELECT message FROM Messages WHERE timestamp=".$newTimeStamp.
					" AND ((sender='".$sender."' AND receiver='".$receiver."') OR (sender='".$receiver.
					"' AND receiver='".$sender."'))";
				$results = executeStatement($sqlStatement);
				$newMessages = array();
				foreach($results as $row){
					array_push($newMessages, $row["message"]);
				}	 
				$ret = array(
					'message'=>$newMessages,	
					'timestamp'=>$newTimeStamp
				);
				$json = json_encode($ret);
				echo $json;
			}
			else{
				$ret = array(
					'message'=>"",	
					'timestamp'=>$lastTimeStamp
				);
				$json = json_encode($ret);
				echo $json;
				sleep(5);	
			}
			break;
		}
	}
?>
