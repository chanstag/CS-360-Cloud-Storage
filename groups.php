<?php

session_start();
$path = $_SESSION['name_user'];

//echo "here";

//if ($handle = opendir($path)) {
    //echo "Directory handle: $handle\n";
    //echo "Entries:\n";

	echo "<div class='menuBox'><div width='50'><div class='button right' onclick='groupCreate()'>Create</div>Enter Group Name: <input type='text' id='groupName'></div></div>";
	
    //while (false !== ($entry = readdir($handle))) {
      //  if(!($entry === "." || $entry === "..")){
			
		echo "<div class='under'>		
			<div class='menuBox' onclick='loadFiles(\"fire\");'>fire</div><div/>";
	//	}
  //  }
//};
?>