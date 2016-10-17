<?php
session_start();

$username = $_SESSION['name_user']

include 'MySQL_functions.php';
logout($username);

session_unset();

session_destroy();

?>
