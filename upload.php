
<?php
    $userName = "Bob";  //not sure how the user's directory will be stored. Can be changed.
    $target_dir = "users/" . $userName . "/"; //  users/ is the root directory that holds all registrerd users
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $isUploaded = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "The file already exists.<br/>";
        $isUploaded = 0;
    }
    // Check file size, limeted to 10MB
    if ($_FILES["fileToUpload"]["size"] > 10000000) {
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
