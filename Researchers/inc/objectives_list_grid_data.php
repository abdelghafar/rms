<?php

require_once '../../lib/objectives.php';

$objectives = new Objectives();


//$poet_id = 1;
$project_id = $_REQUEST['project_id'];


$objectives_rs = $objectives->GetObjectivies($project_id);


while ($row = mysql_fetch_array($objectives_rs, MYSQL_ASSOC)) {
    $objectives_list[] = array(
        'seq_id' => $row['seq_id'],
        'project_id' => $row['project_id'],
        'obj_title' => $row['obj_title'],
        'obj_desc' => $row['obj_desc']
    );
}
echo json_encode($objectives_list);
?>
