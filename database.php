<?php
	function executeStatement($statement){
		try{
		        $pdo = new PDO('mysql:host=localhost;dbname=CS180', 'root', 'cs180group');
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
