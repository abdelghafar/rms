<?php

require_once '../../lib/objectives.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['Title'];
$desc = $_POST['Desc'];

$r = new Reseaches();
$projectId = $r->GetResearchId($rcode);
$p = new Objectives();
//$fileExtension = end(explode(".", $_FILES["file"]["name"]));
//$fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
//$destination = '../../uploads/budget/' . $_FILES['file']['name'];
//move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/budget/" . $fileName);
$result = $p->Save($projectId, $title, $desc);
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {

}
