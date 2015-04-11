<?php

session_start();
//header 
require_once '../../lib/project_budget.php';

$obj = new project_budget();

$seq_id = $_REQUEST['seq_id'];
$project_id = $_REQUEST['project_id'];
$item_id = $_REQUEST['item_id'];
$research_stuff_id = $_REQUEST['research_stuff_id'];
$amount = $_REQUEST['amount'];
$duration = $_REQUEST['duration'];
$dunit_id = $_REQUEST['dunit_id'];
$compensation = $_REQUEST['compensation'];


try {
    $result = $obj->Save($seq_id, $project_id, $item_id, $research_stuff_id, $amount, $duration, $dunit_id, $compensation);
    echo $result;
    /*if ($result !== false ) {
        echo '<h2 style="text-align=center">' . 'تم  تنفيذ العملية بنجاح' . '</h2>';
        echo '<input type="text" id ="new_seq_id" value ='. $result .'>';
    } else {
        echo '<h2 style="text-align=center">' . 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى' . '</h2>';
        echo '<input type="hidden" id ="outcome_operation_flag" value ="false">';
    }*/
} catch (Exception $e) {
    echo $e->getMessage();
}

?>