<?php

session_start();
require_once '../../lib/technologies.php';

$action = $_POST['action'];
$title = $_POST['Title'];
$desc = $_POST['Desc'];
if (isset($_POST['chkIsVisible'])) {
    $isVisible = 1;
} else {
    $isVisible = 0;
}
$isValid = true;
if (strlen($title) == 0) {
    $isValid = FALSE;
    echo 'title must not be empty';
}
if (isset($_SESSION['AddEditTechnologies']['token'])) {
    if ($isValid == TRUE) {
        switch ($action) {
            case 'insert': {

                    $obj = new Technologies();
                    $result = $obj->Save(0, $title, $desc, $isVisible);
                    unset($_SESSION['AddEditTechnologies']['token']);
                    break;
                }
            case 'edit': {

                    $tech_Id = $_POST['techId'];
                    $obj = new Technologies();
                    $result = $obj->Save($tech_Id, $title, $desc, $isVisible);
                    unset($_SESSION['AddEditTechnologies']['token']);
                    break;
                }
        }
        $result;
        if ($result > 0) {
            echo 'تم حفظ البيانات بنجاح';
        } else {
            print_r($_POST);
            echo $result;
        }
    } else {
        exit();
    }
    unset($_SESSION['AddEditTechnologies']['token']);
} else {
    echo 'لقد تم حفظ هذه البيانات من قبل';
}







