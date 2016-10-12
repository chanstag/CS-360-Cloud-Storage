<?php

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
				<div class='centered menuBox' onclick='logout();'>Logout</div>
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
			<div id='lginFail'>There was a problem loging in, please try again later.</div>
		</div>
	</body>
</html> ";
}
echo $top.$body;


function login($username,$password){
	$host = "localhost:3036";
	$user = "root";
	$pass = "Ubuntu14.04";

	$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

	if($conn->connect_errno){
		$conn->close;
		return "No MySQL server";
	}
	$info = $conn->query("SELECT * FROM users WHERE username = '$username'");
	if($info->num_rows > 0){
		while($row = $info->fetch_assoc()){
			if(password_verify($password,$row["password"])){
				$info->free;
				$conn->close;
				return "Login User: ". $username;
			}
		}	
	}
	else{
		$info->free;
		$conn->close;
		return "User not registered or password incorrect";
	}
}

function register($username, $password){
	$host = "localhost:3036";
	$user = "root";
	$pass = "Ubuntu14.04";
	$database = "bigreddocstorage";

	$conn = new mysqli($host,$user,$pass,$database);

	if($conn->connect_errno){
		return "No MySQL server";
	}

	
	$previousUsername = $conn->query("SELECT * FROM users WHERE username = '$username'");
	if($previousUsername->num_rows == 0){
		$previousUsername->free;
		$conn->real_escape_string($username);
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
		$conn->real_escape_string($hashPassword);
		$sql = "INSERT INTO groups ".
			"(groupName) ".
			"VALUES ('$username','$username')";
		
		$conn->query($sql);
		$sql = "INSERT INTO users".
			"(username,password,groups) ".
			"VALUES ".
			"('$username','$hashPassword','#username')";
			
		$conn->query($sql);
		$conn->close();
		return "Success";
	}
	else{
		$previousUsername->free;
		echo "not working";
		$conn->close();
		return "Username already exists";
	}
}

?>
