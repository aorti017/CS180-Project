<?php
    session_start();
    if (isset($_COOKIE['username'])) {
        header('Location: contacts.php');
    }

    $_SESSION['error']="none";
?>

<html>
	<link href='logindesign.css' rel='stylesheet' type='text/css'>
	<head>
		<title>CS180 Project</title>
	</head>
	<body>
<script type="text/javascript">
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
console.log('statusChangeCallback');
console.log(response);
// The response object is returned with a status field that lets the
// app know the current login status of the person.
// Full docs on the response object can be found in the documentation
// for FB.getLoginStatus().
if (response.status === 'connected') {
// Logged into your app and Facebook.
testAPI();
} else if (response.status === 'not_authorized') {
// The person is logged into Facebook, but not your app.
} else {
// The person is not logged into Facebook, so we're not sure if
// they are logged into this app or not.
}
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
FB.getLoginStatus(function(response) {
statusChangeCallback(response);
});
}

window.fbAsyncInit = function() {
FB.init({
appId      : '411711342356748',
cookie     : true,  // enable cookies to allow the server to access
// the session
xfbml      : true,  // parse social plugins on this page
version    : 'v2.2' // use version 2.2
});

// Now that we've initialized the JavaScript SDK, we call
// FB.getLoginStatus().  This function gets the state of the
// person visiting this page and can return one of three states to
// the callback you provide.  They can be:
//
// 1. Logged into your app ('connected')
// 2. Logged into Facebook, but not your app ('not_authorized')
// 3. Not logged into Facebook and can't tell if they are logged into
//    your app or not.
//
// These three cases are handled in the callback function.

FB.getLoginStatus(function(response) {
statusChangeCallback(response);
});

};

// Load the SDK asynchronously
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
console.log('Welcome!  Fetching your information.... ');
FB.api('/me?fields=name,email', function(response) {
		console.log('Successful login for: ' + response.name);
			  document.getElementById('status').innerHTML =
					  'Thanks for logging in, ' + response.name + '!';
						 console.log(response.email);
						 console.log(JSON.stringify(response));
						 var fbid = response.id;
						 var fbemail = response.email;

				window.location.replace("./fblogin.php?fbid=" + response.id);


						  });


}
</script>



		<div class="login-block">
	    	<h1>Login</h1>
        	<form action="login.php" method="post">
				<font id="e" color="red" style="display: none;">Incorrect username and/or password!</font>
				<input type="username" name="username" placeholder="Username" id="username"><br>
				<input type="password" name="password" placeholder="Password" id="password"><br>
				<button>Submit</button>
			</form>
	    	<form action="register.php" method="post">
    			<button>Register</button>
        	</form>
            <div align="center">
			    <fb:login-button scope="public_profile,email,user_birthday" onlogin="checkLoginState();">
			    </fb:login-button>
    	    </div>
        </div>
		<div id="status">
		</div>
	</body>
	<script>
		var parts = window.location.href;
		var error = parts.substring(parts.indexOf("=")+1, parts.length);
		if(error == "login"){
			console.log(document.getElementById("e"));
			document.getElementById("e").style.display="inline";
		}
	</script>
</html>
