﻿<?php
require_once 'mysqlConnection.php';

class Reseaches_track {

    public function __construct() {
        $connection = new MysqlConnect();
        ;
    }

    public function Save($reseacher_id, $Status_Id, $track_date, $notes) {
        $conn = new MysqlConnect();
        $stmt = "";
        $stmt = "Insert into reseach_track (research_id,Status_Id,track_date,notes) Values(" . $reseacher_id . "," . $Status_Id . ",'" . $track_date . "','" . $notes . "')";
        echo $stmt;
        return $conn->ExecuteNonQuery($stmt);
    }

}
?>
