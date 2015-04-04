<?php

require_once 'mysqlConnection.php';

class Review_Phases
{

    public function __construct()
    {
        $connection = new MysqlConnect();;
    }

    public function GetAll()
    {
        $stmt = "SELECT `Phase_id`, `Phase_Title` FROM `review_phase`";
        $con = new MysqlConnect();
        $res = $con->ExecuteNonQuery($stmt);
        return $res;
    }

}

?>
