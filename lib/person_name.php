<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of projectPlan
 *
 * @author ahmed
 */
require_once 'mysqlConnection.php';

class PersonName
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function GetPersonName($personId)
    {
        $stmt = "SELECT name_ar FROM persons Where Person_id=" . $personId;
        $result = mysql_query($stmt);
        while ($row = mysql_fetch_array($result)) {
            $name_ar = $row['name_ar'];
        }
        return $name_ar;
    }
}
