<?php
include 'MySQL_functions.php';

$userName = $_POST['user'];
$pass = $_POST['pass'];
$result = login($userName,$pass);
if(!($result === "No MySQL server" || $result === "User not registered or password incorrect")){

	session_start();
	$_SESSION['name_user'] = $userName;
	$_SESSION['last'] = $userName;
	$_SESSION['lastType'] = "personal";
	echo 1;
}
else {
	echo $result;
}


function login($username,$password){
	$host = "localhost";
	$user = "root";
	$pass = "";

	$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

	if($conn->connect_error){
		$conn->close;
		return "No MySQL server";
	}
	$info = $conn->query("SELECT * FROM users WHERE username = '$username'");
	if($info->num_rows > 0){
		while($row = $info->fetch_assoc()){
			if(password_verify($password,$row["password"])){
				$info->free();
				$conn->close();
				return "Login User: ". $username;
			}
		}	
	}
	else{
		$info->free();
		$conn->close();
		return "User not registered or password incorrect";
	}
}


?>