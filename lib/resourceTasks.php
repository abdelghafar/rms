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

class projectTask {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($task_id, $project_id, $task_name, $task_desc, $objective_id, $phase_id) {
        $conn = new MysqlConnect();
        if ($task_id == 0)
            $stmt = "insert into project_tasks (project_id,task_name, task_desc,objective_id,phase_id) values (" .
                    $project_id . ",'" . $task_name . "','" . $task_desc . "'," . $objective_id . "," . $phase_id . ")";
        else
            $stmt = "update project_tasks set `project_id` = $project_id ,`task_name` ='" . $task_name . "' , `task_desc` ='" . $task_desc . "', `objective_id` = $objective_id ,`phase_id` = $phase_id WHERE `task_id` = $task_id";

        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
        /* $conn->ExecuteNonQuery($stmt);
          return mysql_insert_id(); */
    }

    public function Delete($Id) {
        $conn = new MysqlConnect();
        $stmt = "Delete from project_tasks where task_id =" . $Id;
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetProjectTasks($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT pt.task_id,pt.project_id,pt.task_name, pt.task_desc,pt.objective_id,pt.phase_id, pp.phase_name, pp.seq_id" .
                " FROM project_tasks pt INNER JOIN project_phases pp ON pt.phase_id = pp.seq_id WHERE pt.project_id=" . $projectId . " ORDER BY pt.task_id,pp.seq_id ";
        
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetPhaseTasks($phaseId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT pt.task_id,pt.project_id,pt.task_name, pt.task_desc,pt.objective_id,pt.phase_id, pp.phase_name" .
                " FROM project_tasks pt INNER JOIN project_phases pp ON pt.phase_id = pp.seq_id WHERE pt.phase_id=" . $phaseId . " ORDER BY pt.task_name ";

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetTasksData($taskId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM project_tasks WHERE task_id=" . $taskId;
        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);
        return $row;
    }

    public function isExist($project_id, $phase_id, $task_id, $title) {
        $conn = new MysqlConnect();
        $stmt = "SELECT count(task_id) as task_count FROM project_tasks WHERE task_name='" . $title .
                "' AND project_id = " . $project_id . " AND phase_id = " . $phase_id;
        //echo "<br>" . $stmt. "<br>";
        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);
//        echo $row['task_count'];
        if ($task_id == 0) {

            if ($row['task_count'] > 0)
                return true;
            else
                return false;
        } else {
            $stmt2 = "SELECT task_id FROM project_tasks WHERE task_name='" . $title .
                    "' AND project_id = " . $project_id . " AND phase_id = " . $phase_id;

            //echo $stmt2;
            $result2 = $conn->ExecuteNonQuery($stmt2);
            $row2 = mysql_fetch_array($result2);
            //echo $row['poem_count']." ". $row2[id]."--". $poem_id ;
            if ($row['task_count'] > 1 || ($row['task_count'] == 1 && $task_id != $row2[task_id]))
                return true;
            else
                return false;
        }
    }

    public function hasReleatedData($id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id FROM sutff_tasks WHERE task_id=" . $id . " LIMIT 1";
        $result = $conn->ExecuteNonQuery($stmt);
        if (mysql_num_rows($result) > 0)
            return true;
        else
            return false;
    }

}