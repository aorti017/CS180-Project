<?php
    session_start();
    if(!isset($_COOKIE['username'])) {
        header('Location: index.php');
    }

    setcookie('username', $_SESSION['username'], 0);

	include './database.php';
	$sender = $_GET['username'];
	$receiver = $_GET['recpUser'];
	$lastTimeStamp = $_GET['time'];
	while(true){
		if($lastTimeStamp == null){
			$sqlStatement = "SELECT message, timestamp FROM Messages WHERE sender='".$sender."' AND receiver='".$receiver."'";
			$resultsSent = executeStatement($sqlStatement);

			$sqlStatement = "SELECT message, timestamp FROM Messages WHERE receiver='".$sender."' AND sender='".$receiver."'";
			$resultsReceived = executeStatement($sqlStatement);

			$sqlStatement = "SELECT MAX(timestamp) FROM Messages WHERE sender='".$sender."' AND receiver='".$receiver."' OR sender='".$receiver."' AND receiver='".$sender."'";
			$tsr = executeStatement($sqlStatement);
			$time = $tsr[0][0];

			$oldMessagesSent = array();
			$oldMessagesTimeS = array();
			foreach($resultsSent as $row){
				array_push($oldMessagesSent, $row["message"]);
				array_push($oldMessagesTimeS, $row["timestamp"]);
			}

            		$oldMessagesReceived = array();
			$oldMessagesTimeR = array();
	            	foreach($resultsReceived as $row){
		                array_push($oldMessagesReceived, $row["message"]);
				array_push($oldMessagesTimeR, $row["timestamp"]);
		        }

			$ret = array(
				'messageSent'=>$oldMessagesSent,
				'messageSentTime'=>$oldMessagesTimeS,
                		'messageReceived'=>$oldMessagesReceived,
				'messageReceivedTime'=>$oldMessagesTimeR,
				'timestamp'=>$time,
				'sender'=>$sender,
				'receiver'=>$receiver
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
					" AND (sender='".$sender."' AND receiver='".$receiver."')";
				$results = executeStatement($sqlStatement);

				$newMessagesSent = array();
				foreach($results as $row){
					array_push($newMessagesSent, $row["message"]);
				}

				$sqlStatement = "SELECT message FROM Messages WHERE timestamp=".$newTimeStamp.
					" AND (sender='".$receiver."' AND receiver='".$sender."')";
				$results = executeStatement($sqlStatement);

				$newMessagesReceived = array();
				foreach($results as $row){
					array_push($newMessagesReceived, $row["message"]);
				}

				$ret = array(
					'messageSent'=>$newMessagesSent,
                    			'messageReceived'=>$newMessagesReceived,
					'timestamp'=>$newTimeStamp,
					'sender'=>$sender,
					'receiver'=>$receiver
				);

				$json = json_encode($ret);
				echo $json;
			}
			else{
				$ret = array(
					'messageSent'=>"",
                    			'messageReceived'=>"",
					'timestamp'=>$lastTimeStamp,
					'sender'=>$sender,
					'receiver'=>$receiver
				);
				$json = json_encode($ret);
				echo $json;
				sleep(1);
			}
			break;
		}
	}
?>
