<?php

require_once '../../lib/schedule.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['Title'];
$desc = $_POST['Desc'];
$Phase_id = $_POST['PhaseId'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new Schedule();
$result = $p->Save($Rid, $title, $desc, $Phase_id);
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {
    
}
