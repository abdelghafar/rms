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

class projectPhase
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($seqId, $projectId, $phaseName, $phaseDesc)
    {
        $conn = new MysqlConnect();
        if ($seqId == 0)
            $stmt = "insert into project_phases (project_id,phase_name,phase_desc) values (" . $projectId . ",'" . $phaseName . "','" . $phaseDesc . "')";
        else
            $stmt = "update project_phases set `project_id` = $projectId ,`phase_name` ='" . $phaseName . "' , `phase_desc` ='" . $phaseDesc . "' WHERE `seq_id` = $seqId";
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
        /* $conn->ExecuteNonQuery($stmt);
          return mysql_insert_id(); */
    }

    public function Delete($seqId)
    {
        $conn = new MysqlConnect();
        $stmt = "Delete from project_phases where seq_id =" . $seqId;
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetProjectPhases($projectId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,project_id,phase_name,phase_desc FROM project_phases WHERE project_id=" . $projectId;
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        //print_r($rs);
        return $rs;
    }

    public function GetPhaseData($seqId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM project_phases WHERE seq_id=" . $seqId;
        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);
        return $row;
    }

    public function isExist($project_id, $seq_id, $title)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT count(seq_id) as phase_count FROM project_phases WHERE phase_name='" . $title .
            "' AND project_id = " . $project_id;
        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);

        if ($seq_id == 0) {

            if ($row['phase_count'] > 0)
                return true;
            else
                return false;
        } else {
            $stmt2 = "SELECT seq_id FROM project_phases WHERE phase_name='" . $title .
                "' AND project_id = " . $project_id;

            //echo $stmt2;
            $result2 = $conn->ExecuteNonQuery($stmt2);
            $row2 = mysql_fetch_array($result2);
            //echo $row['poem_count']." ". $row2[id]."--". $poem_id ;
            if ($row['phase_count'] > 1 || ($row['phase_count'] == 1 && $seq_id != $row2[seq_id]))
                return true;
            else
                return false;
        }
    }

    public function hasReleatedData($id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT task_id FROM project_tasks WHERE phase_id=" . $id . " LIMIT 1";
        $result = $conn->ExecuteNonQuery($stmt);
        if (mysql_num_rows($result) > 0)
            return true;
        else
            return false;
    }

    public function GetEmptyPhases($project_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT project_phases.seq_id,
         project_phases.phase_name,
         project_tasks.task_id,
         project_phases.project_id
    FROM project_phases
         LEFT OUTER JOIN
           project_tasks
         ON (project_phases.seq_id = project_tasks.phase_id)
   WHERE (project_tasks.task_id IS NULL) AND (project_phases.project_id = " . $project_id . " )
   ORDER BY project_phases.seq_id ASC";

        $rs = $conn->ExecuteNonQuery($stmt);

        return $rs;
    }


}