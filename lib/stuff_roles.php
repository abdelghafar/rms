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
}

echo stuff_roles_system::$PI; 