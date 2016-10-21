<?php

session_start();
$name = $_SESSION['name_user'];

$host = "localhost";
$user = "root";
$pass = "Ubuntu14.04";

$conn = new mysqli($host,$user,$pass,"bigreddocstorage");

if($conn->connect_error){
	$conn->close;
	echo "No MySQL server";
}

$result = $conn->query("SELECT (groupName) FROM groups WHERE member = '$name'");

echo "<div class='menuBox'><div width='50'><div class='button right' onclick='groupCreate()'>Create</div>Enter Group Name: <input type='text' id='groupName'></div></div>";

while($row = $result->fetch_assoc()){
	
	$group = $row['groupName'];
	echo "<div class='under'>		
			<div class='menuBox' onclick='loadFiles(\"$group\", \"group\");'>$group</div><div/>";
	
}
//echo "here";

//if ($handle = opendir($path)) {
    //echo "Directory handle: $handle\n";
    //echo "Entries:\n";

	
	
    //while (false !== ($entry = readdir($handle))) {
      //  if(!($entry === "." || $entry === "..")){
			
		//echo "<div class='under'>		
			//<div class='menuBox' onclick='loadFiles(\"fire\");'>fire</div><div/>";
	//	}
  //  }
//};
?>
