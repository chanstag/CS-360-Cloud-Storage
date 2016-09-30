
<?php
    session_start();
    //$userName = "michael_butera";  //hardcoded my username
    $userName = $_SESSION['name_user'];
    $target_dir = "/var/www/html/" . $userName . "/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $isUploaded = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "The file already exists.<br/>";
        $isUploaded = 0;
    }
    // Check file size, limeted to 50MB
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Your file is too large.<br/>";
        $isUploaded = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($isUploaded == 0) {
        echo "Your file was not uploaded.<br/>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "There was an error uploading your file.<br/>";
        }
    }
    //if the files was uploaded ($isUploaded == 1) then redirect to the index page
    if($isUploaded == 1) {
        header("Location: index.php"); //redirect to page after file is uploaded
    } else 
        echo "Your file was not uploaded successfully.";

?>
