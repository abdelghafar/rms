<?php

session_start();
//header 
require_once '../../lib/resources.php';
require_once '../../lib/project_budget_manpower.php';
require_once '../../lib/project_budget.php';
require_once '../../lib/stuff_tasks.php';

$isValid = TRUE;

$seq_id = $_POST['seq_id'];
$project_id = $_POST['project_id'];
$person_id = $_POST['person_id'];
$item_id = 15; // for manpower
$resource = new Resources();

//$has_relateddata = $task->hasReleatedData($task_id);
//if ($has_relateddata == true) {
//    echo '<h1 style="text-align=center">لا يمكن حذف هذا البيان لوجود بيانات مرتبطة' . '</h1><br/>';
//    echo '<input type="hidden" id ="task_operation_flag" value ="false">';
//    $isValid = FALSE;
//}

if ($isValid == TRUE) {
    $stuff_budget = new project_budget_manpower();
    $stuff_budget_rs = $stuff_budget->GetStuffBudget($person_id, $project_id, $item_id);
    if ($stuff_budget_row = mysql_fetch_array($stuff_budget_rs, MYSQL_ASSOC)) {
        $manpower_id = $stuff_budget_row['seq_id'];
        $compensation = $stuff_budget_row['compensation'];
    } else {
        $manpower_id = 0;
    }
    try {
        $result = $resource->Delete($seq_id);

        if ($result == 'true') {
            $stuff_duration = new StuffTasks();
            if ($manpower_id <> 0) {
                $stuff_duration_rs = $stuff_duration->GetProjectDurationPerStuff($project_id, $person_id);
                $stuff_duration_row = mysql_fetch_array($stuff_duration_rs, MYSQL_ASSOC);
                $new_duration = $stuff_duration_row['duration_total'];
                $new_amount = $compensation * $new_duration;
                $obj = new project_budget();
                $result2 = $obj->Save($manpower_id, $stuff_budget_row['project_id'], $stuff_budget_row['item_id'], $stuff_budget_row['stuff_id'], $new_amount, $new_duration, $stuff_budget_row['dunit_id'], $stuff_budget_row['compensation']);
            }
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