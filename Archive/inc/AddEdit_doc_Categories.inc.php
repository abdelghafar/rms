<?php

require_once '../../lib/doc_categories.php';
$seqId = $_POST['seq_id'];
$cat_name = $_POST['cat_name'];
$cat_note = $_POST['cat_notes'];
$obj = new Document_categories();
$res = $obj->Save($seqId, $cat_name, $cat_note);
if ($res == 1) {
    echo '<h4><p>تم حفظ البيانات بنجاح</p></h4>';
} else {
    echo '<h4><p>لقد حدث خطأ من قبل النظام برجاء اعادة المحاولة بعد قليل</p></h4>';
}