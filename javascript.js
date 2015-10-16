function parse()
{
			var username = document.cookie;
				var temp='';
				for(var i = 0; i < username.length;++i)
				{
					if(username[i]== '=')
					{
						var j = i+1;
						while(username[j]!= ';')
						{

							temp +=username[j];

							++j;
						}
						break;

					}
				}
				username = temp;
		return username;
}

