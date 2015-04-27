<?php

session_start();
//header 
require_once '../../lib/stuff_tasks.php';
require_once '../../lib/project_budget_manpower.php';
require_once '../../lib/project_budget.php';
require_once '../../lib/Reseaches.php';

$seqId = $_REQUEST['seqId'];
$task_id = $_REQUEST['task_id'];
$research_stuff_id = $_REQUEST['research_stuff_id'];
$start_month = $_REQUEST['start_month'];
$duration = $_REQUEST['duration'];
$unit_id = $_REQUEST['unit_id'];
$project_id = $_REQUEST['project_id'];
$item_id = 15; // for manpower
//$task_name = "";
////$start_date="";
////$end_date="";
//$task_desc = "";
//$objective_id = 0;
//$userId = $_SESSION['User_Id'];

$resource = new StuffTasks();

$isValid = TRUE;


if (!isset($_POST['duration']) || empty($_POST['duration']) || ($_POST['duration'] <= 0)) {
    echo 'من فضلك أدخل مدة تنفيذ المهمة بشكل صحيح' . '<br/>';
    $isValid = FALSE;
} else
    $duration = mysql_escape_string(trim($_POST['duration']));


$isexist = $resource->isExist($seqId, $research_stuff_id, $task_id);

if ($isexist == true) {
    echo 'تم تخصيص هذه المهمة لهذا الباحث من قبل' . '<br/>';
    $isValid = FALSE;
}

//$task_desc = mysql_escape_string(trim($_POST['task_desc']));
/* $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
 */
if ($isValid == TRUE) {

    $stuff_budget = new project_budget_manpower();
    $stuff_budget_rs = $stuff_budget->GetStuffBudget($research_stuff_id, $project_id, $item_id);
    if ($stuff_budget_row = mysql_fetch_array($stuff_budget_rs, MYSQL_ASSOC)) {
        $manpower_id = $stuff_budget_row['seq_id'];
        $compensation = $stuff_budget_row['compensation'];
    } else {
        $manpower_id = 0;
    }

    try {
        $result = $resource->Save($seqId, $task_id, $research_stuff_id, $start_month, $duration, $unit_id);

//        ob_start();
//        header("Location: ../register-done.php");
//        ob_end_flush();
        if ($result == 'true') {
            $project = new Reseaches();
            $project_duration = $project->GetResearchDuration($project_id);

            if ($manpower_id <> 0) {
                for ($i = 1; $i <= $project_duration; $i++) {
                    $project_array[$i] = 0;
                }

                $stuff_tasks_rs = $resource->GetProjectTasksPerStuff($project_id, $research_stuff_id);
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
//         echo '<h2 style="text-align=center">'. 'تم  تنفيذ العملية بنجاح'.'</h2>'; 
            echo '<input type="hidden" id ="task_operation_flag" value ="true">';
        } else {
//         echo '<h2 style="text-align=center">'. 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى'.'</h2>';
            echo '<input type="hidden" id ="task_operation_flag" value ="false">';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo 'من فضلك أكمل باقي البيانات';
    echo '<input type="hidden" id ="task_operation_flag" value ="false">';
}
?>