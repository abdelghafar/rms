<?php

require_once '../../lib/Reseaches.php';

$ResearchId = $_GET['ResearchId'];
$research = new Reseaches();
$res = $research->Withdraw($ResearchId);

if ($res == 1)
    echo '<h2>تم حذف البيانات بنجاح</h2>';
else
    echo '<h2>لقد حدث خطأ من قبل النظام برجاء اعادة المحاولة بعد قليل</h2>';
?>
