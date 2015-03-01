<?php

require_once '../../lib/projectTasks.php';

$projectTasks = new projectTask();

//$poet_id = 1;
$project_id = $_REQUEST['project_id'];
$phase_id = $_REQUEST['phase_id'];

if ($phase_id != 0)
    $tasks_rs = $projectTasks->GetPhaseTasks($phase_id);
else
    $tasks_rs = $projectTasks->GetProjectTasks($project_id);

while ($row = mysql_fetch_array($tasks_rs, MYSQL_ASSOC)) {
    $tasks_list[] = array(
        'project_id' => $row['project_id'],
        'phase_id' => $row['phase_id'],
        'task_id' => $row['task_id'],
        'task_name' => $row['task_name'],
//        'start_date' => $row['start_date'],
//        'end_date' => $row['end_date'],
        'task_desc' => $row['task_desc'],
        'objective_id' => $row['objective_id'],
        'phase_name' => $row['phase_name']
    );
}
echo json_encode($tasks_list);
?>
