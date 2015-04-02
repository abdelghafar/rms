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
$stuff_tasks = new StuffTasks();

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
                for ($i = 1; $i <= $project_duration; $i++) {
                    $project_array[$i] = 0;
                }

                $stuff_tasks_rs = $stuff_tasks->GetProjectTasksPerStuff($project_id, $person_id);
                $duration = 0;
                $duration_unit = 'غير مخصص';
                $dunit_id = 0;
                $actual_duration = 0;
                while ($stuff_tasks_row = mysql_fetch_array($stuff_tasks_rs, MYSQL_ASSOC)) {
                    $start_month = $stuff_tasks_row['start_month'];
                    $duration = $stuff_tasks_row['duration'];
                    $dunit_id = $stuff_tasks_row['unit_id'];
                    //echo "<br> start month" . $start_month . "   Duration " . $duration;
                    if ($dunit_id == 1) {
                        $actual_duration = $actual_duration + $duration;
                    } else {
                        for ($i = $start_month; $i < $start_month + $duration; $i++) {
                            $project_array[$i] = 1;
                        }
                    }
                }
                // print_r($project_array);

                if ($dunit_id == 2) {
                    for ($i = 1; $i <= $project_duration; $i++) {
                        if ($project_array[$i] == 1)
                            $actual_duration = $actual_duration + 1;
                    }
                }

                $amount = $actual_duration * $compensation;

                $obj = new project_budget();

                $result2 = $obj->SaveNewStuffDuration($manpower_id, $amount, $actual_duration);
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