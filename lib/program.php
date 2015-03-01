<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'mysqlConnection.php';

class program {

    public function __construct() {
        
    }

    public function GetProgramId($program_code) {
        $con = new MysqlConnect();
        $stmt = "select program_id from programs where program_code='" . $program_code . "'";
        $rs = $con->ExecuteNonQuery($stmt);
        $program_id = 0;
        while ($row = mysql_fetch_array($rs)) {
            $program_id = $row[0];
        }
        return $program_id;
    }

}
