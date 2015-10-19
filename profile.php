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
			function Message(type, message, time){
				this.type = type;
				this.message = message;
				this.time = time;
				this.getType = function(){ return this.type; };
				this.getMessage = function(){ return this.message; };
				this.getTime = function(){ return this.time; };
			}
			function getNewMessages(t){
				var username = parse();
				/*TODO*/
				//get the user the message is supposed to be sent to
				//from the selected conversation
				var recpUser = "ying";
                		$.ajax({
					type: 'GET',
					url: './messages.php',
					data: {username:username, recpUser: recpUser, time:t},
					success: function(data){
						/*TODO*/
						//instead of outputting to console,
						//output to html elements in order they were sent
						//and user colors or identifiers to indicate who
						//sent and who received
						var obj = jQuery.parseJSON(data);
						if(t == null){
                        				var messSent = obj.messageSent;
			                	        var messSentTime = obj.messageSentTime;
                        				var messages = [];
				                        for(i=0; i < messSent.length; i++){
        	                				    messages.push(new Message('s', messSent[i], messSentTime[i]));
				                        }
                        				var messRec = obj.messageReceived;
			        	                var messRecTime = obj.messageReceivedTime;
                        				for(i=0; i < messRec.length; i++){
			                        	    messages.push(new Message('r', messRec[i], messRecTime[i]));
                        				}
							messages.sort(function(a, b){
								return a.getTime() - b.getTime();
							});
							for(i=0; i<messages.length; i++){
								console.log(messages[i].getMessage());
							}
						}
						else{
							var messageSent = obj.messageSent;
							var messageReceived = obj.messageReceived;
							if(messageSent == "" && messageReceived != ""){
								console.log(messageReceived[0]);
							}
							else if(messageReceived == "" && messageSent != ""){
								console.log(messageSent[0]);
							}
						}
						getNewMessages(obj.timestamp);
					}
				});
			}

			$('#send').click(function()
			{
				var message = $('#newMessage').val();
				//clears the textarea after a message is sent
				document.getElementById("newMessage").value="";
				var username = parse();
				var recpUser = "ying";
				var t = (new Date).getTime();

				$.ajax(
				{
					type: 'GET',
					url: './sendmessage.php',
					data: {username:username, recpUser:recpUser, time:t , message:message}
				});
			});

			$(function(){
				var time = null;
				getNewMessages(time);
			});
		</script>

	</body>
</html>






