<?php

require_once '../../lib/projectPlan.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['planTitle'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new projectPlan();
$fileExtension = end(explode(".", $_FILES["file"]["name"]));
$fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
$destination = '../../uploads/plans/' . $_FILES['file']['name'];
move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/plans/" . $fileName);
$result = $p->Save($Rid, $title, 'uploads/plans/' . $fileName, $_FILES['file']['size']);
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {
    
}
