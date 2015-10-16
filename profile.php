<?php
    // starts login session for user
    // need a session start in every file
    session_start();
    // this cookie checks for if a user has two tabs open and logs out in one tab
    // refreshing the page on the non-logged out page will redirect to index.php
    // since the user logged out
    if (!isset($_COOKIE['username'])) {
        // redirects to index.php
        header('Location: index.php');
    }
    // sets the username cookie so that the user is logged in across all open tabs
    // 0 is the timeout time so that if the browser closes, the user is logged out
    setcookie('username', $_SESSION['username'], 0);
    // echo $_SESSION['username'];
?>

<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="javascript.js"></script>
		<title>Profile</title>
		
	</head>

	<body>
        <ul class="nav nav-tabs">
            <li><a href="logout.php">Logout</a></li>
            <li><a href="#">Home</a></li>
		</ul>

		<textarea id="newMessage" rows="5" cols="40"></textarea>
		<button id="send">Send</button>
		
		<script type="text/javascript">
				function getNewMessages(t){
				//somehow get the user name from the session variable
				var username = parse();
				var recpUser = "ying";
				$.ajax({
					type: 'GET',
					url: './messages.php',
					data: {username:username, recpUser: recpUser, time:t},
					success: function(data){
						var obj = jQuery.parseJSON(data);
						//get the timestamps and message values from the json
						//form them into tuples, sort and then display
						getNewMessages(obj.timestamp);
					}
				});
			}

			$('#send').click(function()
			{
				var message = $('#newMessage').val();
				//get the current logged in user 
				//and the foreground conversation
				var username = parse();
				var recpUser = "ying";
				var t = (new Date).getTime();

				$.ajax(
				{
					type: 'GET',
					url: './sendmessage.php',
					data: {username:username, recpUser:recpUser, time:t , message:message},
					success: function(data)
					{
						console.log("success");
					}
				});
			});

				$(function(){
					var time = null;
				getNewMessages(time);
			});
		</script>
			
	</body>
</html>






