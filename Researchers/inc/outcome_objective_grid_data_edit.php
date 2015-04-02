<?php

require_once '../../lib/objectives.php';
require_once '../../lib/goals_outcomes.php';

$project_id = $_REQUEST['project_id'];
$outcome_id = $_REQUEST['outcome_id'];
$goal_id = $_REQUEST['goal_id'];


$objective = new Objectives();
$obj_rs = $objective->GetObjectivies($project_id);
$goalOutcome = new GoalsOutcomes();

while ($row = mysql_fetch_array($obj_rs, MYSQL_ASSOC)) {
    $goalOutcome_id = $goalOutcome->GetOutcomeGoalObjective($outcome_id, $goal_id, $row['seq_id']);

    if (is_null($goalOutcome_id)) {
        $obj_check = false;
        $goalOutcome_id = 0;
    } else
        $obj_check = true;
    $tasks_list[] = array(
        'seq_id' => $goalOutcome_id,
        'project_id' => $project_id,
        'outcome_id' => $outcome_id,
        'objective_id' => $row['seq_id'],
        'objective_name' => $row['obj_title'],
        'goal_id' => $goal_id,
        'obj_check' => $obj_check
    );
}


//$poet_id = 1;


/* $obj_rs = $goalOutcome->GetAllProjectObjectivesGoals($project_id);

  while ($row = mysql_fetch_array($obj_rs, MYSQL_ASSOC)) {
  //echo "aaa" .$row['seq_id'];
  if (is_null($row['seq_id']))
  $obj_check = false;
  elseif (($row['seq_id'] != null) && ($row['outcome_id'] == $outcome_id) && ($row['goal_id'] == $goal_id))
  $obj_check = true;

  if ((is_null($row['seq_id'])) || (($row['seq_id'] != null) && ($row['outcome_id'] == $outcome_id) && ($row['goal_id'] == $goal_id))) {
  $tasks_list[] = array(
  'seq_id' => $row['seq_id'],
  'project_id' => $row['project_id'],
  'outcome_id' => $row['outcome_id'],
  'objective_id' => $row['objective_id'],
  'objective_name' => $row['obj_title'],
  'goal_id' => $row['goal_id'],
  'obj_check' => $obj_check
  );
  }

  $tasks_list[] = array(
  'seq_id' => $row['seq_id'],
  'project_id' => $row['project_id'],
  'outcome_id' => $row['outcome_id'],
  'objective_id' => $row['objective_id'],
  'objective_name' => $row['obj_title'],
  'goal_id' => $row['goal_id'],
  'obj_check' => $obj_check
  );
  }
  } */
echo json_encode($tasks_list);
?>
