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

    public function Save($projectId, $BudgetTitle, $BudgetUrl, $size) {
        $conn = new MysqlConnect();
        $stmt = "insert into project_budget (project_id,budget_title,budget_url,size) values (" . $projectId . ",'" . $BudgetTitle . "','" . $BudgetUrl . "'," . $size . ")";
        $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function GetBudget($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,budget_url,project_id,budget_title FROM project_budget WHERE project_id=" . $projectId;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seqId) {
        $conn = new MysqlConnect();
        $stmt = "Delete from project_budget where seq_id =" . $seqId;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

}