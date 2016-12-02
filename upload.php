<?php

	$start = microtime();
    session_start();
    //if there was no file selected, it prompts an alert and reloads the page
    if(!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE) {
        header('Refresh:0; url=index.php');
        echo '<script type="text/javascript">
                  alert("Please Select a File");
              </script>';
    }
    else {
        $userName = $_SESSION['last'];
       	$target_dir = "/var/www/html/users/" . $userName . "/";
        $file = basename($_FILES["fileToUpload"]["name"]);
        $cleanFile = preg_replace('/[^A-Za-z0-9\-\(\)\. ]/', '', $file);
        $target_file = $target_dir . $cleanFile;
        $isUploaded = 1;

        // Check if file already exists
        if (file_exists($target_file)) {
	 	header('Refresh:0; url=index.php');
            	echo '<script type="text/javascript">
                  	   alert("File Already Exists");
                      </script>';
            	$isUploaded = 0;
        }
        // Check file size, limeted to 50MB
        elseif ($_FILES["fileToUpload"]["size"] > 50000000) {
		header('Refresh:0; url=index.php');
		echo '<script type="text/javascript">
                           alert("File is Too Large (50MB Maximum)");
                      </script>';
            	$isUploaded = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        elseif ($isUploaded == 0) {
		header('Refresh:0; url=index.php');
            	echo '<script type="text/javascript">
                  	   alert("Something went wrong...");
              	      </script>';
        // if everything is ok, try to upload file
        } else {
            	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$end = microtime();
					$time = $end - $start;
					echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.  ".$time;
            	} else {
                	echo "There was an error uploading your file.<br/>";
            	}
        }
        //if the files was uploaded ($isUploaded == 1) then redirect to the index page
        	if($isUploaded == 1) {
				
                	echo '<script type="text/javascript">
                  	   alert('.$time.');
              	      </script>';
            		header("Location: index.php"); //redirect to page after file is uploaded
        	} else 
            		echo "Your file was not uploaded successfully.";
    } 
?>
