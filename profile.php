<?php
    include "./database.php";

    session_start();
    if(!isset($_COOKIE['username'])) {
        header('Location: index.php');
    }
    setcookie("username", $_SESSION['username'], 0);

    $user = $_GET['userVar'];
    $sql = "SELECT * FROM Users WHERE username = '".$user."'";
    $results = executeStatement($sql);
    $username = $results[0][0];
    $firstname = $results[0][2];
    $lastname = $results[0][3];
    $birthday = $results[0][4];
    $gender = $results[0][5];
    $email = $results[0][6];
    $status = $results[0][7];
?>
<html>
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        	<script src="javascript.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="navigation.css">
	</head>
	<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '411711342356748',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
		<div>
			<nav class="main-menu">
        		<ul>
            		<li><a onclick="FB.logout()" href="logout.php">Logout</a></li>
					<li><a href="contacts.php">Contacts</a></li>
					<li><a href="messages.php">Messages</a></li>
                	<li id="currentpage"><a id="userProf">Profile</a></li>
				</ul>
			</nav>
		</div>
        <div class="twitter-widget">
            <div class="header cf">
                <a href="https://www.facebook.com/" target="_blank" class="avatar"><img src="https://upload.wikimedia.org/wikipedia/en/b/b1/Portrait_placeholder.png" alt="Edwin Delgado"></a>
                <h2><?php echo $firstname?> <?php echo $lastname ?></h2>
                <p><?php echo $status ?><br>Contact email: <?php if($email!=null) {echo $email;} else {echo "N/A";}?></p>
            </div>
            <div class="stats cf">
                <a class="stat"><strong><?php if($birthday!=null) {echo $birthday;} else {echo "N/A";}?></strong>Birthday</a>
                <a class="stat"><strong><?php if($gender!=null) {echo $gender;} else {echo "N/A";}?></strong>Gender</a>
                <a class="stat"><strong><?php echo $username ?></strong>Username</a>
            </div>
            <ul class="menu cf">
                <li><a id="compose" class="ico-compose">Compose</a></li>
                <?php if($_GET['userVar'] != $_COOKIE['username']){ echo "<li><a id='block' href='' class='ico-mentions'>Block/Unblock</a></li>";}?>
                <?php if($_GET['userVar'] == $_COOKIE['username']){ echo "<li><a id='settings' href='getnewinfo.php' class='ico-settings'>Settings</a></li>";}?>
            </ul>
            <div align="center" style="display: none; width: 100%;" id="updateStatus">
                <form id="statUpdate" action="./updateStatus.php" type="GET">
                    <input type="text" name="status" placeholder="Update Status" style="width: 100%;">
                    <div><input type="submit" value="Update"></div>
                </form>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    document.getElementById("userProf").setAttribute("href", "profile.php?userVar="+parse());
    //gets the userVar GET variable from the URL
    var parts = window.location.href;
    var userVar = parts.substring(parts.indexOf("=")+1, parts.length);

    document.getElementById("compose").href = "./messages.php?contacts=" + userVar;
    document.getElementById("compose").title = "Write a message to " + userVar;

    if (parse() != userVar) {
        document.getElementById("block").title = "Block or unblock " + userVar;
        document.getElementById("block").onclick = function(){
            $.ajax({
                type:'GET',
                url: './blockUser.php',
                data: {username: parse(), contact: userVar}
            });
        };
    }

    if (parse() == userVar) {
        document.getElementById("updateStatus").style.display = "block";
        document.getElementById("settings").title = "Update your profile information";
    }
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
					if(tracked.indexOf(times[i]) > -1){
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
	var d = new Date();
	var tracked = [];
	initNotifications(d.getTime(), tracked, 0);
</script>
