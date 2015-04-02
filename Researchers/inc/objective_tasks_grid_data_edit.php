<?php

require_once '../../lib/projectTasks.php';

$projectTasks = new projectTask();

//$poet_id = 1;
$project_id = $_REQUEST['project_id'];
$objective_id = $_REQUEST['objective_id'];

$tasks_rs = $projectTasks->GetProjectTasks($project_id);

while ($row = mysql_fetch_array($tasks_rs, MYSQL_ASSOC)) {
    if (($row['objective_id'] != 0) && ($row['objective_id'] == $objective_id))
        $obj_task = true;
    else         $obj_task = false;
    $tasks_list[] = array(
        'project_id' => $row['project_id'],
        'phase_id' => $row['phase_id'],
        'task_id' => $row['task_id'],
        'task_name' => $row['task_name'],
        'old_obj_id' => $row['objective_id'],
        'phase_name' => $row['phase_name'],
        'obj_check' => $obj_task
    );
}
echo json_encode($tasks_list);
?>
