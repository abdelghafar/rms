<?php

require_once '../../lib/research_docs.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['Title'];
$doc_cat_id = $_POST['doc_cat_id'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new Research_Documents();
$fileExtension = end(explode(".", $_FILES["file"]["name"]));
$fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
$destination = '../../uploads/docs/' . $_FILES['file']['name'];
move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/docs/" . $fileName);
$doc_url = 'uploads/docs/' . $fileName;
$size = $_FILES['file']['size'];

$result = $p->Save(0, $title, $Rid, $doc_cat_id, $doc_url, $size, 0, '');
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {

}
