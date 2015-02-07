<?php

require_once '../../lib/Reseaches.php';
$target_dir = "../../uploads/";
$file_name = "uploads/";
switch ($_GET['type']) {
    case 'arAbsUpload': {
            $target_dir = "../../uploads/abstracts_ar/";
            $file_name.="abstracts_ar/";
            break;
        }
    case 'enAbsUpload': {
            $target_dir = "../../uploads/abstracts_en/";
            $file_name.="abstracts_en/";
            break;
        }
    case 'introUpload': {
            $target_dir = "../../uploads/introductions/";
            $file_name.="introductions/";
            break;
        }
    case 'reviewUpload': {
            $target_dir = "../../uploads/literature_reviews/";
            $file_name.="literature_reviews/";
            break;
        }
    default : {
            break;
        }
}
$prefix = $_GET['q'];
$target_file = $target_dir . $prefix . '_' . basename($_FILES["fileToUpload"]["name"]);
$file_name .= $prefix . '_' . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    var_dump($check);
    if ($check !== false) {
        echo "File is PDF - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not PDF.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "pdf") {
    echo "Sorry, only pdf files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        $obj = new Reseaches();
        $obj->SetAbstract_ar_url($_GET['q'], $file_name);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}