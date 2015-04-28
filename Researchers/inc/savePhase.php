<?php

session_start();
//header 
require_once '../../lib/projectPhases.php';

$project_id = $_POST['project_id'];
$seq_id = $_POST['seq_id'];
$phase_name = "";
$phase_desc = "";
$userId = $_SESSION['User_Id'];

$phase = new projectPhase();

$isValid = TRUE;


if (!isset($_POST['phase_name']) || empty($_POST['phase_name'])) {
    echo 'من فضلك أدخل عنوان المرحلة' . '<br/>';
    $isValid = FALSE;
} else
    $phase_name = mysql_escape_string(trim($_POST['phase_name']));


$isexist = $phase->isExist($project_id, $seq_id, $phase_name);
if ($isexist == true) {
    echo 'عنوان المرحلة موجود فى هذا المشروع من قبل' . '<br/>';
    $isValid = FALSE;
}

$phase_desc = mysql_escape_string(trim($_POST['phase_desc']));


if ($isValid == TRUE) {


    try {
        $result = $phase->Save($seq_id, $project_id, $phase_name, $phase_desc);

//        ob_start();
//        header("Location: ../register-done.php");
//        ob_end_flush();
        if ($result == 'true') {
            echo '<h2 style="text-align=center">' . 'تم  تنفيذ العملية بنجاح' . '</h2>';
            echo '<input type="hidden" id ="phase_operation_flag" value ="true">';
        } else {
            echo '<h2 style="text-align=center">' . 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى' . '</h2>';
            echo '<input type="hidden" id ="phase_operation_flag" value ="false">';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo 'من فضلك أكمل باقي البيانات';
    echo '<input type="hidden" id ="phase_operation_flag" value ="false">';
}
?>