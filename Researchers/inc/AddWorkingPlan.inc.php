<?php

require_once '../../lib/projectPlan.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['title'];
$desc = $_POST['desc'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new projectPlan();
$result = $p->Save($Rid, $title, $desc);
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {

}
