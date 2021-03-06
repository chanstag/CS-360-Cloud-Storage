<?php

include 'MySQL_functions.php';
session_start();


$top= " <!DOCTYPE html>
<html>
	<head>
		<title>Cloud Storage</title>

		<link rel='icon' href='images/cloud.png'>
		<link rel='stylesheet' type='text/css' href='styles.css'>
		<script src='main.js'></script>
	</head>";


if(isset($_SESSION['name_user']))
{
	//show the file storage for user
	$name = $_SESSION['name_user'];
	$folder = $_SESSION['last'];
	$type = $_SESSION['lastType'];
	$content = $_SESSION['content'];
	$body = "<body id= 'homeB' onload='loadFiles(\"$folder\", \"$type\");'>
		<div id= 'headB'>	
			<div class= 'right' id= 'userB' onclick='menu(\"menu\");'>
				<div class= 'left centered' id= 'userMenu'>$name</div>
				<img src= 'images/user.jpg' height='58'>			
			</div>
			<div class= 'right centered headMenu' id='group' onclick='group();'>Groups</div>
			<div class= 'right centered headMenu' id='personal' onclick='loadFiles(\"$name\", \"personal\");'>Personal</div>
			<div id= 'titlebox'>
				<div id= 'headTitle'>CLOUD STORAGE PROJECT</div>
			</div>
			<div id='menu'>
				<div class='centered menuBox' id='logout' onclick='logout();'>Logout</div>
			</div>
		</div>
		
                <div id='form'>
                        <form action='upload.php' method='post' enctype='multipart/form-data'>
                                Select a File To Upload:
                                <input type='file' name='fileToUpload' id='fileToUpload'>
                                <br/>
                                <input type='submit' value='Upload File' name='submit'>
                        </form>
                </div>
		
			<div class='under' id='content'>
				
			</div>
	
		
	</body>
</html>	";
	
}//<br><br><br><br><br><br><br>

else{
	//show the login & register page
$body = "<body id= 'homeB'><div id='loginBox'>
			<h1>Login</h1>
			Username:<br/>
			<input type='text' id='logUser'><br/>
			Password:<br/>
			<input type='password' id='logPass'><br/>
			<div class='buttonBox'>
				<div class='button right' id='loginButton' onclick='logreg();'>Register</div>
				<div class='button' id='loginButton' onclick='login();'>Login</div>
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
			<div id='lginFail'>There was a problem loging in, please try again later.</div>
		</div>
	</body>
</html> ";
}

echo $top.$body;



?>
