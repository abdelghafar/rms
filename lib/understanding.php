<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'mysqlConnection.php';

class Understanding
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function GetUnderstanding($programId)
    {
        $stmt = "SELECT context from understanding where program_id=" . $programId;
        $result = mysql_query($stmt);
        $context = 0;
        while ($row = mysql_fetch_array($result)) {
            $context = $row[0];
        }
        return $context;
    }

}