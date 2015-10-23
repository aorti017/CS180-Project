<?php
    session_start();

if($_SESSION['error']== "error")
		{
		echo '<script language="javascript">';
echo 'alert("User doesn\'t exist")';
echo '</script>';
			$_SESSION['error']="none";
		}

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
		<div id="navigation">
        	<ul>
            	<li><a href="logout.php">Logout</a></li>
				<li id="currentpage"><a href="">Contacts</a></li>
				<li><a href="profile.php">Messages</a></li>
			</ul>
		</div>
		<br>
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
                                window.location.replace("http://104.236.163.138/profile.php?contacts="+this.value);
                            };
                            var t = document.createTextNode(conts[i]);
                            btn.appendChild(t);
                            document.body.appendChild(btn);
                        }
                    }
                });
            }
 
            $(function(){
                getContacts();
		
            });
        </script>
        <form action = "addContact.php"id="addCnt" method="get">
            Add user to contacts:<br>
            <input type="username"  name="contact" id="addCntInput">
	    <input type="hidden" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
        </form>
	</body>
</html>
