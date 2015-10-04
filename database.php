<?php
	function executeStatement($statement){
		try{
		        $pdo = new PDO('mysql:host=localhost;dbname=[db name goes here]', 'root', '[root password goes here]');
			$query = $pdo->prepare($statement);
                	$query->execute();
                	$results = $query->fetchAll();
			$pdo = null;
			return $results;
		} catch(PDOException $e){
		        echo 'An error occured: '.$e->getMessage();
			return null;
		}
	}
?>
