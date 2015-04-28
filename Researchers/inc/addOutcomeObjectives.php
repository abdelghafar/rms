<?php

session_start();
//header 
require_once '../../lib/goals_outcomes.php';

$obj = new GoalsOutcomes();

$objective_id = $_REQUEST['objective_id'];
$outcome_id = $_REQUEST['outcome_id'];
$goal_id = $_REQUEST['goal_id'];

try {
    $result = $obj->Save(0, $goal_id, $outcome_id, $objective_id);
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

?>