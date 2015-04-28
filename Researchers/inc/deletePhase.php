<?php

session_start();
//header 
require_once '../../lib/projectPhases.php';


$isValid = TRUE;

$phase_id = $_POST['phase_id'];

$phase = new projectPhase();

$has_relateddata = $phase->hasReleatedData($phase_id);
if ($has_relateddata == true) {
    echo '<h1 style="text-align=center">لا يمكن حذف هذا البيان لوجود بيانات مرتبطة' . '</h1><br/>';
    echo '<input type="hidden" id ="phase_operation_flag" value ="false">';
    $isValid = FALSE;
}

if ($isValid == TRUE) {

    try {
        $result = $phase->Delete($phase_id);

        if ($result == 'true') {
            echo '<h1 style="text-align=center">' . 'تم حذف البيان بنجاح' . '</h1>';
            echo '<input type="hidden" id ="phase_operation_flag" value ="true">';
        } else {
            echo '<h1 style="text-align=center">' . 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى' . '</h1>';
            echo '<input type="hidden" id ="phase_operation_flag" value ="false">';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>