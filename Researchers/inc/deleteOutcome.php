<?php

session_start();
//header 
require_once '../../lib/outcomes.php';


$isValid = TRUE;

$outcome_id = $_POST['outcome_id'];

$outcome = new Outcomes();

$has_relateddata = $outcome->hasReleatedData($outcome_id);
if ($has_relateddata == true) {
    echo '<h1 style="text-align=center">لا يمكن حذف هذا البيان لوجود بيانات مرتبطة' . '</h1><br/>';
    echo '<input type="hidden" id ="outcome_operation_flag" value ="false">';
    $isValid = FALSE;
}

if ($isValid == TRUE) {

    try {
        $result = $outcome->Delete($outcome_id);
        echo $result;
        if ($result == 'true') {
            echo '<h1 style="text-align=center">' . 'تم حذف البيان بنجاح' . '</h1>';
            echo '<input type="hidden" id ="outcome_operation_flag" value ="true">';
        } else {
            echo '<h1 style="text-align=center">' . 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى' . '</h1>';
            echo '<input type="hidden" id ="outcome_operation_flag" value ="false">';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>