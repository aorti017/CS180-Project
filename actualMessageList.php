<html>
	<head>
		<meta charset="UTF-8">
		<title>MessageList</title>
		<script src="javascript.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="navigation.css">
    </head>

<body>
    <div id="navigation">
        <ul>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="contacts.php">Contacts</a></li>
            <li id="currentpage"><a href="actualMessageList.php">Message List</a></li>
            <li><a id="userProf">Profile</a></li>
        </ul>
    </div>
    <br>
    <br>
    <?php
        // goes to the home page if no one is logged in
        session_start();
        if(!isset($_COOKIE['username'])) {
            header('Location: index.php');
        }

        // else set the logged in user in the cookies
        setcookie('username', $_SESSION['username'], 0);
    ?>

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
                }
            });
        }
        $(function(){
            document.getElementById("userProf").setAttribute("href", "profile.php?userVar="+parse());
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
