<?php



//$nameArray = explode("","dustin");
$group = $_POST['group'];
//$searchString = "%";
//foreach($nameArray as $letter){
//	$searchString .= $letter."_";
//}


$host = "localhost";
		$user = "root";
		$pass = "";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close;
			return "No MySQL server";
		}
		else{
			$result = $conn->query("SELECT username FROM users");//WHERE username Like '$searchString' 
			while($row = $result->fetch_assoc()){
					$user = $row["username"];
					echo "<div class='under'>	
			<div class='menuBox'><div class='button right' onclick='addToGroup(\"$user\", \"$group\")'>Add</div>$user</div><div/>";
			}
		}

?>