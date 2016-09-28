<?php
    $userName = "Bob";
    $target_dir = "users/" . $userName . "/";
    $file = basename($_GET['file']); //$file becomes the name of the file clicked to download with extension
    $file_path = $target_dir . $file; //exact path of the file
    //if file exists, produce download link with headers, otherwise exits with file not found
    if(!$file) {
        die ('file not found');
    } else {
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='. $file);
        header('Content-Transfer-Encoding: binary');
        header('Content-Type: application/octet-stream');
        header('Connection: Keep-Alive');
        header('Content-Length:'. filesize($file_path));
        ob_clean();
        readfile($file_path);
    }
?>
