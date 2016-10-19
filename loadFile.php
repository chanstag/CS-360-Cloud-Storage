<?php

session_start();
$name = $_POST['user'];
$type = $_POST['type'];
$_SESSION['last'] = $name;
$_SESSION['lastType'] = $type;
$path = "users/".$name;
if($type == "group"){
	$path = $name;
	echo  "<div class='menuBox' style='height:10px'><div class='smaller left'><div class='button right' style='width:130px' onclick='search(\"$path\")'>Add Member</div></div>
	<div class='right smaller'>
				<div class='button right' style='width:130px' onclick='groupRemove(\"$path\")'>Remove Group</div>
			</div>
	<div class='left smaller'>
				<div class='button right' style='width:130px' onclick='viewMembers(\"$path\")'>View Members</div>
			</div>		
			</div>";
}

if ($handle = opendir($path)) {
	echo "<div class='right centered' id='title' >$path</div>";
    while (false !== ($entry = readdir($handle))) {
        if(!($entry === "." || $entry === "..")){
		
		echo "<div class='under'>
                <div class='right picWrap'><a href='delete.php?file=".$entry."'><img src='images/delete.png' height='43'></a></div>
                        <div class='right picWrap'><a href='download.php?file=".$entry."'><img src='images/down.png' height='43'></a></div>
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
