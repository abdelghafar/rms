<?php

require_once '../../lib/Tracks.php';

$track_name = $_POST['Title'];
$tech_id = $_GET['tech_id'];
$isValid = true;
if (strlen($track_name) == 0) {
    $isValid = FALSE;
    echo 'title must not be empty';
}
if ($isValid == TRUE) {
    if ($_GET['action'] == 'insert') {
        //ToDO:insert
        $obj = new Tracks();
        $result = $obj->Save(0, $track_name, $tech_id);
    } else if ($_GET['action'] == 'edit') {
        
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



