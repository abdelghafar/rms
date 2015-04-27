<?php

session_start();
//header 
require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/stuff_tasks.php';
require_once '../../lib/project_budget.php';
require_once '../../lib/project_budget_manpower.php';

$research_stuff = new research_stuff();
$stuff_tasks = new StuffTasks();


$obj = new project_budget();


$project_id = $_REQUEST['project_id'];
$item_id = $_REQUEST['item_id'];

/////////////////////////////////////////

$research_stuff_rs = $research_stuff->GetProjectTeam($project_id);

$stuff_budget = new project_budget_manpower();
while ($row = mysql_fetch_array($research_stuff_rs, MYSQL_ASSOC)) {
    $research_stuff_id = $row['seq_no'];
    $stuff_budget_rs = $stuff_budget->GetStuffBudget($research_stuff_id, $project_id, $item_id);
    if ($stuff_budget_row = mysql_fetch_array($stuff_budget_rs, MYSQL_ASSOC)) {
        
    } else {
        try {
            $project = new Reseaches();
            $project_duration = $project->GetResearchDuration($project_id);
            
            for ($i = 1; $i <= $project_duration; $i++) {
                $project_array[$i] = 0;
            }

            $stuff_tasks_rs = $stuff_tasks->GetProjectTasksPerStuff($project_id, $research_stuff_id);
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
            //print_r($project_array);
            //echo "project_duration= " . $project_duration . "<br>";
            if ($dunit_id == 2) {
                for ($i = 1; $i <= $project_duration; $i++) {
                    if ($project_array[$i] == 1)
                        $actual_duration = $actual_duration + 1;
                    //echo $actual_duration . "<br>";
                }
            }
            //echo $actual_duration . "<br>" . $compensation;

            
            $result = $obj->Save(0, $project_id, $item_id, $research_stuff_id, 0, $actual_duration, $dunit_id, 0);
            /* if ($result !== false ) {
              echo '<h2 style="text-align=center">' . 'تم  تنفيذ العملية بنجاح' . '</h2>';
              echo '<input type="text" id ="new_seq_id" value ='. $result .'>';
              } else {
              echo '<h2 style="text-align=center">' . 'حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى' . '</h2>';
              echo '<input type="hidden" id ="outcome_operation_flag" value ="false">';
              } */
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}



////////////////////////////////////////
?>