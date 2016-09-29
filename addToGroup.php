<?php

$groupName = $_POST['group'];
$username = $_POST['user'];

$result = addUser($groupName, $username);
if($result === "Success"){
	echo 1;
}
else{
	echo "Failure to Remove User";
}

function addUser($groupname, string $username){
			$host = "localhost";
	$user = "root";
	$pass = "";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "INSERT INTO groups ".
					"(groupName,members)".
					" VALUES ('$groupname','$username')";
			$conn->query($sql);
			$conn->close();
			return "Success";
		}
	
}

?>