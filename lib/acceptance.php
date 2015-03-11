<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'mysqlConnection.php';

class Acceptance {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function GetAcceptance($programId) {
        $stmt = "SELECT context from acceptance where program_id=" . $programId;
        $result = mysql_query($stmt);
        $context = 0;
        while ($row = mysql_fetch_array($result)) {
            $context = $row[0];
        }
        return $context;
    }

}
