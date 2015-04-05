<?php

require_once 'mysqlConnection.php';

class Settings {

    private $table_name = 'settings';

    public function __construct() {
        
    }

    public function GetCurrYear() {
        $con = new MysqlConnect();
        $stmt = "SELECT settings.setting_value from " . $this->table_name . " where settings.setting_title= 'year' limit 0,1";
        $result = $con->ExecuteNonQuery($stmt);
        $year = 0;
        while ($row = mysql_fetch_array($result)) {
            $year = $row[0];
        }
        return $year;
    }

    public function GetCurrRound() {
        $con = new MysqlConnect();
        $stmt = "SELECT settings.setting_value from " . $this->table_name . " where settings.setting_title= 'round_date' limit 0,1";
        $result = $con->ExecuteNonQuery($stmt);
        $round = 0;
        while ($row = mysql_fetch_array($result)) {
            $round = $row[0];
        }
        return $round;
    }

}
