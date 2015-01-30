<?php

require_once '../../lib/projectPlan.php';
require_once '../../lib/Reseaches.php';

$p = new projectPlan();
$rcode = $_POST['rcode'];
$title = $_POST['planTitle'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new projectPlan();
$result = $p->Save($Rid, $title, $_FILES['file']['name']);
echo $result;
