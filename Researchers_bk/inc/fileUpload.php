<?php

require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';

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
    case 'coAuthor_agreement': {
            $target_dir = "../../uploads/coAuthor_agreement/";
            $file_name.="coAuthor_agreement/";
            break;
        }
    case 'OtherPersonal_agreement': {
            $target_dir = "../../uploads/OtherPersonal_agreement/";
            $file_name.="OtherPersonal_agreement/";
            break;
        }
    default : {
            break;
        }
}
$prefix = $_GET['q'];
$target_file = $target_dir . $prefix . '_' . basename($_FILES["fileToUpload"]["name"]);

$file_name .= $prefix . '_' . basename($_FILES["fileToUpload"]["name"]);
if ($_GET['type'] == 'coAuthor_agreement') {
    $person_id = $_GET['person_id'];
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
}

if ($_GET['type'] == 'OtherPersonal_agreement') {
    $person_id = $_GET['person_id'];
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
        $obj = new Reseaches();
        switch ($_GET['type']) {
            case 'arAbsUpload': {
                    $obj->SetAbstract_ar_url($_GET['q'], $file_name);
                    break;
                }
            case 'enAbsUpload': {
                    $obj->SetAbstract_en_url($_GET['q'], $file_name);
                    break;
                }
            case 'introUpload': {
                    $obj->SetIntro_url($_GET['q'], $file_name);
                    break;
                }
            case 'reviewUpload': {
                    $obj->SetLitReview_url($_GET['q'], $file_name);
                    break;
                }
            case 'coAuthor_agreement': {
                    $obj = new research_stuff();
                    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
                    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
                    break;
                }
            case 'OtherPersonal_agreement': {
                    $obj = new research_stuff();
                    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
                    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
                    break;
                }
            default : {
                    break;
                }
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}