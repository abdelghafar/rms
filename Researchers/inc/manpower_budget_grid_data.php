<?php

require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/project_budget_manpower.php';
require_once '../../lib/stuff_tasks.php';
require_once '../../lib/duration_units.php';

$project_id = $_REQUEST['project_id'];
$item_id = $_REQUEST['item_id'];
//$item_id = 15; // for manpower r

$reseach = new Reseaches();
$research_row = $reseach->GetResearch($project_id);
$project_duration = $research_row['proposed_duration'];

$project_array = array();


$research_stuff = new research_stuff();
$research_stuff_rs = $research_stuff->GetProjectAllStuffs($project_id);

$stuff_budget = new project_budget_manpower();

$stuff_tasks = new StuffTasks();
$duration_obj = new DurationUnits();

while ($row = mysql_fetch_array($research_stuff_rs, MYSQL_ASSOC)) {
    $duration = 0;
    $duration_unit = 0;
    $amount = 0;
    for ($i = 1; $i <= $project_duration; $i++) {
        $project_array[$i] = 0;
    }

    $stuff_budget_rs = $stuff_budget->GetStuffBudget($row['person_id'], $project_id, $item_id);
    if ($stuff_budget_row = mysql_fetch_array($stuff_budget_rs, MYSQL_ASSOC)) {
        $seq_id = $stuff_budget_row['seq_id'];
        $compensation = $stuff_budget_row['compensation'];
        $amount = $stuff_budget_row['amount'];
    } else {
        $seq_id = 0;
        $compensation = 0;
    }

    $stuff_tasks_rs = $stuff_tasks->GetProjectTasksPerStuff($project_id, $row['person_id']);
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
    $duration_row = $duration_obj->GetDurationUnitData($dunit_id);
    $duration_unit = $duration_row ['unit_name'];

    $outcomes_list[] = array(
        'seq_id' => $seq_id,
        'project_id' => $project_id,
        'item_id' => $item_id,
        'person_id' => $row['person_id'],
        'person_name' => $row['name_ar'] . "  ---  " . $row['role_name'],
        'duration' => $actual_duration,
        'duration_unit' => $duration_unit,
        'dunit_id' => $dunit_id,
        'compensation' => $compensation,
        'total_amount' => $amount
    );
}
echo json_encode($outcomes_list);
?>
