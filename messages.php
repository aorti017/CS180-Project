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
		<link rel="stylesheet" href="navigation.css">
		<link rel="stylesheet" href="messageDesign.css">
        <title>Messages</title>
	</head>

	<body>
		<div>
			<nav class="main-menu">
        		<ul>
            		<li><a href="logout.php">Logout</a></li>
            		<li><a href="contacts.php">Contacts</a></li>
            		<li id="currentpage"><a href="">Messages</a></li>
                    <li><a id="userProf">Profile</a></li>
				</ul>
				<br>
        	</nav>
        </div>

        <form action="./messages.php" type="GET" style="display: inline-block;">
            <p id="createText">Create new message:</p>
            <input type="text" name="contacts">
        </form>
        <div id="friends">
        </div>
        <div style="margin: -84px 25% 0px 25%;">
            <p id="currentFriend" align="center" style="color: #FFFFFF;"></p>
            <div class="messageWrapper">
                <div id="messageContainer"></div>
                <div class="sendMessageDiv">
                    <textarea id="newMessage" rows="5" style="width: 100%;" onkeydown="if (event.keyCode==13) {document.getElementById('send').click(); return false;}"></textarea>
                    <button class="sendMessage" id="send">Send</button>
                </div>
            </div>
        </div>

		<script type="text/javascript">
            function getMessageList(){
                var username = parse();
                $.ajax({
                    type: 'GET',
                    url: './messageList.php',
                    data: {username: username},
                    success: function(data){
                        var obj = jQuery.parseJSON(data);
                        var senders = obj.sender;
                        var receivers = obj.receiver;
                        var timestamps = obj.timestamp;

                        // if the logged in person has no contacts, then senders will be size 1 with a value of null
                        if (!(senders.length == 1 && senders[0] == null)) {
                            for(var i = 0; i < senders.length; i++)
                            {
                                if (senders[i] == username) {
                                    var btn = document.createElement("BUTTON");
                                    btn.setAttribute("id", "Btn");
                                    btn.setAttribute("value", receivers[i]);
                                    btn.onclick=function(){
                                        window.location.replace("./messages.php?contact=" + this.value);

                                    };
                                    var t = document.createTextNode(receivers[i]);
                                    btn.appendChild(t);
                                    document.getElementById("friends").appendChild(btn);
                                }
                                else {
                                    var btn = document.createElement("BUTTON");
                                    btn.setAttribute("id", "Btn");
                                    btn.setAttribute("value", senders[i]);
                                    btn.onclick=function(){
                                        window.location.replace("./messages.php?contact=" + this.value);
                                        document.getElementById("currentFriend").innerHTML = this.value;
                                    };
                                    var t = document.createTextNode(senders[i]);
                                    btn.appendChild(t);
                                    document.getElementById("friends").appendChild(btn);
                                }

                            }
                        }
                    }
                });
            }

            //used to get the GET variables
            function getUrlVars() {
                var parts = window.location.href;
		        var vars = parts.substring(parts.indexOf("=")+1, parts.length);
                return vars;
            }

            // type = sent or received
            // message = content of the message
            // time = time of message delivery
			function Message(type, message, time){
				this.type = type;
				this.message = message;
				this.time = time;
			}
			function getNewMessages(t, recpUser){
				var username = parse();

                if (window.location.href.indexOf("=") != -1) {
                    document.getElementById("currentFriend").innerHTML = recpUser;
                }

                $.ajax({
					type: 'GET',
					url: './getMessages.php',
					data: {username:username, recpUser: recpUser, time:t},
					success: function(data){
						/*TODO*/
						//instead of outputting to console,
						//output to html elements in order they were sent
						//and user colors or identifiers to indicate who
						//sent and who received
						var obj = jQuery.parseJSON(data);
                        var messages = [];

                        if(t == null){
                            var messSent = obj.messageSent;
                            var messSentTime = obj.messageSentTime;
                            for(i = 0; i < messSent.length; i++) {
                                    messages.push(new Message('s', messSent[i], messSentTime[i]));
                            }
                            var messRec = obj.messageReceived;
                            var messRecTime = obj.messageReceivedTime;
                            for(i = 0; i < messRec.length; i++){
                                messages.push(new Message('r', messRec[i], messRecTime[i]));
                            }
							messages.sort(function(a, b){
								return a.time - b.time;
							});
							for(i = 0; i < messages.length; i++){
								if(messages[i].type == 'r'){
									//$('#messageContainer').append(obj.receiver + ": " + messages[i].message + "<br>");
                                    var format = "<div class='bubbleFrom'><p>" + messages[i].message + "</p></div>";
								    $('#messageContainer').append(format);
                                }
								else{
                                    //$('#messageContainer').append(obj.sender + ": " + messages[i].message + "<br>");
                                    var format = "<div class='bubbleTo'><p>" + messages[i].message + "</p></div>";
								    $('#messageContainer').append(format);
                                }
							}
                            var bottomOfMessages = document.getElementById("messageContainer");
                            bottomOfMessages.scrollTop = bottomOfMessages.scrollHeight;
			            }
			            else{
							var messageSent = obj.messageSent;
							var messageReceived = obj.messageReceived;
							if(messageSent == "" && messageReceived != ""){
                                //$('#messageContainer').append(obj.receiver + ": " + messageReceived[0] + "<br>");
                                var format = "<div class='bubbleFrom'><p>" + messageReceived[0] + "</p></div>";
						        $('#messageContainer').append(format);
                                var bottomOfMessages = document.getElementById("messageContainer");
                                bottomOfMessages.scrollTop = bottomOfMessages.scrollHeight;
                            }
							else if(messageReceived == "" && messageSent != ""){
								//$('#messageContainer').append(obj.sender + ": " + messageSent[0] + "<br>");
							    var format = "<div class='bubbleTo'><p>" + messageSent[0] + "</p></div>";
						        $('#messageContainer').append(format);
                                var bottomOfMessages = document.getElementById("messageContainer");
                                bottomOfMessages.scrollTop = bottomOfMessages.scrollHeight;
                            }
						}

						getNewMessages(obj.timestamp, recpUser);
					}
				});
			}

			$('#send').click(function()
			{
				var message = $('#newMessage').val();
				if(message == ""){
					return;
				}
				//clears the textarea after a message is sent
				document.getElementById("newMessage").value="";
                var username = parse();
                var recpUser = getUrlVars();
				var t = (new Date).getTime();

				$.ajax(
				{
					type: 'GET',
					url: './sendMessage.php',
					data: {username:username, recpUser:recpUser, time:t , message:message}
				});
			});
