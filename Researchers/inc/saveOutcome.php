<?php

session_start();
//header 
require_once '../../lib/outcomes.php';

$project_id = $_POST['project_id'];
$seq_id = $_POST['seq_id'];
$outcome_name = "";
$outcome_desc = "";
$userId = $_SESSION['User_Id'];

$outcome = new Outcomes();

$isValid = TRUE;




if (!isset($_POST['outcome_name']) || empty($_POST['outcome_name'])) {
    echo 'من فضلك أدخل  الهدف' . '<br/>';
    $isValid = FALSE;
}
else
    $outcome_name = mysql_escape_string(trim($_POST['outcome_name']));


$outcome_desc = mysql_escape_string(trim($_POST['outcome_desc']));


$isexist = $outcome->isExist($project_id, $seq_id, $outcome_name);
if ($isexist == true) {
    echo 'هذا المخرج  موجود فى هذا المشروع من قبل' . '<br/>';
    $isValid = FALSE;
}

if ($isValid == TRUE) {


    try {
        $result = $outcome->Save($seq_id, $project_id, $outcome_name, $outcome_desc);

//        ob_start();
//        header("Location: ../register-done.php");
//        ob_end_flush();
        if ($result == 'true') {
            echo '<h2 style="text-align=center">' . 'تم  تنفيذ العملية بنجاح' . '</h2>';
            echo '<input type="hidden" id ="outcome_operation_flag" value ="true">';
        } else {
            echo '<h2 style="text-align=center">' . 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى' . '</h2>';
            echo '<input type="hidden" id ="outcome_operation_flag" value ="false">';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo 'من فضلك أكمل باقي البيانات';
    echo '<input type="hidden" id ="outcome_operation_flag" value ="false">';
}
?>