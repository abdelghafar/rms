<?php

require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/config.php';

if (isset($_GET['q'])) {
    $prefix = $_GET['q'];
    $target_dir = "../../uploads/" . $prefix . "/";
    $file_name = "uploads/" . $prefix . "/";

    $target_file = $target_dir . sha1(urlencode(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_FILENAME))) . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
    //$file_name .= sha1(urlencode(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_FILENAME))) . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);

    if ($_GET['type'] == 'coAuthor_agreement') {
        $person_id = $_GET['person_id'];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    }
//resume
    if ($_GET['type'] == 'resume') {
        $person_id = $_GET['person_id'];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    }

    if ($_GET['type'] == 'OtherPersonal_agreement') {
        $person_id = $_GET['person_id'];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    }

    $type = filter_input(INPUT_GET, 'type');
    switch ($type) {
        case 'arAbsUpload': {
                $file_name .= 'summary_ar' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'summary_ar' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'enAbsUpload': {
                $file_name .= 'summary_en' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'summary_en' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'introUpload': {
                $file_name .= 'introduction' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'introduction' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'reviewUpload': {
                $file_name .= 'review' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'review' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'research_method': {
                $file_name .= 'research_method' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'research_method' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'objective_approach': {
                $file_name .= 'objective_approach' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'objective_approach' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'objective_tasks': {
                $file_name .= 'objective_tasks' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'objective_tasks' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'working_plan': {
                $file_name .= 'working_plan' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'working_plan' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'value_to_kingdom': {
                $file_name .= 'value_to_kingdom' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'value_to_kingdom' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
        case 'refs': {
                $file_name .= 'refs' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $target_file = $target_dir . 'refs' . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                break;
            }
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
        unlink($target_file);
        //echo "Sorry, file already exists.";
        //$uploadOk = 0;
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
                case 'research_method': {
                        $obj->SetResearch_method_url($_GET['q'], $file_name);
                        break;
                    }
                case 'objective_approach': {
                        $obj->SetObjective_approach_url($_GET['q'], $file_name);
                        break;
                    }
                case 'objective_tasks': {
                        $obj->SetObjective_tasks_url($_GET['q'], $file_name);
                        break;
                    }
                case 'working_plan': {
                        $obj->SetWorkingPlanUrl($_GET['q'], $file_name);
                        break;
                    }
                case 'value_to_kingdom': {
                        $obj->SetValueToKingdomUrl($_GET['q'], $file_name);
                        break;
                    }
                case 'budget': {
                        $obj->SetBudgetUrl($_GET['q'], $file_name);
                        break;
                    }
                case 'outcome_objectives': {
                        $obj->SetOutcomeObjectiveUrl($_GET['q'], $file_name);
                        break;
                    }
                case 'refs': {
                        $obj->SetRefsUrl($_GET['q'], $file_name);
                        break;
                    }

                case 'coAuthor_agreement': {
                        $obj = new research_stuff();
                        $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
                        $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
                        $obj->SetCoAuthor_agreement_url($project_id, $person_id, $file_name);
                        break;
                    }
                case 'OtherPersonal_agreement': {
                        $obj = new research_stuff();
                        $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
                        $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
                        $obj->SetCoAuthor_agreement_url($project_id, $person_id, $file_name);
                        break;
                    }
                case 'resume': {
                        $obj = new research_stuff();
                        $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
                        $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
                        $obj->SetResumeUrl($project_id, $person_id, $file_name);
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
}
