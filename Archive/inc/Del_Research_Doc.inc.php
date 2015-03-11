<?php

require_once '../../lib/research_docs.php';
$seqId = $_GET['seq_id'];
$obj = new Research_Documents(); 
$res = $obj->Delete($seqId);
if ($res == 1)
    echo '<h2>تم حذف البيانات بنجاح</h2>';
else
    echo '<h2>لقد حدث خطأ من قبل النظام برجاء اعادة المحاولة بعد قليل</h2>';
?>
