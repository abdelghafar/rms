<?php

require_once '../../lib/persons.php';
require_once '../../lib/ResearchCenter_Reviewers.php';

$person_id = $_GET['person_id'];
$obj = new Persons();
$res = $obj->Delete($person_id);
$objj = new ResearchCenter_Reviewers();
$res = $objj->DeleteByPersonId($person_id);
if ($res == 1)
    echo '<h2>تم حذف البيانات بنجاح</h2>';
else
    echo '<h2>لقد حدث خطأ من قبل النظام برجاء اعادة المحاولة بعد قليل</h2>';
?>
