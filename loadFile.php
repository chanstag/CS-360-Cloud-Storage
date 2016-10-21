<?php

session_start();
$name = $_POST['user'];
$type = $_POST['type'];
$_SESSION['last'] = $name;
$_SESSION['lastType'] = $type;
$path = "/var/www/html/users/".$name."/";
$fileSize;
$date;
if($type == "group"){
	$path = "/var/www/html/".$name."/";
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
	echo "<div class='right centered' id='title' >$name</div>";
    while (false !== ($entry = readdir($handle))) {
        if(!($entry === "." || $entry === "..")){
		$fileSize = formatSize(filesize($path.$entry));
		$date = date("M d Y",filemtime($path.$entry));
		echo "<div class='under'>
                	<div class='right picWrap'><a href='delete.php?file=".$entry."' onclick=\"return confirm('Delete File?');\"><img src='images/delete.png' height='43'></a></div>
                        <div class='right picWrap'><a href='download.php?file=".$entry."'><img src='images/down.png' height='43'></a></div>
			<div class='menuBox'>
				$entry
				<div class='fileData'>
					File Size: $fileSize
				</div>
				<div class ='fileData'>
					Data Added: $date
				</div>
			</div>
			<div/>";
                }
    }
};

function formatSize($bytes) {
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	}
	elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	}
	elseif ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 2) . ' kB';
	}
	elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	}
	elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	}
	else {
		$bytes = '0 bytes';
	}

return $bytes;
}

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
