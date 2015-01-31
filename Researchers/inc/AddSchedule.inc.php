<?php

require_once '../../lib/schedule.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['scheduleTitle'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new Schedule();
$fileExtension = end(explode(".", $_FILES["file"]["name"]));
$fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
$destination = '../../uploads/schedule/' . $_FILES['file']['name'];
move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/schedule/" . $fileName);
$result = $p->Save($Rid, $title, 'uploads/budget/' . $fileName, $_FILES['file']['size']);
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {
    
}
