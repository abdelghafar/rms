<?php
require_once 'mysqlConnection.php';

class Reseaches_track {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($reseacher_id, $Status_Id, $track_date, $notes) {
        $conn = new MysqlConnect();
        $stmt = "Insert into reseach_track (research_id,Status_Id,track_date,notes) Values(" . $reseacher_id . "," . $Status_Id . ",'" . $track_date . "','" . $notes . "')";
        return $conn->ExecuteNonQuery($stmt);
    }

}
?>
