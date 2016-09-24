<?php

session_start();

$back = "id= 'homeB'";
$title = "Cloud Storage";
$name = "smith";
$top= " <!DOCTYPE html>
<html>
<head>
<title>$title</title>

<link rel='icon' href='images/cloud.png'>
<link rel='stylesheet' type='text/css' href='css/styles.css'>
<script src='js/main.js'></script>
</head>
<body $back>";

//$_SESSION['id_user'] = 1;
//$_SESSION['name_user'] = "Steve";

if(isset($_SESSION['name_user']))
{
	//show the file storage for user
	$name = $_SESSION['name_user'];
	$body = "
	<div id= 'headB'>	
		<div class= 'right' id= 'userB' onclick='menu(\"menu\");'>
			<div class= 'left centered' id= 'userMenu'>$name</div>
			<img src= 'images/user.jpg' height='58'>			
		</div>
		<div class= 'right centered headMenu' onclick='group();'>Groups</div>
		<div class= 'right centered headMenu' onclick='loadFiles(\"$name\");'>Personal</div>
		<div id= 'titlebox'>
			<div id= 'headTitle'>CLOUD STORAGE PROJECT</div>
		</div>
		<div id='menu'>
		<div class='centered menuBox'>Upload Files</div>
		<div class='centered menuBox'>Logout</div>
		</div>
	</div>
	
		<div class='under' id='content'>
			
		</div>
	
		<form action='test2.php' method='get'>
		<input type='text' name='lname'><br>
  <input type='submit' value='Submit'>
		</form>
		
	";
	
}

else{/**/
	//show the login & register page
$body = "<div id='loginBox'>
			<h1>Login</h1>
			Username:<br/>
			<input type='text' id='logUser'><br/>
			Password:<br/>
			<input type='password' id='logPass'><br/>
			<div class='buttonBox'>
				<div class='button right' onclick='logreg();'>Register</div>
				<div class='button' onclick='login();'>Login</div>
			</div>	
		</div>
		<div id='regBox'>
			<h1>Register</h1>
			Username:<br/>
			<input type='text' id='regUser'><br/>
			Password:<br/>
			<input type='password' id='registerPass'><br/>
			Confirm Password:<br/>
			<input type='password' id='registerPass2'><br/>
			<div class='buttonBox'>
				<div class='button right' onclick='logreg();'>Login</div>
				<div class='button' onclick='register();'>Register</div>
			</div>
			<div id='registerFail'>There was a problem registering, please try again later.</div>
		</div>
	</body>
</html> ";
}
echo $top.$body;

?>