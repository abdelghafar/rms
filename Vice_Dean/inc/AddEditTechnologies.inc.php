<?php

require_once '../../lib/technologies.php';

$title = $_POST['Title'];
$desc = $_POST['Desc'];
if (isset($_POST['chkIsVisible'])) {
    $isVisible = 1;
} else {
    $isVisible = 0;
}
print_r($_POST);
$isValid = true;
if (strlen($title) == 0) {
    $isValid = FALSE;
    echo 'title must not be empty';
}
if ($isValid == TRUE) {
    if ($_GET['action'] == 'insert') {
        //ToDO:insert
        $obj = new Technologies();
        $result = $obj->Save(0, $title, $desc, $isVisible);
    } else if ($_GET['action'] == 'edit') {
        $seq_id = $_GET['seq_id'];
        $obj = new Technologies();
        $result = $obj->Save($seq_id, $title, $desc, $isVisible);
    }
    $result;
    if ($result > 0) {
        echo 'تم حفظ البيانات بنجاح';
    } else {
        echo 'error';
    }
} else {
    exit();
}



