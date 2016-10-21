<?php

include 'MySQL_functions.php';

$userName = $_POST['user'];
$pass = $_POST['pass'];
$result = register($userName,$pass);
if($result === "Success"){
	
	mkdir('/var/www/html/users/'.$userName);
	//mkdir('$userName');
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



?>