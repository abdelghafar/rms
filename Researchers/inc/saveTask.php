<?php

session_start();
//header 
require_once '../../lib/projectTasks.php';

$project_id = $_POST['project_id'];
$phase_id = $_POST['phase_id'];
$task_id = $_POST['task_id'];

$task_name = "";
//$start_date="";
//$end_date="";
$task_desc = "";
$objective_id = 0;
$userId = $_SESSION['User_Id'];

$task = new projectTask();

$isValid = TRUE;


if (!isset($_POST['task_name']) || empty($_POST['task_name'])) {
    echo 'من فضلك أدخل عنوان المهمة' . '<br/>';
    $isValid = FALSE;
}
else
    $task_name = mysql_escape_string(trim($_POST['task_name']));


$isexist = $task->isExist($project_id, $phase_id, $task_id, $task_name);
if($isexist==true)
{
    echo 'عنوان المهمة موجود فى هذا المشروع من قبل' . '<br/>';
    $isValid = FALSE;
}

$task_desc = mysql_escape_string(trim($_POST['task_desc']));
/*$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
*/
if ($isValid == TRUE) {

    
    try {
        $result = $task->Save($task_id, $project_id, $task_name,$task_desc,$objective_id,$phase_id);

//        ob_start();
//        header("Location: ../register-done.php");
//        ob_end_flush();
     if ($result == 'true')   
     {
//         echo '<h2 style="text-align=center">'. 'تم  تنفيذ العملية بنجاح'.'</h2>'; 
         echo '<input type="hidden" id ="task_operation_flag" value ="true">';
     }
     else 
     {
//         echo '<h2 style="text-align=center">'. 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى'.'</h2>';
         echo '<input type="hidden" id ="task_operation_flag" value ="false">';
     }
    } 
    catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo 'من فضلك أكمل باقي البيانات';
     echo '<input type="hidden" id ="task_operation_flag" value ="false">';
}
?>