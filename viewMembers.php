<?php

$groupName = $_POST['group'];



//Gives all the users in a given group returns an array if successful

		$host = "localhost";
		$user = "root";
		$pass = "";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$sql = "SELECT (members) FROM groups WHERE groupName = '$groupName'";
			$result = $conn->query($sql);
			$users = [];
			while($row = $result->fetch_assoc()){
					$user = $row["members"];
					echo "<div class='under'>		
			<div class='menuBox'>$user</div><div/>";
				
			}
			$conn->close();
			return $user;
		}


?>