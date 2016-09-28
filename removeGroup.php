<?php 

$groupName = $_POST['group'];

$result = removeGroup($groupName);
if($result === "Success"){
	echo 1;
}
else{
	echo "Failure to Remove Group";
}

//Removes an entire group
function removeGroup($groupName){
			$host = "localhost";
	$user = "root";
	$pass = "";

		$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

		if($conn->connect_error){
			$conn->close();
			return "No MySQL server";
		}
		else{
			$sql = "DELETE FROM groups WHERE groupName = '$groupName'";
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
?>