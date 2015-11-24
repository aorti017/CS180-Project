<?php
	include './database.php';
	$sender = $_GET['username'];
	$receiver = $_GET['recpUser'];
	if(!($receiver == "")){
	    $sqlStatement = "SELECT * FROM Blocked WHERE (username='".$sender."' AND blocked='".$receiver."') OR (username='".$receiver."' AND blocked='".$sender."')";
	    $results = executeStatement($sqlStatement);
	$sqlStatement = "SELECT * FROM Users WHERE username='".$receiver."'";
	$realUser = executeStatement($sqlStatement);
        if(count($results)<=0 && count($realUser)>0){
            $newTimeStamp = $_GET['time'];
            $message = $_GET['message'];
            $toInsert =	"INSERT INTO Messages VALUE ('".$sender."','".$receiver."','".$newTimeStamp."','".$message."')";
            executeStatement($toInsert);
	    $ret = array('status'=>"");
   	    echo json_encode($ret);
        }
	else{
		if(count($results) > 0){
			$ret = array('status'=>"Communications are blocked.");
			echo json_encode($ret);
		}
		else{
			$ret = array('status'=>"This user does not exist.");
			echo json_encode($ret);
		}
	}
    }
?>
