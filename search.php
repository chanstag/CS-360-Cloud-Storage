<?php

session_start();

echo "<div class='under'>	
			<div class='menuBox'><div class='button right' onclick='findUser()'>Search</div><input type='text' id='findUser'></div><div/>";


if(isset($_POST['search'])){

$nameArray = str_split($_POST['search']);
$group = $_SESSION['last'];
$searchString = "%";
foreach($nameArray as $letter){
	$searchString .= $letter."%";
}


		$host = "localhost";
		$user = "root";
		$pass = "";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		
		else{
			$result = $conn->query("SELECT username FROM users WHERE username Like '$searchString' ");
			while($row = $result->fetch_assoc()){
					$user = $row["username"];
					echo "<div class='under'>	
			<div class='menuBox'><div class='button right' onclick='addToGroup(\"$user\", \"$group\")'>Add</div>$user</div><div/>";
			}
		}
}
?>