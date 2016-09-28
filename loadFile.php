<?php

session_start();
$path = $_POST['user'];
$type = $_POST['type'];

if($type == "group"){
	echo "<div class='menuBox'><div class='smaller left'><div class='button right' onclick='groupCreate()'>Add</div>Add Member: <input type='text' id='groupName'></div>
	<div class='left smaller'>
				<div class='button right' style='width:130px' onclick='viewMembers(\"$path\")'>View Members</div>
			</div>
			<div class='right smaller'>
				<div class='button right' style='width:130px' onclick='groupRemove(\"$path\")'>Remove Group</div>
			</div>
			<div class='smaller'>
				<div class='button right' onclick='groupCreate()'>Remove</div>
				Remove Member: <input type='text' id='groupName'>
			</div>
			
			</div>";
}

if ($handle = opendir($path)) {


   
    while (false !== ($entry = readdir($handle))) {
        if(!($entry === "." || $entry === "..")){
		
		echo "<div class='under'>
		<div class='right picWrap'><img src='images/delete.png' height='43'></div>
			<div class='right picWrap'><img onclick='download(\"$path\", \"$entry\")' src='images/down.png' height='43'></a></div>
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
