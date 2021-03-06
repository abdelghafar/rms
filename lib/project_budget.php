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

class project_budget
{

    private $tableName = 'project_budget';

    public function __construct()
    {

    }

    public function Save($seq_id, $project_id, $item_id, $research_stuff_id, $amount, $duration, $dunit_id, $compensation)
    {
        $con = new MysqlConnect();
        if ($seq_id == 0) {
            $stmt = "insert into " . $this->tableName . " (project_id,item_id,research_stuff_id,amount,duration,dunit_id,compensation) values (" . $project_id . "," . $item_id . "," . $research_stuff_id . "," . $amount . "," . $duration . "," . $dunit_id . "," . $compensation . ")";
            echo $stmt;
            $con->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "Update " . $this->tableName . " Set project_id=" . $project_id . ", item_id=" . $item_id . ",research_stuff_id=" . $research_stuff_id . ",amount=" . $amount . ",duration=" . $duration . ",dunit_id=" . $dunit_id . ",compensation=" . $compensation . " where seq_id=" . $seq_id;
            $con->ExecuteNonQuery($stmt);
            return mysql_affected_rows();
        }
    }

    public function Delete($seq_id)
    {
        $con = new MysqlConnect();
        $stmt = "delete from " . $this->tableName . " where seq_id=" . $seq_id;
        return $con->ExecuteNonQuery($stmt);
    }

    public function GetProjectBudget($project_id, $item_id)
    {
        $con = new MysqlConnect();
        $stmt = 'Select sum(amount) as `amount` from ' . $this->tableName . ' Where project_id=' . $project_id . ' and item_id=' . $item_id;
        return $con->ExecuteNonQuery($stmt);
    }

    public function SaveNewStuffDuration($seq_id, $amount, $duration)
    {
        $con = new MysqlConnect();

        $stmt = "Update " . $this->tableName . " Set amount=" . $amount . ",duration=" . $duration . " where seq_id=" . $seq_id;
        //echo $stmt;
        $con->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    /**
     * @param $research_stuff_id
     * @return int
     * Delete project_budget by research_stuff_id
     */
    public function DeleteByResearchStuffId($research_stuff_id)
    {
        $con = new MysqlConnect();
        $stmt = "DELETE FROM " . $this->tableName . " WHERE research_stuff_id =" . $research_stuff_id;
        $rs = $con->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

}



