<?php

require_once 'mysqlConnection.php';

class Research_Status
{

    public function __construct()
    {
        $connection = new MysqlConnect();;
    }

    public function GetStatusId($Status)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT  `Status_Id` FROM  `reseach_status` WHERE  `Status_name` ='" . $Status . "'";
        $rs = $rs = $conn->ExecuteNonQuery($stmt);
        $Status_Id = 0;
        while ($row = mysql_fetch_array($rs)) {
            $Status_Id = $row[0];
        }
        return $Status_Id;
    }

    public function GetAll()
    {
        $stmt = "SELECT status_id , status_name,phase_id from reseach_status";
        $conn = new MysqlConnect();
        return $conn->ExecuteNonQuery($stmt);
    }

    public function GetPhaseStatus($Phase_id)
    {
        $stmt = "SELECT status_id , status_name from reseach_status Where phase_id=" . $Phase_id;
        $conn = new MysqlConnect();
        return $conn->ExecuteNonQuery($stmt);
    }

}

?>
