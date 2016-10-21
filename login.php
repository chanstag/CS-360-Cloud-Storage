<?php
include 'MySQL_functions.php';

$userName = $_POST['user'];
$pass = $_POST['pass'];
$result = login($userName,$pass);
if(!($result === "No MySQL server" || $result === "User not registered or password incorrect" || $result === "")){

	session_start();
	$_SESSION['name_user'] = $userName;
	$_SESSION['last'] = $userName;
	$_SESSION['lastType'] = "personal";
	echo 1;
}
else {
	echo $result;
}





?>