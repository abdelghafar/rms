<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of project_budget_travel
 *
 * @author ahmed
 */
require_once 'mysqlConnection.php';

class project_budget_travel {

    private $tableName = 'project_budget';

    public function __construct() {
        
    }

    public function Save($seq_id, $project_id, $budget_item_id, $amount, $desc) {
        $con = new MysqlConnect();
        if ($seq_id == 0) {
            $stmt = "insert into " . $this->tableName . " (project_id,item_id,amount,`desc`) values (" . $project_id . "," . $budget_item_id . "," . $amount . ",'" . $desc . "' )";
            $con->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "Update " . $this->tableName . " Set project_id=" . $project_id . ", item_id=" . $budget_item_id . ",amount=" . $amount . ",`desc`='" . $desc . "'" . " where seq_id=" . $seq_id;
            $con->ExecuteNonQuery($stmt);
            return mysql_affected_rows();
        }
    }

    public function travel_code() {
        $con = new MysqlConnect();
        $stmt = "SELECT item_id FROM `budget_items` WHERE `item_alias`='travel'";
        $rs = $con->ExecuteNonQuery($stmt);
        $item_id = 0;
        while ($row = mysql_fetch_array($rs)) {
            $item_id = $row[0];
        }
        return $item_id;
    }

    public function GetProjectTravel($project_id) {
        $con = new MysqlConnect();
        $stmt = 'select project_budget.seq_id, project_budget.amount, project_budget.`desc`, budget_items.item_title  from project_budget join budget_items on project_budget.item_id= budget_items.item_id where budget_items.parent_item_id=' . $this->travel_code() . ' and project_budget.project_id=' . $project_id;
        echo $stmt;
        $rs = $con->ExecuteNonQuery($stmt);
        return $rs;
    }

}
