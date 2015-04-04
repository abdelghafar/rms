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

class ProgramGoals
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function GetProgramGoals($program_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT * From program_goals
                 WHERE program_id =" . $program_id .
            " ORDER BY seq_id";

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }


    public function GetprojectProgram($project_id)
    {
        $conn = new MysqlConnect();
        $stmt = "select program FROM researches WHERE seq_id =" . $project_id . " LIMIT 1";
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($rs);
        return $row[program];
    }

}
