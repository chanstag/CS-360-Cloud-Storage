<?php
//Makes a group including all the users in the array, Can also be used to add multiple members
//to a preexisting group
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
//Makes a group for one person, Can also be used to add a member to a preexisting group
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
			return "Success";
		}
	
}
//Removes an entire group
function removeGroup($groupName){
		$host = "localhost:3036";
		$user = "root";
		$pass = "Ubuntu14.04";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "DELETE FROM groups WHERE groupName = $groupName";
			$conn->query($sql);
			$conn->close();
			//Put pathname to folde in
			$files = glob("users/". $groupName);
			foreach($files as $file){
				if(is_file($file)){
					unlink($file);
				}
			}
			rmdir("pathname/". $groupName);
			return "Success";
		}
	
}
//Removes single user from group
function removeUserFromGroup($groupName, string $username){
		$host = "localhost:3036";
		$user = "root";
		$pass = "Ubuntu14.04";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "DELETE FROM groups WHERE groupName = $groupName AND member = $username";
			$conn->query($sql);
			$conn->close();
			return "Success";
		}
	
}

//Removes multiple users form a group
function removeUsersFromGroup($groupName, array $users){
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
			$sql = "DELETE FROM groups WHERE groupName = $groupName AND member = $users[i]";
			$conn->query($sql);
			$conn->close();
		}
	}
	return "Success";
	
}

//Removes User from database
function removeUser($username){
		$host = "localhost:3036";
		$user = "root";
		$pass = "Ubuntu14.04";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "DELETE FROM users WHERE username = $username";
			$conn->query($sql);
			$conn->close();
			//Put pathname to folde in
			$files = glob("users/". $username);
			foreach($files as $file){
				if(is_file($file)){
					unlink($file);
				}
			}
			rmdir("pathname/". $username);
			return "Success";
		}
}
//Returns the groups that a username is in, including their personal group
function getAllGroups($username){
			$host = "localhost:3036";
		$user = "root";
		$pass = "Ubuntu14.04";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "SELECT FROM groups WHERE member = $username";
			$result = $conn->query($sql);
			$groups = [];
			for($i = 0; i < $result->num_rows; i++){
				if($row = info->fetch_assoc()){
					groups[$i] = $row["groupName"];
				}
			}
			$conn->close();
			return groups;
		}
}

//Gives all the users in a given group returns an array if successful
function getAllUsers($groupName){
		$host = "localhost:3036";
		$user = "root";
		$pass = "Ubuntu14.04";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "SELECT FROM groups WHERE groupName = $groupName";
			$result = $conn->query($sql);
			$users = [];
			for($i = 0; i < $result->num_rows; i++){
				if($row = info->fetch_assoc()){
					users[$i] = $row["member"];
				}
			}
			$conn->close();
			return users;
		}
}




?>