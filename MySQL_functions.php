<?php

function login($username,$password){
	$host = "localhost";
	$user = "root";
	$pass = "";

	$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

	if($conn->connect_error){
		$conn->close;
		return "No MySQL server";
	}
	$info = $conn->query("SELECT * FROM users WHERE username = '$username'");
	if($info->num_rows > 0){
		while($row = $info->fetch_assoc()){
			if(password_verify($password,$row["password"]) && $row["LogStatus"] == 0){
				$info->free();
				$conn->query('UPDATE users SET LogStatus=1 WHERE username=$username');
				$conn->close();
				return "Login User: ". $username;
			}
		}	
	}
	else{
		$info->free();
		$conn->close();
		return "User not registered or password incorrect";
	}
}

function register($username, $password){
	$host = "localhost";          //"localhost:3036"
	$user = "root";
	$pass = "";       //"Ubuntu 14.04"
	$database = "bigreddocstorage";
		$conn = new mysqli($host,$user,$pass,$database);
	if($conn->connect_errno){
		return "No MySQL server";
	}	
	$previousUsername = $conn->query("SELECT * FROM users WHERE username = '$username'");
	if($previousUsername->num_rows == 0){
		$previousUsername->free();
		$conn->real_escape_string($username);
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
		$conn->real_escape_string($hashPassword);
		$sql = "INSERT INTO groups ".
			"(groupName,members) ".
			"VALUES ('$username', '$username')";		
		$conn->query($sql);
		$sql = "INSERT INTO users".
			"(username,password,LogStatus) ".
			"VALUES ".
			"('$username','$hashPassword', '0')";			
		$conn->query($sql);
		$conn->close();
		return "Success";
	}
	else{
		$previousUsername->free();
		echo "not working";
		$conn->close();
		return "Username already exists";
	}
}

function logout($username){
	$conn = getMySQLConnection();
	
	if($conn->connect_error){
		$conn->close;
		return "No MySQL server";
	}
	
	$conn->query('UPDATE users SET LogStatus=0 WHERE username = $username');
	$conn->close();
	return "Logout Successful";
	
}

function getMySQLConnection(){
	$host = "localhost";
	$user = "root";
	$pass = "";

	$conn = new mysqli($host,$user,$pass,"bigreddocstorage");
	
	return $conn;
}

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
			$files = glob("pathname/". $groupName);
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
			$files = glob("pathname/". $username);
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