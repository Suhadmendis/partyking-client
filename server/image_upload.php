<?php

session_start();


require_once ("../DB_connector.php");

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "upload") {
    
    $target_dir = "../uploads/1/products/";
    $filename = explode(".",$_FILES["file"]["name"]);
    
    $uniq = uniqid();
    
    $filename =  $uniq.'.'.$filename[sizeof($filename)-1];
    

    $target_file = $target_dir . $filename;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        echo $filename;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }



}

if ($_GET["Command"] == "post_to_hdd") {
    
    $target_dir = "../uploads/1/post_products/";
    $filename = explode(".",$_FILES["file"]["name"]);
    
    $uniq = uniqid();
    
    $filename =  $uniq.'.'.$filename[sizeof($filename)-1];
    

    $target_file = $target_dir . $filename;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        echo $filename;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }



}
































if ($_GET["Command"] == "store_logo_upload") {
    
    $target_dir = "../uploads/store_logo/";
    $filename = explode(".",$_FILES["file"]["name"]);
    
    $uniq = uniqid();
    
    $filename =  $uniq.'.'.$filename[sizeof($filename)-1];
    

    $target_file = $target_dir . $filename;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 1048576) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
            try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn->beginTransaction();

                    $sql_store      = "SELECT REF FROM m_store_registration where seller_ref = '" . $_SESSION['REF'] . "'";
                        $resul    = $conn->query($sql_store);
                        $row_store      = $resul->fetch();
            
                        $sql    = "update m_store_registration set img_logo = '" . $filename . "' where REF = '" . $row_store['REF'] . "'";
                        $result = $conn->query($sql);
                        

                        $conn->commit();
                        echo $filename;
                
                    

                } catch (Exception $e) {
                    $conn->rollBack();
                    echo $e;
                }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }



}

if ($_GET["Command"] == "store_logo_post_to_hdd") {
    
    $target_dir = "../uploads/1/post_products/";
    $filename = explode(".",$_FILES["file"]["name"]);
    
    $uniq = uniqid();
    
    $filename =  $uniq.'.'.$filename[sizeof($filename)-1];
    

    $target_file = $target_dir . $filename;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "JPEG") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        echo $filename;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }



}



?>