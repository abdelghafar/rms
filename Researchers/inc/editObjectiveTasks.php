<?php

session_start();
//header 
require_once '../../lib/objectives.php';

$task_id = $_POST['task_id'];
$objective_id = $_POST['objective_id'];
$oper = $_POST['operation_type'];

$userId = $_SESSION['User_Id'];

$obj = new Objectives();



try {
  $result = $obj->edit_objective_task($task_id, $objective_id);
//    $result = $obj->Save($seq_id, $project_id, $obj_name, $obj_desc);

//        ob_start();
//        header("Location: ../register-done.php");
//        ob_end_flush();
    if ($result == 'true') {
        echo '<h2 style="text-align=center">' . 'تم  تنفيذ العملية بنجاح' . '</h2>';
        echo '<input type="hidden" id ="objective_operation_flag" value ="true">';
    } else {
        echo '<h2 style="text-align=center">' . 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى' . '</h2>';
        echo '<input type="hidden" id ="objective_operation_flag" value ="false">';
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>