<?php
	function executeStatement($statement){
		try{
			$db = parse_ini_file("./.ini");
			
			$user = $db['user'];
			$password = $db['password'];
			$host = $db['host'];
			$name = $db['name'];
			$type = $db['type'];

			$pdoStatement = $type.':host='.$host.';dbname='.$name;

		        $pdo = new PDO($pdoStatement, $user, $password);
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
