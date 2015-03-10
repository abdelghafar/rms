<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';

$con = new MysqlConnect();

if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $stmt = "SELECT sum(amount) as project_budget FROM project_budget WHERE project_id=" . $project_id;
    $rs = $con->ExecuteNonQuery($stmt);
    $r = 0;
    while ($row = mysql_fetch_array($rs)) {
        $r = $row[0];
    }
    echo number_format($r, 2);
}