function e(i){
	return document.getElementById(i);
}

//allows for changing styles of elements
function s(i)
{
	return e(i).style;
}

//changes between login/register pages
function logreg()
{
	s('regBox').display = (s('regBox').display == 'block' ? 'none' : 'block');
	s('loginBox').display = (s('loginBox').display == 'none' ? 'block' : 'none');
}

//changes if the menu is seen
function menu(i)
{
	s(i).display = (s(i).display == 'block' ? 'none' : 'block');
}

function register(){
	if(e('registerPass').value === e('registerPass2').value)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
			if (xhttp.readyState == 4 && xhttp.status == 200)
			{
				if(xhttp.responseText == "1")
				{
					window.location.reload(true);
				}
				else
				{
					alert(xhttp.responseText);
					s('registerFail').display = 'block';
				}
			}
		};
		xhttp.open("POST", "register.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("&user="+e('regUser').value+
						"&pass="+e('registerPass').value);
	}
	else
	{
		s('registerPass').border = '1px solid red';
		s('registerPass2').border = '1px solid red';
	}
}

function loadFiles(i, t){
	
	//alert("third");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if (xhttp.readyState == 4 && xhttp.status == 200)
		{
			e('content').innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "loadFile.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("user="+i+"&type="+t);
	//alert("fourth");
	
}

function group(){
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if (xhttp.readyState == 4 && xhttp.status == 200)
		{
			e('content').innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "groups.php", true);
	xhttp.send();
	
}

function groupCreate()
{
	//alert("first");
	var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
			if (xhttp.readyState == 4 && xhttp.status == 200)
			{
				if(xhttp.responseText == "1")
				{
					window.location.reload(true);
				}
				else
				{
					alert(xhttp.responseText);
					//s('registerFail').display = 'block';
				}
			}
		};
		xhttp.open("POST", "groupcreate.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("&newGroup="+e('groupName').value);
		//alert("second");
		
	
}

function login()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if (xhttp.readyState == 4 && xhttp.status == 200)
		{
			if(xhttp.responseText == "1")
			{
				window.location.reload(true);
			}
			else
			{
				alert(xhttp.responseText);
				//s('loginFail').display = 'block';
			}
		}
	};
	xhttp.open("POST", "login.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("&user="+e('logUser').value+
						"&pass="+e('logPass').value);
}

function groupRemove(i)
{
	//alert("first");
	var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
			if (xhttp.readyState == 4 && xhttp.status == 200)
			{
				if(xhttp.responseText == "1")
				{
					window.location.reload(true);
				}
				else
				{
					alert(xhttp.responseText);
					//s('registerFail').display = 'block';
				}
			}
		};
		xhttp.open("POST", "removeGroup.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("&group="+i);
		//alert("second");
		
	
}

function download(i, t){
	
	//alert("third");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if (xhttp.readyState == 4 && xhttp.status == 200)
		{
			e('content').innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "download.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("user="+i+"&file="+t);
	//alert("fourth");
	
}

function viewMembers(i){
	
	//alert("third");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if (xhttp.readyState == 4 && xhttp.status == 200)
		{
			e('content').innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "viewMembers.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("group="+i);
	//alert("fourth");
	
}