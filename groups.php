<?php

session_start();
//$name = $_SESSION['name_user'];
$name = "Master";
$host = "localhost";
$user = "root";
$pass = "Ubuntu14.04";

$conn = new mysqli($host,$user,$pass,"bigreddocstorage");
echo "This is dumb";
if($conn->connect_error){
	$conn->close;
	echo "No MySQL server";
}
echo "This is sorta working";
$result = $conn->query("SELECT (groupName) FROM groups WHERE members = '$name'");
echo "This should be working";

$returnString = "<div class='menuBox'><div width='50'><div class='button right' onclick='groupCreate()'>Create</div>Enter Group Name: <input type='text' id='groupName'></div></div>";
echo "This is bullshit";

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
	
		$group = $row['groupName'];
		$returnString = $returnString."<div class='under'>		
				<div class='menuBox' onclick='loadFiles($group, group);'>$group</div><div/>";
	
	}
}
$result->free();
$conn->close();
echo $returnString;
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
