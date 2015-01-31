<?php

require_once '../../lib/schedule.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['Title'];
$desc = $_POST['Desc'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new Schedule();
$result = $p->Save($Rid, $title, $desc);
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {
    
}