document.addEventListener('DOMContentLoaded', function(){
				if(Notification.permission != "granted"){
					Notification.requestPermission();
				}
			});
function initNotifications(x, tracked, runCount){
		var username = parse();
				$.ajax({ 
			type: 'GET',
			url: './notifications.php',
			data: {username: username, time: x},
			success: function(data){
				var obj = jQuery.parseJSON(data);
				var messages = obj.message;
				var senders = obj.sender;
				var times = obj.times;
				if(messages.length > 0 && senders.length > 0){
					console.log(messages);
				}
				for(i = 0; i < messages.length; i++){
					//make sure the array doesnt grow too large
					if(runCount >= 500){
						tracked = []
					}	
					if(tracked.indexOf(times[i]) > -1 || senders[i] == getUrlVars()){
						continue;
					}
					else{
						runCount += 1;
						tracked.push(times[i]);
					}
					temp = document.cookie;
					document.cookie = "sender="+senders[i];
					document.cookie = "message="+messages[i];
					if (Notification.permission != "granted")
    						Notification.requestPermission();
					  else {
						    	
						    var notification = new Notification(parseSender(), {body: parseMessage()});
						    notification.onclick = function () {
						    window.location.replace("./messages.php?contacts="+parseSender());};
						    setTimeout(function(){
							notification.close(); 
							}, 5000);
					 }
					document.cookie = temp;
				}
				initNotifications(obj.time, tracked, runCount);
			}
		});
	    }
            $(function(){
	            document.getElementById("userProf").setAttribute("href", "profile.php?userVar="+parse());
                var time = null;
                var recpUser = getUrlVars();
                getMessageList();
                getNewMessages(time, recpUser);
			var d = new Date();
		        var tracked = [];
			initNotifications(d.getTime(), tracked, 0);

            });
		</script>
</body>
</html>






