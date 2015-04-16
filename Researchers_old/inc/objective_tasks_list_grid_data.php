<?php

require_once '../../lib/objectives.php';

$projectObjectives = new Objectives();

//$poet_id = 1;
$project_id = $_REQUEST['project_id'];
$objective_id = $_REQUEST['objective_id'];

if ($objective_id != 0)
    $objectives_rs = $projectObjectives->GetObjectiveTasksPhases($objective_id);
else
    $objectives_rs = $projectObjectives->GetAllObjectivesTasksPhases($project_id);

while ($row = mysql_fetch_array($objectives_rs, MYSQL_ASSOC)) {
    $objectives_list[] = array(
        'project_id' => $row['project_id'],
        'objective_id' => $row['objective_id'],
        'task_id' => $row['task_id'],
        'phase_id' => $row['phase_id'],
        'objective_name' => $row['obj_title'],
        'task_name' => $row['task_name'],
        'phase_name' => $row['phase_name']
    );
}
echo json_encode($objectives_list);
?>
