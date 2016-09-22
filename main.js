//allows for changing styles of elements
function s(i)
{
	//alert(i);
	return document.getElementById(i).style;
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