<?php

require_once '../../lib/research_stuff.php';
require_once '../../lib/project_budget_manpower.php';
require_once '../../lib/stuff_tasks.php';
require_once '../../lib/duration_units.php';

$project_id = $_REQUEST['project_id'];
$item_id = 1; // for manpower budget
$research_stuff = new research_stuff();

$research_stuff_rs = $research_stuff->GetProjectAllStuffs($project_id);

$stuff_budget = new project_budget_manpower();

$stuff_durations = new StuffTasks();
$duration_obj = new DurationUnits();

while ($row = mysql_fetch_array($research_stuff_rs, MYSQL_ASSOC)) {
    $duration = 0;
    $duration_unit = 0;
    $amount =   0;
    
    $stuff_budget_rs = $stuff_budget->GetStuffBudget($row['person_id'], $project_id, $item_id);
    if ($stuff_budget_row = mysql_fetch_array($stuff_budget_rs, MYSQL_ASSOC)) {
        $seq_id = $stuff_budget_row['seq_id'];
        $compensation = $stuff_budget_row['compensation'];
        $amount = $stuff_budget_row['amount'];
    } else {
        $seq_id = 0;
        $compensation = 0;
    }

    $stuff_durations_rs = $stuff_durations->GetProjectDurationPerStuff($project_id, $row['person_id']);
    $duration = 0;
    $duration_unit = 'غير مخصص';
    $dunit_id = 0;
    if ($stuff_durations_row = mysql_fetch_array($stuff_durations_rs, MYSQL_ASSOC)) {
        $duration = $stuff_durations_row['duration_total'];
        $dunit_id = $stuff_durations_row['unit_id'];
        $duration_row = $duration_obj->GetDurationUnitData($stuff_durations_row['unit_id']);
        $duration_unit =$duration_row ['unit_name'];
        
        
        while ($stuff_durations_row = mysql_fetch_array($stuff_durations_rs, MYSQL_ASSOC)) {
            $duration_row = $duration_obj->GetDurationUnitData($stuff_durations_row['unit_id']);
            
            $duration = $duration + $stuff_durations_row['duration_total'] * $duration_row ['convert_factor'];
        }
    }


    $outcomes_list[] = array(
        'seq_id' => $seq_id,
        'project_id' => $project_id,
        'item_id' => $item_id,
        'person_id' => $row['person_id'],
        'person_name' => $row['name_ar'] . "  ---  " . $row['role_name'],
        'duration' => $duration,
        'duration_unit' => $duration_unit,
        'dunit_id' => $dunit_id,
        'compensation' => $compensation,
        'total_amount' => $amount
    );
}
echo json_encode($outcomes_list);
?>
