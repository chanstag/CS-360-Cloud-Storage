<?php

session_start();
$name = $_SESSION['name_user'];
$newGroup = $_POST['newGroup'];
include 'MySQL_functions.php';
echo makeGroup($newGroup,$name);

?>
