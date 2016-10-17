<?php 

include 'MySQL_functions.php';

$groupName = $_POST['group'];

$result = removeGroup($groupName);
if($result === "Success"){
	echo 1;
}
else{
	echo "Failure to Remove Group";
}

?>