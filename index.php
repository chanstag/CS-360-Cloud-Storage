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
<link rel='stylesheet' type='text/css' href='styles.css'>
<script src='main.js'></script>
</head>
<body $back>";

$_SESSION['id_user'] = null;
$_SESSION['name_user'] = "Steve";

if(isset($_SESSION['id_user']))
{
	//show the file storage for user
	$name = $_SESSION['name_user'];
	$body = "
	<div id= 'headB'>	
		<div class= 'right' id= 'userB' onclick='menu(\"menu\");'>
			<div class= 'left centered' id= 'userMenu'>$name</div>
			<img src= 'images/user.jpg' height='58'>			
		</div>
		<div id= 'titlebox'>
			<div id= 'headTitle'>CLOUD STORAGE PROJECT</div>
		</div>
		<div id='menu'>
		<div class='centered menuBox'>Upload Files</div>
		<div class='centered menuBox'>Logout</div>
		</div>
	</div>
	
		<div class='under content'>
			<div class='right picWrap'><img src='images/delete.png' height='43'></div>
			<div class='right picWrap'><img src='images/down.png' height='43'></div>
			<div class='menuBox'>CS 360 Report</div>
		</div>
	
	
		
	";
	
}

else{
	//show the login & register page
$body = "<div id='loginBox'>
			<h1>Login</h1>
			Email:<br/>
			<input type='text' id=''><br/>
			Password:<br/>
			<input type='password' id=''><br/>
			<div class='buttonBox'>
				<div class='button right' onclick='logreg();'>Register</div>
				<div class='button' onclick='login();'>Login</div>
			</div>	
		</div>
		<div id='regBox'>
			<h1>Register</h1>
			First Name:<br/>
			<input type='text' id='firstName'><br/>
			Last Name:<br/>
			<input type='text' id='lastName'><br/>
			Email:<br/>
			<input type='text' id='registerEmail'><br/>
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

function login($username,$password){
	$host = "localhost:3036";
	$user = "root";
	$pass = "Ubuntu 14.04";

	$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

	if($conn->connect-errno){
		return "No MySQL server";
	}
	$hashPassword = passwordhash($password,PASSWORD_DEFAULT);
	$registeredUser = $conn->query("SELECT * FROM users WHERE usernames = ".$username." AND passwords = ".$hashPassword);
	if(!$registeredUser){
		return "User not registered";
	}
	else{
		return "User: ". $username;
	}
}

function register($username, $password){
	$host = "localhost:3036";
	$user = "root";
	$pass = "Ubuntu 14.04";
	$database = "bigreddocstorage";

	$conn = new mysqli($host,$user,$pass,$database);

	if($conn->connect-errno){
		return "No MySQL server";
	}

	
	$previousUsername = $conn->query("SELECT * FROM users WHERE usernames = ".$username);
	if(!$previousUsername){
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT TO groups".
			"(groupName,members)".
			"VALUES (".$username.")";
		$conn->query($sql);
		$sql = "INSERT TO users".
			"(usernames,passwords,groups)".
			"VALUES (".$username.",".$hashPassword.",".$username.")";
		$conn->query($sql);
		$conn->close();
		return "Success";
	}
	else{
		$conn->close();
		return "Username already exists";
	}
}
?>