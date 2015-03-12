<?php

session_start();
//header 
require_once '../../lib/stuff_tasks.php';
require_once '../../lib/project_budget_manpower.php';
require_once '../../lib/project_budget.php';

$seqId = $_REQUEST['seqId'];
$task_id = $_REQUEST['task_id'];
$person_id = $_REQUEST['person_id'];
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
}
else
    $duration = mysql_escape_string(trim($_POST['duration']));


$isexist = $resource->isExist($seqId, $person_id, $task_id);

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
    $stuff_budget_rs = $stuff_budget->GetStuffBudget($person_id, $project_id, $item_id);
    if ($stuff_budget_row = mysql_fetch_array($stuff_budget_rs, MYSQL_ASSOC)) {
        $manpower_id = $stuff_budget_row['seq_id'];
        $compensation = $stuff_budget_row['compensation'];
    }
    else 
    {
         $manpower_id = 0;
    }

    try {
        $result = $resource->Save($seqId, $task_id, $person_id, $start_month, $duration, $unit_id);

//        ob_start();
//        header("Location: ../register-done.php");
//        ob_end_flush();
        if ($result == 'true') {
            
            if($manpower_id <> 0)
            {
                $stuff_duration_rs = $resource->GetProjectDurationPerStuff($project_id, $person_id);
                $stuff_duration_row = mysql_fetch_array($stuff_duration_rs, MYSQL_ASSOC);
                $new_duration = $stuff_duration_row['duration_total'];
                $new_amount = $compensation * $new_duration;
                $obj = new project_budget();
                $result2 = $obj->Save($manpower_id, $stuff_budget_row['project_id'], $stuff_budget_row['item_id'], $stuff_budget_row['stuff_id'], $new_amount, $new_duration, $stuff_budget_row['dunit_id'], $stuff_budget_row['compensation']);
                
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