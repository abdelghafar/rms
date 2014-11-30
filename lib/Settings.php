<?php

require_once 'mysqlConnection.php';

class Settings {

    public function __construct() {
        $connection = new MysqlConnect();
        ;
    }

    public function GetCurrYear() {
        $stmt = "SELECT Curr_year FROM settings";
        $result = mysql_query($stmt);
        $year = 0;
        while ($row = mysql_fetch_array($result)) {
            $year = $row[0];
        }
        return $year;
    }

}

?>
