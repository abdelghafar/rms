<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 07/04/15
 * Time: 03:08 م
 */

require_once 'mysqlConnection.php';

class stuff_roles_system
{
    static $PI = 1;
    static $Co_Is = 2;
    static $Consultant = 3;
}

class stuff_roles
{
    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save()
    {

    }

    public function GetMaxValue($parent_role_id)
    {
        $con = new MysqlConnect();
        $stmt = "select IFNULL(MAX(value),0) AS value from stuff_roles where parent_role_id=" . $parent_role_id;
        $rs = $con->ExecuteNonQuery($stmt);
        $value = 0;
        while ($row = mysql_fetch_array($rs)) {
            $value = $row[0];
        }
        return $value;
    }
}

$r = new stuff_roles();
echo $r->GetMaxValue(5);
