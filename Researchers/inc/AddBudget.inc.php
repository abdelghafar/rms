<?php

require_once '../../lib/budget.php';
require_once '../../lib/Reseaches.php';

$rcode = $_POST['rcode'];
$title = $_POST['budgetTitle'];
$BudgetAmount = $_POST['budget_amount'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
$p = new Budget();
$result = $p->Save($Rid, $title, $BudgetAmount);
if ($result > 0) {
    echo 'تم حفظ البيانات بنجاح';
} else {

}
