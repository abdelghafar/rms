<?php

session_start();
//header 
require_once '../../lib/objectives.php';

$project_id = $_POST['project_id'];
$seq_id = $_POST['seq_id'];
$obj_name = "";
$obj_desc = "";
$userId = $_SESSION['User_Id'];

$obj = new Objectives();

$isValid = TRUE;


if (!isset($_POST['obj_name']) || empty($_POST['obj_name'])) {
    echo 'من فضلك أدخل  الهدف' . '<br/>';
    $isValid = FALSE;
} else
    $obj_name = mysql_escape_string(trim($_POST['obj_name']));

if (!isset($_POST['obj_desc']) || empty($_POST['obj_desc'])) {
    echo 'من فضلك أدخل طريقة تحقيق الهدف' . '<br/>';
    $isValid = FALSE;
} else
    $obj_desc = mysql_escape_string(trim($_POST['obj_desc']));


$isexist = $obj->isExist($project_id, $seq_id, $obj_name);
if ($isexist == true) {
    echo 'هذا الهذف  موجود فى هذا المشروع من قبل' . '<br/>';
    $isValid = FALSE;
}

if ($isValid == TRUE) {


    try {
        $result = $obj->Save($seq_id, $project_id, $obj_name, $obj_desc);

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
} else {
    echo 'من فضلك أكمل باقي البيانات';
    echo '<input type="hidden" id ="objective_operation_flag" value ="false">';
}
?>