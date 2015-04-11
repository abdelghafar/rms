<?php

session_start();
require_once '../../lib/users.php';
$project_id = $_POST['project_id'];
$form_name = $_POST['form_name'];

//echo $form_name;

switch ($form_name) {
    case 'phases': // phases&tasks Validation 
        $isValid = TRUE;

        require_once '../../lib/projectTasks.php';
        $tasks = new projectTask(); //========== Get phases which haven't tasks 
        $tasks_rs = $tasks->CountProjectTasks($project_id);

        $row = mysql_fetch_array($tasks_rs);
        if ($row['task_total'] == 0) {
            echo "<h2 style='text-align=center'><u> يجب إدخال مهام للمشروع البحثى </u></label><br>";
            $isValid = FALSE;
        }

        //========== Get phases which haven't tasks 
        require_once '../../lib/projectPhases.php';
        $phases = new projectPhase();
        $emptyphases_rs = $phases->GetEmptyPhases($project_id);
        if (mysql_num_rows($emptyphases_rs) > 0) {
            echo "<br><h2 style='text-align=center'><u> مراحل بدون مهام : </u>";
            while ($row = mysql_fetch_array($emptyphases_rs)) {
                echo " <br> -  " . $row['phase_name'];
            }
            echo "</label> <br>";
            $isValid = FALSE;
        }
        echo $isValid;

        break;

    //***************************************************************
    case 'objectives_tasks':
        $isValid = TRUE;

        require_once '../../lib/objectives.php';
        $objectives = new Objectives(); //========== Get Project Objectives 
        $objectives_rs = $objectives->ProjectHasObjectives($project_id);

        if (!(mysql_fetch_array($objectives_rs))) {
            echo "<h2 style='text-align=center'><u> يجب إدخال أهداف  للمشروع البحثى </u></label><br>";
            $isValid = FALSE;
        }

        //========== Get Objectives which haven't tasks 

        $emptyobjectives_rs = $objectives->GetEmptyObjectives($project_id);
        if (mysql_num_rows($emptyobjectives_rs) > 0) {
            echo "<br><h2 style='text-align=center'><u> أهداف بدون مهام : </u>";
            while ($row = mysql_fetch_array($emptyobjectives_rs)) {
                echo " <br> -  " . $row['obj_title'];
            }
            echo "</label> <br>";
            $isValid = FALSE;
        }

        //========== Get Objectives which haven't tasks 

        $emptytasks_rs = $objectives->GetEmptyTasks($project_id);
        if (mysql_num_rows($emptytasks_rs) > 0) {
            echo "<br><h2 style='text-align=center'><u> مهام بدون أهداف : </u>";
            while ($row = mysql_fetch_array($emptytasks_rs)) {
                echo " <br> -  " . $row['task_name'];
            }
            echo "</label> <br>";
            $isValid = FALSE;
        }

        echo $isValid;


        break;

    //***************************************************************
    case 'resources_tasks':
        $isValid = TRUE;
        require_once '../../lib/research_stuff.php';
        require_once '../../lib/resources.php';
        require_once '../../lib/persons.php';

        $research_stuff = new research_stuff();
        $person = new Persons();

        $resources = new Resources(); //========== Get Project Objectives 
        //========== Get persons which haven't tasks 
        $research_team_rs = $research_stuff->GetProjectTeam($project_id);
        $title_exist = 0;

        while ($stuff_row = mysql_fetch_array($research_team_rs)) {
            $stufftasks_rs = $resources->GetStuffTasks($project_id, $stuff_row['seq_no']);
            if (mysql_num_rows($stufftasks_rs) == 0) {
                if ($stuff_row['type'] === 'role_based') {
                    $role_person = $stuff_row['role_name'];
                } else {
                    $role_person = $person->GetPersonName($stuff_row['person_id']);
                }

                if ($title_exist === 0) {
                    echo "<br><h2 style='text-align=center'><u> أعضاء بالفريق البحثي لم يسند إليهم مهام :";
                    echo " <br> -  " . $role_person;
                    $title_exist = 1;
                    $isValid = FALSE;
                } else
                    echo " <br> -  " . $role_person;
            }
            if ($title_exist === 1)
                echo "</label> <br>";
        }


        //========== Get Tasks which haven't Stuff

        $emptytasks_rs = $resources->GetEmptyTasks($project_id);
        if (mysql_num_rows($emptytasks_rs) > 0) {
            echo "<br><h2 style='text-align=center'><u> مهام بالمشروع البحثي لم تسند إلى أحد أعضاء الفريق البحثي : </u>";
            while ($row = mysql_fetch_array($emptytasks_rs)) {
                echo " <br> -  " . $row['task_name'];
            }
            echo "</label> <br>" .
                $isValid = FALSE;
        }

        echo $isValid;


        break;


    //***************************************************************
    case 'outcomes_objectives':
        $isValid = TRUE;

        require_once '../../lib/outcomes.php';
        $outcomes = new Outcomes(); //========== Get Project Objectives 
        $outcomes_rs = $outcomes->ProjectHasOutcomes($project_id);

        if (!(mysql_fetch_array($outcomes_rs))) {
            echo "<h2 style='text-align=center'><u> يجب إدخال مخرجات المشروع البحثى </u></label><br>";
            $isValid = FALSE;
        }

        //========== Get Outcomes which haven't Objectives 

        $emptyoutcomes_rs = $outcomes->GetEmptyOutcomes($project_id);
        if (mysql_num_rows($emptyoutcomes_rs) > 0) {
            echo "<br><h2 style='text-align=center'><u> مخرجات بدون أهداف : </u>";
            while ($row = mysql_fetch_array($emptyoutcomes_rs)) {
                echo " <br> -  " . $row['outcome_title'];
            }
            echo "</label> <br>" .
                $isValid = FALSE;
        }

        //========== Get Objectives which haven't Outcomes 

        $emptyobjectives_rs = $outcomes->GetEmptyObjectives($project_id);
        if (mysql_num_rows($emptyobjectives_rs) > 0) {
            echo "<br><h2 style='text-align=center'><u> أهداف  بدون مخرجات : </u>";
            while ($row = mysql_fetch_array($emptyobjectives_rs)) {
                echo " <br> -  " . $row['obj_title'];
            }
            echo "</label> <br>" .
                $isValid = FALSE;
        }

        echo $isValid;


        break;
    default:
        break;
}
?>
