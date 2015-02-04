<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tracks
 *
 * @author ahmed
 */
require_once 'mysqlConnection.php';

class Tracks {

//put your code here
    public function __construct() {
        $connection = new MysqlConnect();
    }

    private $tableName = 'tracks';

    public function Save($track_id, $track_name, $tech_id) {
        $conn = new MysqlConnect();
        if ($track_id == null || $track_id == 0) {
            $stmt = "insert into " . $this->tableName . " (track_name,tech_id) values ('" . $track_name . "'," . $tech_id . ")";
            echo $stmt . '<br/>';
            $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "Update " . $this->tableName . " Set track_name='" . $track_name . "'" . " where track_id=" . $track_id;
            echo $stmt;
            $conn->ExecuteNonQuery($stmt);
            return mysql_affected_rows();
        }
    }

    public function GetAllTracks() {
        $conn = new MysqlConnect();
        $stmt = "SELECT track_id,track_name,tech_id FROM " . $this->tableName;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetAllTracksPerTechId($tech_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT track_id,track_name FROM " . $this->tableName . " where tech_id=" . $tech_id;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($track_id) {
        $conn = new MysqlConnect();
        $stmt = "Delete from " . $this->tableName . " where track_id =" . $track_id;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

    public function GetTrack($track_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT track_id,track_name,tech_id FROM " . $this->tableName . " where track_id=" . $track_id;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetPairValues() {
        $conn = new MysqlConnect();
        $stmt = "SELECT track_id,track_name FROM " . $this->tableName;
        $rs = $conn->ExecuteNonQuery($stmt);
        $result = Array("PairValues" => Array());
        while ($row = mysql_fetch_array($rs)) {
            array_push($result['PairValues'], Array($row['track_id'], $row['track_name']));
        }
        return $result;
    }

}

//$obj = new Tracks();
//echo $obj->Save(1, 't222', 1);
