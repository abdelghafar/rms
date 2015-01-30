<?php

require_once '../../lib/projectPlan.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['budgetTitle'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new projectPlan();
$fileExtension = end(explode(".", $_FILES["file"]["name"]));
$fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
$destination = '../../uploads/budget/' . $_FILES['file']['name'];
move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/budget/" . $fileName);
$result = $p->Save($Rid, $title, 'uploads/budget/' . $fileName, $_FILES['file']['size']);
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {
    
}
