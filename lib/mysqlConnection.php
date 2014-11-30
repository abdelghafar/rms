<?php

require_once 'config.php';

class MysqlConnect {

    public function __construct() {
        $con = mysql_connect(Db_host, Db_User, User_PWD);
        mysql_set_charset('utf8');
        mysql_select_db(Db_Name);
    }

    public function ExecuteNonQuery($stmt) {
        $rs = mysql_query($stmt);
        return $rs;
    }

}

?>
