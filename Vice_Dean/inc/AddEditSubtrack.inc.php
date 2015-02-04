<?php

require_once '../../lib/Subtracks.php';

print_r($_POST);
$isValid = true;
if (strlen($title) == 0) {
    $isValid = FALSE;
    echo 'title must not be empty';
}
if ($isValid == TRUE) {
    switch ($action) {
        case 'insert': {
                $track_id = $_POST['track_id'];
                $obj = new Subtracks();
                $subtrack_name = $_POST['title'];
                $result = $obj->Save(0, $subtrack_name, $track_id);
                break;
            }
        case 'edit': {
                $subtrackId = $_POST['subtrack_id'];
                $title = $_POST['title'];
                $obj = new Subtracks();
                $result = $obj->Save($subtrackId, $title, $track_id);
                break;
            }
        default: {
                exit();
            }
    }
    $result;
    if ($result > 0) {
        echo 'تم حفظ البيانات بنجاح';
    } else {
        echo 'error' . $result;
    }
} else {
    exit();
}



