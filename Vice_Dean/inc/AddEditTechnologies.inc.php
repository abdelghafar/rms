<?php

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
if ($_POST['token'] == $_SESSION['AddEditTechnologies']['token']) {
    if ($isValid == TRUE) {
        switch ($action) {
            case 'insert': {
                    echo 'insert call';
                    $obj = new Technologies();
                    $result = $obj->Save(0, $title, $desc, $isVisible);

                    break;
                }
            case 'edit': {
                    echo 'update call';
                    $seqId = $_POST['seq_id'];
                    $obj = new Technologies();
                    $result = $obj->Save($seqId, $title, $desc, $isVisible);
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







