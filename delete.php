<?php
    $userName = "michael_butera";
    $target_dir = "/var/www/html/". $userName . "/";
    $file = basename($_GET['file']); //$file becomes the name of the file clicked to download with extension
    $file_path = $target_dir . $file; //exact path of the file
    if(!$file) {
        die ('file not found');
    } else {
        unlink($file_path);
    }

    header('Location: index.php');
?>