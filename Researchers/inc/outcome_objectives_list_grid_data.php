<?php

require_once '../../lib/goals_outcomes.php';

$goals_outcomes = new GoalsOutcomes();

//$poet_id = 1;
$project_id = $_REQUEST['project_id'];
$outcome_id = $_REQUEST['outcome_id'];

if ($outcome_id != 0)
    $outcomes_rs = $goals_outcomes->GetOutcomeObjectivesGoals($outcome_id);
else
    $outcomes_rs = $goals_outcomes->GetAllOutcomesObjectivesGoals($project_id);

while ($row = mysql_fetch_array($outcomes_rs, MYSQL_ASSOC)) {
    $outcomes_list[] = array(
        'outcome_id' => $row['outcome_id'],
        'objective_id' => $row['objective_id'],
        'goal_id' => $row['goal_id'],
        'outcome_name' => $row['outcome_title'],
        'goal_name' => $row['goal_title'],
        'objective_name' => $row['obj_title']
    );
}
echo json_encode($outcomes_list);
?>
