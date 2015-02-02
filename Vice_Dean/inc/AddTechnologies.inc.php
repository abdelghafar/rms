<?php

require_once '../../lib/technologies.php';

$title = $_POST['Title'];
$desc = $_POST['Desc'];
$isVisible = $_POST['chkIsVisible'];
$isValid = true;
if (strlen($title) == 0) {
    $isValid = FALSE;
    echo 'title must not be empty';
}
if ($isValid == TRUE) {
    if ($_GET['action'] == 'insert') {
        //ToDO:insert
        $obj = new Technologies();
        $obj->Save(0, $title, $desc, $isVisible);
    } else if ($_GET['action'] == 'update') {
        //ToDO://Update
    }
    $result;
    if ($result > 0) {
        echo 'تم حفظ البيانات بنجاح';
    } else {
        
    }
} else {
    exit();
}



