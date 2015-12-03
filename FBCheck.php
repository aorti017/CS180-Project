<html>
<body>
<?php

include './database.php';

$statement = "SELECT * FROM Users WHERE BINARY username='".$_POST['username']."'";
$results = executeStatement($statement);

if(count($results)==0)
{
	header('Location: ./addFBInfo.php?username='.$_POST['username'].'');
}
else
{

		header('Location: ./createFBUser.php');
}



?>

</body>
</html>
