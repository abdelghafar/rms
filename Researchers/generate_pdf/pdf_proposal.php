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


    $item_id = 15; // for manpower budget
    $research_stuff = new research_stuff();
    $person = new PersonName();

    $research_stuff_rs = $research_stuff->GetProjectTeam($project_id);

    $stuff_budget = new project_budget_manpower();

    $duration_obj = new DurationUnits();

    while ($row = mysql_fetch_array($research_stuff_rs, MYSQL_ASSOC)) {
        $duration = 0;
        $duration_unit = 0;

        $stuff_budget_rs = $stuff_budget->GetStuffBudget($row['seq_no'], $project_id, $item_id);
        if ($stuff_budget_row = mysql_fetch_array($stuff_budget_rs, MYSQL_ASSOC)) {
            $duration = $stuff_budget_row['duration'];
            $dunit_id = $stuff_budget_row['dunit_id'];

            $duration_row = $duration_obj->GetDurationUnitData($dunit_id);
            $duration_unit = $duration_row ['unit_name'];
        }
        if($dunit_id==1) $duration_unit_en = 'Days'; else  $duration_unit_en = 'Months';

        if ($row['type'] === 'role_based') {
            $role_person = $row['role_name'];
            $role_person_en = $row['role_name_en'];
        } else {
            $role_person = $person->GetPersonName($row['person_id']) . "  ---  " . $row['role_name'];
            $role_person_en = $person->GetPersonNameEn($row['person_id']) . "  ---  " . $row['role_name_en'];
        }


        $manspower_list[] = array(
            'person_id' => $row['person_id'],
            'role_person' => $role_person,
            'role_person_en' => $role_person_en,
            'role_id' => $research_stuff_rs['role_id'],
            'duration' => $duration,
            'duration_unit' => $duration_unit,
            'duration_unit_en' => $duration_unit_en,
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
            'phase_name' => $phases_row['phase_name'],
            'phase_desc' => $phases_row['phase_desc']
        );
    }
    return $phases_list;
}

//======================================= WORK PLAN AND TIME SCHEDUAL
function get_project_work_plan($project_id, $phase_id, $duration) {

    $phaseworkplan = new StuffTasks();
    $person = new PersonName();

    $phaseworkplan_rs = $phaseworkplan->GetPhaseTasksDurations($project_id, $phase_id);

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
        }
        else
            $monthes_no = $phaseworkplan_row['duration'];

        //echo "duration Unit=  " . $phaseworkplan_row['unit_id'] . " duration = " . $phaseworkplan_row['duration'] . " monthes = " . $m_parts . " Extra_ days = " . $extra_days . " Final monthes = " . $monthes_no . "<br>";

        $start_month = $phaseworkplan_row['start_month'];
        $end_month = $start_month + $monthes_no - 1;

        for ($i = $start_month; $i <= $end_month; $i++) {
            $monthes_array[$i] = 1;
        }

        if ($phaseworkplan_row['type'] === 'role_based') {
            $role_person = $phaseworkplan_row['role_name'];
            $role_person_en = $phaseworkplan_row['role_name_en'];
        } else {
            $role_person = $person->GetPersonName($phaseworkplan_row['person_id']) . "  ---  " . $phaseworkplan_row['role_name'];
            $role_person_en = $person->GetPersonNameEn($phaseworkplan_row['person_id']) . "  ---  " . $phaseworkplan_row['role_name_en'];
        }

        if ($duration <= 12) {
            $phases_list[] = array(
                'task_name' => $phaseworkplan_row['task_name'],
                'person_role' => $role_person,
                'person_role_en' => $role_person_en,
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
                'person_role' => $role_person,
                'person_role_en' => $role_person_en,
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
                'person_role' => $role_person,
                'person_role_en' => $role_person_en,
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
            'goal_title' => $row['goal_title'],
            'goal_title_en' => $row['goal_title_en']
        );
    }
    //console . log($objectives_list);
    return $goals_list;
}
