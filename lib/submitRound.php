<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubmitRound
 *
 * @author abdelghafar
 */
require_once 'mysqlConnection.php';

class SubmitRound
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function GetCurrentRound()
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM submit_round WHERE isCurrent=1";

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;

    }

}
