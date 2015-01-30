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

class projectPlan {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($projectId, $planTitle, $planUrl, $size) {
        $conn = new MysqlConnect();
        $stmt = "insert into project_plan (project_id,plan_title,plan_url,size) values (" . $projectId . ",'" . $planTitle . "','" . $planUrl . "'," . $size . ")";
        $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function GetProjectPlan($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,plan_url,project_id,plan_title FROM project_plan WHERE project_id=" . $projectId;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seqId) {
        $conn = new MysqlConnect();
        $stmt = "Delete from project_plan where seq_id =" . $seqId;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

}
