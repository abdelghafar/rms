<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of project_budget
 *
 * @author ahmed
 */
require_once 'mysqlConnection.php';

class project_budget {

    private $tableName = 'project_budget';

    public function __construct() {
        
    }

    public function Save($seq_id, $project_id, $item_id, $stuff_id, $amount, $duration, $dunit_id, $compensation) {
        $con = new MysqlConnect();
        if ($seq_id == 0) {
            $stmt = "insert into " . $this->tableName . " (project_id,item_id,stuff_id,amount,duration,dunit_id,compensation) values (" . $project_id . "," . $item_id . "," . $stuff_id . "," . $amount . "," . $duration . "," . $dunit_id . "," . $compensation . ")";
            echo $stmt . '<br/>';
            $con->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            
        }
    }

}
