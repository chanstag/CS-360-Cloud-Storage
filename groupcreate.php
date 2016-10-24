<?php

session_start();
$name = $_POST['member'];
$newGroup = $_POST['newGroup'];
include 'MySQL_functions.php';
echo makeGroup($newGroup,$name);

?>