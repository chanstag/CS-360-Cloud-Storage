<?php
include 'MySQL_functions.php';
$start = microtime();
$userName = $_POST['user'];
$pass = $_POST['pass'];
$result = login($userName,$pass);
if(!($result === "No MySQL server" || $result === "User not registered or password incorrect" || $result === "")){

	session_start();
	$_SESSION['name_user'] = $userName;
	$_SESSION['last'] = $userName;
	$_SESSION['lastType'] = "personal";
	$end = microtime();
	echo $end - $start;
}
else {
	echo $result;
}





?>