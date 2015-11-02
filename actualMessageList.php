<html>
<head>


<meta charset="UTF-8">
<title>MessageList</title>




</head>

<body>

<script type="text/javascript">

$var username = "ass";
function getMessageList(){
$.ajax({
	type: 'GET',
	url: './messageList.php',
	data: {username: username},
	success: function(data){
		var obj = jQuery.parseJSON(data);
		var senders = obj.sender;
		var receivers = obj.receiver;
		var timestamps = obj.timestamp;

		for(i = 0; i < senders.length;++i)
		{
			console.log(senders[i]);
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
