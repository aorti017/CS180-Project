<html>
	<head>
		<meta charset="UTF-8">
		<title>MessageList</title>
		<script src="javascript.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	</head>

<body>

<script>
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
						document.body.appendChild(btn);
					}
					else {
						var btn = document.createElement("BUTTON");
						btn.setAttribute("id", "Btn");
						btn.setAttribute("value", senders[i]);
						btn.onclick=function(){

							window.location.replace("./messages.php?contact=" + this.value);
						};
						var t = document.createTextNode(senders[i]);
						btn.appendChild(t);
						document.body.appendChild(btn);
					}
					
				}
			}
		});
	}
	$(function(){
		getMessageList();
	});

</script>

</body>
</html>

<html>
	<form action="./messages.php" type="GET">
	Create new message:
	<input type="text" name="contacts">
	</form>
</html>
