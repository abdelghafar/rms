<?php

require_once '../../lib/resources.php';
require_once '../../lib/person_name.php';
$resourcesTasks = new Resources();
$person = new PersonName();

//$poet_id = 1;
$project_id = $_REQUEST['project_id'];
$phase_id = $_REQUEST['phase_id'];

if ($phase_id != 0)
    $resources_rs = $resourcesTasks->GetPhaseTasksResources($phase_id);
else
    $resources_rs = $resourcesTasks->GetProjectTasksResources($project_id);

while ($row = mysql_fetch_array($resources_rs, MYSQL_ASSOC)) {
    if ($row['type'] === 'role_based') {
        $role_person = $row['role_name'];
    } else {
        $role_person = $person->GetPersonName($row['person_id']);
    }
    $resources_list[] = array(
        'phase_id' => $row['phase_id'],
        'seq_id' => $row['seq_id'],
        'research_stuff_id' => $row['seq_no'],
        'task_id' => $row['task_id'],
        'person_id' => $row['person_id'],
        'unit_id' => $row['unit_id'],
        'phase_name' => $row['phase_name'],
        'task_name' => $row['task_name'],
        'role_person' => $role_person,
        'start_month' => $row['start_month'],
        'duration' => $row['duration'],
        'unit_name' => $row['unit_name']
    );
}
echo json_encode($resources_list);
?>
