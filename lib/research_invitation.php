<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'mysqlConnection.php';
require_once './config.php';

class research_invitation {

    private $table_name = 'research_invitation';

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function IsInvited($projectId, $person_id) {
        $conn = new MysqlConnect();
        $stmt = "select seq_id from " . $this->table_name . " where research_id=" . $projectId . " and person_id=" . $person_id;
        $result = $conn->ExecuteNonQuery($stmt);
        $seq_id = 0;
        while ($row = mysql_fetch_array($result)) {
            $seq_id = $row[0];
        }
        return $seq_id;
    }

    public function SendInvitation($projectId, $person_id) {
        $conn = new MysqlConnect();
        $stmt = "Insert into " . $this->table_name . " (research_id,person_id,submit_stamp) Values (" . $projectId . "," . $person_id . ",'" . date(DateTime_Format) . "')";
        $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function AcceptInvitation($project_id, $person_id) {
        $conn = new MysqlConnect();
        $stmt = "update " . $this->table_name . " set accept=1, reply_stamp='" . date(DateTime_Format) . "' where research_id=" . $project_id . " and person_id=" . $person_id;
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function RejectInvitation($project_id, $person_id) {
        $conn = new MysqlConnect();
        $stmt = "update " . $this->table_name . " set accept=0, reply_stamp='" . date(DateTime_Format) . "' where research_id=" . $project_id . " and person_id=" . $person_id;
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

}
