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

function parseSender() {
    var username = (document.cookie).trim();
    var temp = '';

    //position of username inside the cookies
    var usernamePosition = username.indexOf("sender=") + 7;
    while(username[usernamePosition] != ';' && username.length > usernamePosition)
    {
        temp += username[usernamePosition];

        usernamePosition++;
    }

    username = temp;
    return username;
}


function parseMessage() {
    var username = (document.cookie).trim();
    var temp = '';

    //position of username inside the cookies
    var usernamePosition = username.indexOf("message=") + 8;
    while(username[usernamePosition] != ';' && username.length > usernamePosition)
    {
        temp += username[usernamePosition];

        usernamePosition++;
    }

    username = temp;
    return username;
}

