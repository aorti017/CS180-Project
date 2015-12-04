<html>

<head>
    <title>Register Profile</title>
</head>
    <link href='registerdesign.css' rel='stylesheet' type='text/css'>
<body>
<!---<form action="FBCheck.php" method="post">-->
<div align="center">
    <div class="wrapper" align="center">
        <h1>Register For An Account</h1>
        <p>To sign-up for a free basic account please provide us with some basic information using
        the contact form below. Please use valid credentials.</p>
            <font id="user" color="red" style="display: none;">Username is a required field.</font>
            <input type="text" name="username" id="username" placeholder="Username*"><br><br>
            <font id="pass" color="red" style="display: none;">Password is a required field.</font>
            <input type="password" name="password" id="password" placeholder="Password*"><br><br>
            <br>
            <input onclick="facebookInit()" type="submit" value="Create Account" name="login">
        <p>* Indicates required fields.</p>
    </div>
</div>


</body>
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
var username = document.getElementById('username').value;
var password = document.getElementById('password').value;
if(username == ""){
    //window.location.replace("./createFBUser.php?error=login");
    document.getElementById("user").style.display="inline";
}
else if (password == "") {
    document.getElementById("pass").style.display="inline";
}
else {

console.log(response.birthday);

window.location.replace("./fbMakeUser.php?firstname="+response.first_name+"&lastname="+response.last_name+"&birthday="+format_date+"&gender="+response.gender+"&email="+response.email+"&fbid="+response.id+"&username="+username+"&password="+password);
}
}
}
);

}
</script>
</html>
