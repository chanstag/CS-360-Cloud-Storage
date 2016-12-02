<?php

session_start();
$name = $_POST['member'];
$newGroup = $_POST['newGroup'];
include 'MySQL_functions.php';
if(strpos($name, ">") || strpos($name, "<")||strpos($newGroup, ">" || strpos($newGroup,"<") || strpos($name, "$") || strpos($newGroup, "$")){
    echo "Sorry please try again with no characters like < or >";
}
else{
echo makeGroup($newGroup,$name);
}
?>