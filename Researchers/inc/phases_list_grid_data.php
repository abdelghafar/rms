<?php

require_once '../../lib/projectPhases.php';

$projectPhases = new projectPhase();


//$poet_id = 1;
$project_id = $_REQUEST['project_id'];


$phases_rs = $projectPhases->GetProjectPhases($project_id);


while ($row = mysql_fetch_array($phases_rs, MYSQL_ASSOC)) {
    $phases_list[] = array(
        'seq_id' => $row['seq_id'],
        'project_id' => $row['project_id'],
        'phase_name' => $row['phase_name'],
        'phase_desc' => $row['phase_desc']
    );
}
echo json_encode($phases_list);
?>
