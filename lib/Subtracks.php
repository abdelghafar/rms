<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Subtracks
 *
 * @author ahmed
 */
require_once 'mysqlConnection.php';

class Subtracks {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    private $tableName = 'subtracks';

    public function Save($seq_id, $subtrack_name, $track_id) {
        $conn = new MysqlConnect();
        if ($seq_id == null || $seq_id == 0) {
            $stmt = "insert into " . $this->tableName . " (subTrack_name,track_id) values ('" . $subtrack_name . "'," . $track_id . ")";

            $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "Update " . $this->tableName . " Set subTrack_name='" . $subtrack_name . "'" . " where seq_id=" . $seq_id;
            echo $stmt;
            $conn->ExecuteNonQuery($stmt);
            return mysql_affected_rows();
        }
    }

    public function GetSubtracksBytrackId($track_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,subTrack_name FROM " . $this->tableName . " Where track_id=" . $track_id;

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seq_id) {
        $conn = new MysqlConnect();
        $stmt = "Delete from " . $this->tableName . " where seq_id =" . $seq_id;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

    public function GetSubtrack($seq_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,subTrack_name,track_id FROM " . $this->tableName . " where seq_id=" . $seq_id;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

}
