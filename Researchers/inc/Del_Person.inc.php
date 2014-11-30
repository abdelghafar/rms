<?php

require_once '../../lib/persons.php';
$personId = $_GET['person_id'];
$obj = new Persons();
$res = $obj->Delete($personId);
if ($res == 1)
    echo '<h2>تم حذف البيانات بنجاح</h2>';
else
    echo '<h2>لقد حدث خطأ من قبل النظام برجاء اعادة المحاولة بعد قليل</h2>';
?>
