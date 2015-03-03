<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of projectPlan
 *
 * @author ahmed
 */
require_once 'mysqlConnection.php';

class StuffTasks {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($seqId, $task_id, $person_id, $start_month, $duration, $unit_id) {
        $conn = new MysqlConnect();
        if ($seqId == 0)
            $stmt = "insert into stuff_tasks (task_id,person_id,start_month,duration,unit_id) values (" . $task_id . "," . $person_id . "," . $start_month . "," . $duration . "," . $unit_id . ")";
        //else
        // $stmt = "update project_objectivies set `project_id` = $projectId ,`obj_title` ='" . $objTitle . "' , `obj_desc` ='" . $objDesc . "' WHERE `seq_id` = $seqId";
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
        /* $conn->ExecuteNonQuery($stmt);
          return mysql_insert_id(); */
    }

    public function Delete($seqId) {
        $conn = new MysqlConnect();
        $stmt = "Delete from stuff_tasks where seq_id =" . $seqId;

        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function isExist($seq_id, $person_id, $task_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT count(seq_id) as obj_count FROM stuff_tasks WHERE task_id=" . $task_id .
                " AND person_id = " . $person_id;

        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);

        if ($seq_id == 0) {

            if ($row['obj_count'] > 0)
                return true;
            else
                return false;
        } else {
            $stmt2 = "SELECT seq_id FROM stuff_tasks WHERE WHERE task_id=" . $task_id .
                    " AND person_id = " . $person_id;

            //echo $stmt2;
            $result2 = $conn->ExecuteNonQuery($stmt2);
            $row2 = mysql_fetch_array($result2);
            //echo $row['poem_count']." ". $row2[id]."--". $poem_id ;
            if ($row['obj_count'] > 1 || ($row['obj_count'] == 1 && $seq_id != $row2[seq_id]))
                return true;
            else
                return false;
        }
    }

    public function GetPhaseTasksResources($phaseId) {
        $conn = new MysqlConnect();
        $stmt = "select pt.task_name, pt.phase_id, p.name_ar, st.seq_id, st.task_id, st.person_id, st.start_month, st.duration, st.unit_id, du.unit_name
            from project_tasks pt INNER JOIN stuff_tasks st ON pt.task_id = st.task_id INNER JOIN persons p ON st.person_id = p.person_id  
             INNER JOIN duration_units du ON st.unit_id = du.seq_id WHERE pt.phase_id=" . $phaseId . " ORDER BY st.start_month ";

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetProjectDurationPerStuff($project_id, $person_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT stuff_tasks.person_id, project_tasks.project_id, stuff_tasks.unit_id, SUM(stuff_tasks.duration) as duration_total
                 FROM project_tasks project_tasks
                 INNER JOIN stuff_tasks stuff_tasks ON ( project_tasks.task_id = stuff_tasks.task_id )
                 GROUP BY stuff_tasks.person_id, project_tasks.project_id, stuff_tasks.unit_id 
                 HAVING project_tasks.project_id =" . $project_id. " AND stuff_tasks.person_id = " .$person_id . 
                " ORDER By stuff_tasks.unit_id";
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

     public function GetPhaseTasksDurations($phase_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT DISTINCT project_tasks.phase_id,
                  stuff_tasks.seq_id,
                  stuff_tasks.task_id,
                  stuff_tasks.person_id,
                  stuff_tasks.start_month,
                  stuff_tasks.duration,
                  stuff_tasks.unit_id,
                  research_stuff.role_id,
                  persons.name_ar,
                  stuff_roles.role_name,
                  duration_units.convert_factor,
                  duration_units.unit_name,
                  project_tasks.task_name
                FROM ((((dsr_rms.research_stuff research_stuff
             INNER JOIN dsr_rms.stuff_tasks stuff_tasks
                ON (research_stuff.person_id = stuff_tasks.person_id))
            INNER JOIN dsr_rms.project_tasks project_tasks
               ON (project_tasks.task_id = stuff_tasks.task_id))
           INNER JOIN dsr_rms.persons persons
              ON (persons.Person_id = stuff_tasks.person_id))
          INNER JOIN dsr_rms.duration_units duration_units
             ON (duration_units.seq_id = stuff_tasks.unit_id))
         INNER JOIN dsr_rms.stuff_roles stuff_roles
            ON (stuff_roles.seq_id = research_stuff.role_id)
                WHERE (project_tasks.phase_id = ". $phase_id. ")
                ORDER BY research_stuff.role_id ASC, persons.name_ar ASC";
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }
}
