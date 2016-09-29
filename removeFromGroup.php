<?php

$groupName = $_POST['group'];
$username = $_POST['user'];

$result = removeUserFromGroup($groupName, $username);
if($result === "Success"){
	echo 1;
}
else{
	echo "Failure to Remove User";
}

//Removes single user from group
function removeUserFromGroup($groupName, string $username){
		$host = "localhost";
	$user = "root";
	$pass = "";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "DELETE FROM groups WHERE groupName = '$groupName' AND members = '$username'";
			$conn->query($sql);
			$conn->close();
			return "Success";
		}
	
}

?>