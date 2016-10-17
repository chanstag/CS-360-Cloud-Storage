<?php

include 'MySQL_functions.php';

$userName = $_POST['user'];
$pass = $_POST['pass'];
$result = register($userName,$pass);
if($result === "Success"){
mkdir($userName);
	session_start();
	$_SESSION['name_user'] = $userName;
	$_SESSION['last'] = $userName;
	$_SESSION['lastType'] = "personal";
	echo 1;
}
else
{
	echo $result ;  
}
function register($username, $password){
	$host = "localhost";          //"localhost:3036"
	$user = "root";
	$pass = "";       //"Ubuntu 14.04"
	$database = "bigreddocstorage";
		$conn = new mysqli($host,$user,$pass,$database);
	if($conn->connect_errno){
		return "No MySQL server";
	}	
	$previousUsername = $conn->query("SELECT * FROM users WHERE username = '$username'");
	if($previousUsername->num_rows == 0){
		$previousUsername->free();
		$conn->real_escape_string($username);
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
		$conn->real_escape_string($hashPassword);
		$sql = "INSERT INTO groups ".
			"(groupName,members) ".
			"VALUES ('$username', '$username')";		
		$conn->query($sql);
		$sql = "INSERT INTO users".
			"(username,password,LogStatus) ".
			"VALUES ".
			"('$username','$hashPassword', '0')";			
		$conn->query($sql);
		$conn->close();
		return "Success";
	}
	else{
		$previousUsername->free();
		echo "not working";
		$conn->close();
		return "Username already exists";
	}
}

?>