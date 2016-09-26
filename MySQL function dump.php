<?php
//Makes a group including all the users in the array
function makeGroup($groupname, array $users){
	for($i = 0; i < count($users); i++){
		$host = "localhost:3036";
		$user = "root";
		$pass = "Ubuntu14.04";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "INSERT INTO groups ".
					"(groupName,member)".
					" VALUES ('$groupname','$users[i]')";
			$conn->query($sql);
			$conn->close();
		}
	}
	return "Group Added";
	
	
	
}
//Makes s group for one person, Can also be used to add a member to a group
function makeGroup($groupname, string $username){
		$host = "localhost:3036";
		$user = "root";
		$pass = "Ubuntu14.04";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "INSERT INTO groups ".
					"(groupName,member)".
					" VALUES ('$groupname','$usersname')";
			$conn->query($sql);
			$conn->close();
		}
	
}




?>