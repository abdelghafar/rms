<?php

session_start();

//header 
function get_project_objectives($project_id) {


    $objectives = new Objectives();

    //$project_id = 1; //$_REQUEST['project_id'];

    $objectives_rs = $objectives->GetObjectivies($project_id);


    while ($row = mysql_fetch_array($objectives_rs, MYSQL_ASSOC)) {
        $objectives_list[] = array(
            'seq_id' => $row['seq_id'],
            'project_id' => $row['project_id'],
            'obj_title' => $row['obj_title'],
            'obj_desc' => $row['obj_desc']
        );
    }
    //console . log($objectives_list);
    return $objectives_list;
}

//======================================= MAPPING OF PHASES AND TASKS TO ACHIEVE OBJECTIVES
function get_project_objectives_tasks($project_id) {


    $projectObjectives = new Objectives();

//$poet_id = 1;
    /* $project_id = 1; /*$_REQUEST['project_id'];
      $objective_id = $_REQUEST['objective_id'];
     */
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
    return $objectives_list;
}

//======================================= MAPPING OF PHASES AND TASKS TO ACHIEVE OBJECTIVES
function get_project_manpower_durations($project_id) {


    $item_id = 1; // for manpower budget
    $research_stuff = new research_stuff();

    $research_stuff_rs = $research_stuff->GetProjectAllStuffs($project_id);

    $stuff_budget = new project_budget_manpower();

    $stuff_durations = new StuffTasks();
    $duration_obj = new DurationUnits();

    while ($row = mysql_fetch_array($research_stuff_rs, MYSQL_ASSOC)) {
        $duration = 0;
        $duration_unit = 0;
        $amount = 0;

        $stuff_budget_rs = $stuff_budget->GetStuffBudget($row['person_id'], $project_id, $item_id);
        if ($stuff_budget_row = mysql_fetch_array($stuff_budget_rs, MYSQL_ASSOC)) {
            $seq_id = $stuff_budget_row['seq_id'];
            $compensation = $stuff_budget_row['compensation'];
            $amount = $stuff_budget_row['amount'];
        } else {
            $seq_id = 0;
            $compensation = 0;
        }

        $stuff_durations_rs = $stuff_durations->GetProjectDurationPerStuff($project_id, $row['person_id']);
        $duration = 0;
        $duration_unit = 'غير مخصص';
        $dunit_id = 0;
        if ($stuff_durations_row = mysql_fetch_array($stuff_durations_rs, MYSQL_ASSOC)) {
            $duration = $stuff_durations_row['duration_total'];
            $dunit_id = $stuff_durations_row['unit_id'];
            $duration_row = $duration_obj->GetDurationUnitData($stuff_durations_row['unit_id']);
            $duration_unit = $duration_row ['unit_name'];


            while ($stuff_durations_row = mysql_fetch_array($stuff_durations_rs, MYSQL_ASSOC)) {
                $duration_row = $duration_obj->GetDurationUnitData($stuff_durations_row['unit_id']);

                $duration = $duration + $stuff_durations_row['duration_total'] * $duration_row ['convert_factor'];
            }
        }


        $manspower_list[] = array(
            'seq_id' => $seq_id,
            'project_id' => $project_id,
            'item_id' => $item_id,
            'person_id' => $row['person_id'],
            'person_name' => $row['name_ar'],
            'role_name' => $row['role_name'],
            'role_id' => $research_stuff_rs['role_id'],
            'duration' => $duration,
            'duration_unit' => $duration_unit,
            'dunit_id' => $dunit_id,
        );
    }
    return $manspower_list;
}

//======================================= WORK PLAN AND TIME SCHEDUAL
function get_project_phases($project_id) {

    $projectphases = new projectPhase();

    $phases_rs = $projectphases->GetProjectPhases($project_id);

    while ($phases_row = mysql_fetch_array($phases_rs, MYSQL_ASSOC)) {
        $phases_list[] = array(
            'phase_id' => $phases_row['seq_id'],
            'phase_name' => $phases_row['phase_name']
        );
    }
    return $phases_list;
}

