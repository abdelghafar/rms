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

class Budget {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($projectId, $scheduleTitle, $scheduleUrl, $size) {
        $conn = new MysqlConnect();
        $stmt = "insert into project_schedule (project_id,schedule_title,schedule_url,size) values (" . $projectId . ",'" . $scheduleTitle . "','" . $scheduleUrl . "'," . $size . ")";
        $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function GetSchedule($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,schedule_url,project_id,schedule_title FROM project_schedule WHERE project_id=" . $projectId;
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
