<?php
    session_start();
    $userName = $_SESSION['last'];
    if($_SESSION['lastType'] == "group"){
        $target_dir = "/var/www/html/" . $userName . "/";
        //echo "group";
    }
    else {
        $target_dir = "/var/www/html/users/" . $userName . "/";
        //echo "person";
    }
    $file = $_GET["file"]; //$file becomes the name of the file clicked to download with extension
    $file_path = $target_dir . $file; //exact path of the file
    if(!$file) {
        die ('file not found');
    } else {
        unlink($file_path);
    }

    header('Location: index.php');
?>
