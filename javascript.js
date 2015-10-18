function parse() {
    var username = (document.cookie).trim();
    var temp = '';

    //position of username inside the cookies
    var usernamePosition = username.indexOf("username=") + 9;
    while(username[usernamePosition] != ';' && username.length > usernamePosition)
    {
        temp += username[usernamePosition];

        usernamePosition++;
    }

    username = temp;
    return username;
}

