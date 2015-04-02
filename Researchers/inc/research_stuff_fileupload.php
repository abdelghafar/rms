<?php

require_once '../../lib/research_stuff.php';
$target_dir = "../../uploads/";

$file_name = "uploads/";
if (isset($_GET['q']) && isset($_GET['person_id'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
    $target_file = $target_dir . $prefix . '_' . basename($_FILES["fileToUpload"]["name"]);
}

$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //var_dump($check);
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
// Check file size 2*1024*1024
if ($_FILES["fileToUpload"]["size"] > 2 * 1024 * 1024) {
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
        $obj = new research_stuff();
        $obj->SetAccept_letter_url_url($project_id, $person_id, $target_file);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    return $target_file;
}