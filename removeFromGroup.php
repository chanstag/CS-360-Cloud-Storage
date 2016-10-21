<?php

include 'MySQL_functions.php';
$groupName = $_POST['group'];
$username = $_POST['user'];

$result = removeUserFromGroup($groupName, $username);
if($result === "Success"){
	echo 1;
}
else{
	echo "Failure to Remove User";
}


?>