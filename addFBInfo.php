<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>

<body>
<script>
function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
}




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
			  

	function facebookInit(){
		FB.api(
    "/me?fields=first_name, last_name,id, email,birthday,gender",
	    function (response) {
			      if (response && !response.error) {

var date = new Date(response.birthday);
var d = date.getDate()
var m = date.getMonth() + 1;
var y = date.getFullYear();
var format_date = '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);


										console.log(getUrlVars()["username"]);
		

		window.location.replace("./fbMakeUser.php?firstname="+response.first_name+"&lastname="+response.last_name+"&birthday="+format_date+"&gender="+response.gender+"&email="+response.email+"&fbid="+response.id+"&username="+getUrlVars()["username"]);
							        }
									    }
										);

}
$(function(){

	});
			  </script>
<p id ="Name"></p>
<button onclick="facebookInit()">Create Account</button>
</body>
</html>
