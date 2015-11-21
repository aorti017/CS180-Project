<?php
    session_start();

    if($_SESSION['error']== "error")
    {
		echo '<script language="javascript">';
        echo 'alert("User doesn\'t exist")';
        echo '</script>';
		$_SESSION['error'] = "none";
	}

    if(!isset($_COOKIE['username'])) {
        header('Location: index.php');
    }

    setcookie('username', $_SESSION['username'], 0);

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
		<div>
			<nav class="main-menu">
        		<ul>
            		<li><a href="logout.php">Logout</a></li>
					<li id="currentpage"><a href="">Contacts</a></li>
					<li><a href="messages.php">Messages</a></li>
					<li><a id="userProf">Profile</a></li>
				</ul>
			</nav>
		</div>
		<script type="text/javascript">
            function getContacts(){
                var username = parse();
                $.ajax({
                    type: 'GET',
                    url: './getContacts.php',
                    data: {username: username},
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var conts = obj.contacts;
                        for(i = 0; i < conts.length; i++){
                            var btn = document.createElement("BUTTON");
                            btn.setAttribute("id", "contactBtn_");
                            btn.setAttribute("value", conts[i]);
                            btn.onclick=function(){
                                //window.location.replace("./messages.php?contacts="+this.value);
                                window.location.replace("profile.php?userVar="+this.value);
                            };
                            var t = document.createTextNode(conts[i]);
                            btn.appendChild(t);
                            document.body.appendChild(btn);
                        }
                    }
                });
            }

            $(function(){
		        document.getElementById("userProf").setAttribute("href", "profile.php?userVar="+parse());
                getContacts();

            });
        </script>
        <br>
        <form action="addContact.php" id="addCnt" method="get">
	        <input type="hidden" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
            Add user to contacts:<br>
            <input type="username" name="contact" id="addCntInput" placeholder="Username">
            <input type="submit" value="Add">
        </form>
	</body>
</html>