//======================================= WORK PLAN AND TIME SCHEDUAL
function get_project_work_plan($phase_id, $duration) {

    $phaseworkplan = new StuffTasks();

    $phaseworkplan_rs = $phaseworkplan->GetPhaseTasksDurations($phase_id);

    while ($phaseworkplan_row = mysql_fetch_array($phaseworkplan_rs, MYSQL_ASSOC)) {
        $monthes_array = array();
        for ($i = 1; $i <= $duration; $i++) {
            $monthes_array[$i] = 0;
        }
        $m_parts = 0;
        $extra_days = 0;
        $monthes_no = 0;

        if ($phaseworkplan_row['unit_id'] == 1) {

            $m_parts = intval($phaseworkplan_row['duration'] / 22);
            $extra_days = $phaseworkplan_row['duration'] % 22;
            if ($extra_days > 0)
                $monthes_no = $m_parts + 1;
            else
                $monthes_no = $m_parts;
        } else
            $monthes_no = $phaseworkplan_row['duration'];

        //echo "duration Unit=  " . $phaseworkplan_row['unit_id'] . " duration = " . $phaseworkplan_row['duration'] . " monthes = " . $m_parts . " Extra_ days = " . $extra_days . " Final monthes = " . $monthes_no . "<br>";

        $start_month = $phaseworkplan_row['start_month'];
        $end_month = $start_month + $monthes_no - 1;

        for ($i = $start_month; $i <= $end_month; $i++) {
            $monthes_array[$i] = 1;
        }

        if ($duration <= 12) {
            $phases_list[] = array(
                'task_name' => $phaseworkplan_row['task_name'],
                'person_role' => $phaseworkplan_row['name_ar'] . " -- " . $phaseworkplan_row['role_name'],
                'm_1' => $monthes_array[1],
                'm_2' => $monthes_array[2],
                'm_3' => $monthes_array[3],
                'm_4' => $monthes_array[4],
                'm_5' => $monthes_array[5],
                'm_6' => $monthes_array[6],
                'm_7' => $monthes_array[7],
                'm_8' => $monthes_array[8],
                'm_9' => $monthes_array[9],
                'm_10' => $monthes_array[10],
                'm_11' => $monthes_array[11],
                'm_12' => $monthes_array[12]
            );
        }
        if ($duration > 12 && $duration <= 18) {
            $phases_list[] = array(
                'task_name' => $phaseworkplan_row['task_name'],
                'person_role' => $phaseworkplan_row['name_ar'] . " -- " . $phaseworkplan_row['role_name'],
                'm_1' => $monthes_array[1],
                'm_2' => $monthes_array[2],
                'm_3' => $monthes_array[3],
                'm_4' => $monthes_array[4],
                'm_5' => $monthes_array[5],
                'm_6' => $monthes_array[6],
                'm_7' => $monthes_array[7],
                'm_8' => $monthes_array[8],
                'm_9' => $monthes_array[9],
                'm_10' => $monthes_array[10],
                'm_11' => $monthes_array[11],
                'm_12' => $monthes_array[12],
                'm_13' => $monthes_array[13],
                'm_14' => $monthes_array[14],
                'm_15' => $monthes_array[15],
                'm_16' => $monthes_array[16],
                'm_17' => $monthes_array[17],
                'm_18' => $monthes_array[18]
            );
        }
        if ($duration > 18 && $duration <= 24) {
            $phases_list[] = array(
                'task_name' => $phaseworkplan_row['task_name'],
                'person_role' => $phaseworkplan_row['name_ar'] . " -- " . $phaseworkplan_row['role_name'],
                'm_1' => $monthes_array[1],
                'm_2' => $monthes_array[2],
                'm_3' => $monthes_array[3],
                'm_4' => $monthes_array[4],
                'm_5' => $monthes_array[5],
                'm_6' => $monthes_array[6],
                'm_7' => $monthes_array[7],
                'm_8' => $monthes_array[8],
                'm_9' => $monthes_array[9],
                'm_10' => $monthes_array[10],
                'm_11' => $monthes_array[11],
                'm_12' => $monthes_array[12],
                'm_13' => $monthes_array[13],
                'm_14' => $monthes_array[14],
                'm_15' => $monthes_array[15],
                'm_16' => $monthes_array[16],
                'm_17' => $monthes_array[17],
                'm_18' => $monthes_array[18],
                'm_19' => $monthes_array[19],
                'm_20' => $monthes_array[20],
                'm_21' => $monthes_array[21],
                'm_22' => $monthes_array[22],
                'm_23' => $monthes_array[23],
                'm_24' => $monthes_array[24]
            );
        }
    }
    return $phases_list;
}

function get_program_goals($project_id) {


    $goals = new ProgramGoals();
    $program_id = $goals->GetprojectProgram($project_id);

    $goals_rs = $goals->GetProgramGoals($program_id);

    while ($row = mysql_fetch_array($goals_rs, MYSQL_ASSOC)) {
        $goals_list[] = array(
            'seq_id' => $row['seq_id'],
            'goal_title' => $row['goal_title']
        );
    }
    //console . log($objectives_list);
    return $goals_list;
}