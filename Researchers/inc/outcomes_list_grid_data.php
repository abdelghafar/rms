<?php

require_once '../../lib/outcomes.php';

$outcomes = new Outcomes();


//$poet_id = 1;
$project_id = $_REQUEST['project_id'];


$outcomes_rs = $outcomes->GetOutcomes($project_id);


while ($row = mysql_fetch_array($outcomes_rs, MYSQL_ASSOC)) {
    $outcomes_list[] = array(
        'seq_id' => $row['seq_id'],
        'project_id' => $row['project_id'],
        'outcome_title' => $row['outcome_title'],
        'outcome_desc' => $row['outcome_desc']
    );
}
echo json_encode($outcomes_list);
?>
