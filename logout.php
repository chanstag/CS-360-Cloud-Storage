<?php
session_start();

$username = $_SESSION['name_user'];
//Show how git works

include 'MySQL_functions.php';
logout($username);

session_unset();

session_destroy();

?>
