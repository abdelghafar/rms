<?php

session_start();
//header 
require_once '../../lib/projectTasks.php';


$isValid = TRUE;

$task_id = $_POST['task_id'];

$task = new projectTask();

$has_relateddata = $task->hasReleatedData($task_id);
if ($has_relateddata == true) {
    echo '<h1 style="text-align=center">لا يمكن حذف هذا البيان لوجود بيانات مرتبطة' . '</h1><br/>';
    echo '<input type="hidden" id ="task_operation_flag" value ="false">';
    $isValid = FALSE;
}

if ($isValid == TRUE) {

    try {
        $result = $task->Delete($task_id);

        if ($result == 'true') {
            echo '<h1 style="text-align=center">' . 'تم حذف البيان بنجاح' . '</h1>';
            echo '<input type="hidden" id ="task_operation_flag" value ="true">';
        } else {
            echo '<h1 style="text-align=center">' . 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى' . '</h1>';
            echo '<input type="hidden" id ="task_operation_flag" value ="false">';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>