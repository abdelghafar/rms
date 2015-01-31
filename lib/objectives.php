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

class Objectives {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($projectId, $objTitle, $objDesc) {
        $conn = new MysqlConnect();
        $stmt = "insert into project_objectivies (project_id,obj_title,obj_desc) values (" . $projectId . ",'" . $objTitle . "','" . $objDesc . "')";
        $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function GetObjectivies($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,obj_desc,obj_title FROM project_objectivies WHERE project_id=" . $projectId;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seqId) {
        $conn = new MysqlConnect();
        $stmt = "Delete from project_objectivies where seq_id =" . $seqId;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

}
