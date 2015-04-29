<?php

require_once '../../lib/persons.php';
require_once '../../lib/Council_board.php';

$person_id = $_GET['person_id'];
$obj = new Persons();
$res = $obj->Delete($person_id);
$obj1 = new Council_board();
$res = $obj1->DeleteByPerosnId($person_id);
if ($res == 1)
    echo '<h2>تم حذف البيانات بنجاح</h2>';
else
    echo '<h2>لقد حدث خطأ من قبل النظام برجاء اعادة المحاولة بعد قليل</h2>';
?>
