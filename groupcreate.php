<?php

session_start();
$name = $_SESSION['name_user'];

$host = "localhost";
$user = "root";
$pass = "";

$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

if($conn->connect_error){
	$conn->close;
	echo "No MySQL server";
}
$newGroup = $_POST['newGroup'];

$sql = "INSERT INTO groups ".
			"(groupName, members) ".
			"VALUES ('$newGroup','$name')";
		
		$conn->query($sql);
mkdir($newGroup);
$_SESSION['last'] = $newGroup;
$_SESSION['lastType'] = "group";
echo 1;
?>