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

class Objectives
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($seqId, $projectId, $objTitle, $objDesc)
    {
        $conn = new MysqlConnect();
        if ($seqId == 0)
            $stmt = "insert into project_objectivies (project_id,obj_title,obj_desc) values (" . $projectId . ",'" . $objTitle . "','" . $objDesc . "')";
        else
            $stmt = "update project_objectivies set `project_id` = $projectId ,`obj_title` ='" . $objTitle . "' , `obj_desc` ='" . $objDesc . "' WHERE `seq_id` = $seqId";
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
        /* $conn->ExecuteNonQuery($stmt);
          return mysql_insert_id(); */
    }

    public function edit_objective_task($task_id, $objective_id)
    {
        $conn = new MysqlConnect();
        $stmt = "update project_tasks set `objective_id` = " . $objective_id . " WHERE `task_id` = " . $task_id;
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
        /* $conn->ExecuteNonQuery($stmt);
          return mysql_insert_id(); */
    }

    public function GetObjectiveData($seqId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM project_objectivies WHERE seq_id=" . $seqId;
        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);
        return $row;
    }

    public function GetObjectivies($projectId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM project_objectivies WHERE project_id=" . $projectId;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seqId)
    {
        $conn = new MysqlConnect();
        $stmt = "Delete from project_objectivies where seq_id =" . $seqId;

        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function isExist($project_id, $seq_id, $title)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT count(seq_id) as obj_count FROM project_objectivies WHERE obj_title='" . $title .
            "' AND project_id = " . $project_id;
        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);

        if ($seq_id == 0) {

            if ($row['obj_count'] > 0)
                return true;
            else
                return false;
        } else {
            $stmt2 = "SELECT seq_id FROM project_objectivies WHERE obj_title='" . $title .
                "' AND project_id = " . $project_id;

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

    public function GetObjectiveTasksPhases($objectiveId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT po.seq_id as obj_id, po.obj_title, po.obj_desc, pt.task_id,pt.project_id,pt.task_name, pt.objective_id,pt.phase_id, pp.phase_name 
                FROM project_objectivies po INNER JOIN project_tasks pt ON po.seq_id = pt.objective_id 
                INNER JOIN project_phases pp ON pt.phase_id = pp.seq_id WHERE po.seq_id =" . $objectiveId .
            " ORDER BY po.seq_id , pp.seq_id, pt.task_id";


        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetAllObjectivesTasksPhases($projectId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT po.seq_id as obj_id, po.obj_title, po.obj_desc, pt.task_id,pt.project_id,pt.task_name,pt.objective_id,pt.phase_id, pp.phase_name 
                FROM project_objectivies po INNER JOIN project_tasks pt ON po.seq_id = pt.objective_id 
                INNER JOIN project_phases pp ON pt.phase_id = pp.seq_id
                WHERE pp.project_id=" . $projectId .
            " ORDER BY po.seq_id , pp.seq_id, pt.task_id";

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetProjectObjectives($projectId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT po.seq_id objective_id ,po.project_id,po.obj_title, po.outcome_id,pc.seq_id, pc.outcome_title" .
            " FROM project_objectivies po INNER JOIN project_outcome pc ON po.outcome_id = pc.seq_id WHERE po.project_id=" . $projectId . " ORDER BY po.seq_id,objective_id";

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function hasReleatedData($id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT task_id FROM project_tasks WHERE objective_id=" . $id . " LIMIT 1";
        $result = $conn->ExecuteNonQuery($stmt);
        if (mysql_num_rows($result) > 0)
            return true;
        else
            return false;
    }

    public function ProjectHasObjectives($project_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id FROM project_objectivies WHERE project_id=" . $project_id . " LIMIT 1";
        $rs = $conn->ExecuteNonQuery($stmt);

        return $rs;
    }

    public function GetEmptyObjectives($project_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT project_objectivies.seq_id, project_objectivies.obj_title, project_objectivies.project_id, project_tasks.task_id
        FROM dsr_rms.project_objectivies project_objectivies
        LEFT OUTER JOIN dsr_rms.project_tasks project_tasks ON ( project_objectivies.seq_id = project_tasks.objective_id )
        WHERE (
            (project_tasks.task_id IS NULL)
        AND
            (project_objectivies.project_id = " . $project_id . " )
        ) 
        ORDER BY project_objectivies.seq_id ASC";

        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);

        return $rs;
    }

    public function GetEmptyTasks($project_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT project_objectivies.seq_id, project_tasks.task_id, project_tasks.task_name, project_tasks.project_id
                FROM dsr_rms.project_objectivies project_objectivies
                RIGHT OUTER JOIN dsr_rms.project_tasks project_tasks ON ( project_objectivies.seq_id = project_tasks.objective_id )
                WHERE (
                    (project_objectivies.seq_id IS NULL)
                AND
                    (project_tasks.project_id = " . $project_id . " )
                ) 
                ORDER BY project_tasks.task_id ASC";

        $rs = $conn->ExecuteNonQuery($stmt);

        return $rs;
    }

}
