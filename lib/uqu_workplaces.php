
<?php

require_once 'mysqlConnection.php';

class Uqu_WorkPlaces {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function GetUquWorkPlaces() {
        $stmt = "Select id,name  from uqu_workplaces";

        $result = mysql_query($stmt);

        return $result;
    }

}
?>
