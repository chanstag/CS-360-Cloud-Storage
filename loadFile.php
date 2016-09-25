<?php

session_start();
$path = $_POST['user'];

//echo "here";

if ($handle = opendir($path)) {


   
    while (false !== ($entry = readdir($handle))) {
        if(!($entry === "." || $entry === "..")){
		
		echo "<div class='under'>
		<div class='right picWrap'><img src='images/delete.png' height='43'></div>
			<div class='right picWrap'><img src='images/down.png' height='43'></div>
			<div class='menuBox'>$entry</div><div/>";
		}
    }
};

function login($username,$password){
	$host = 'localhost:3036';
	$user = 'root';
	$pass = 'Ubuntu 14.04';

	$conn = mysql_connect($host,$user,$pass);

	if(! $conn){
		return "No MySQL server";
	}
	mysql_select_db('bigreddocstorage');
	$hashPassword = passwordhash($password,PASSWORD_DEFAULT);
	$registeredUser = mysql_query("SELECT * FROM users WHERE usernames = '$username' AND passwords = '$hashPassword'",$conn);
	if(!$registerUser){
		return "User not registered";
	}
	else{
		return "User: ". $username;
	}
}
?>