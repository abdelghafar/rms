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

class Schedule {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($projectId, $scheduleTitle, $scheduleDesc, $phaseId, $StatDate, $endDate) {
        $conn = new MysqlConnect();
        $stmt = "insert into project_schedule (project_id,schedule_title,schedule_desc,phase_id,start_date,end_date) values (" . $projectId . ",'" . $scheduleTitle . "','" . $scheduleDesc . "'," . $phaseId . ",'" . $StatDate . "','" . $endDate . "')";
        $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function GetSchedule($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT schedule_desc,schedule_title,phase_title,start_date,end_date FROM project_schedule join project_plan on project_plan.seq_id = project_schedule.phase_id where project_schedule.project_id=" . $projectId;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seqId) {
        $conn = new MysqlConnect();
        $stmt = "Delete from project_schedule where seq_id =" . $seqId;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

}
