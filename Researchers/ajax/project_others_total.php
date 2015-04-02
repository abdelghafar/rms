<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';
require_once '../../lib/project_budget_others.php';

$con = new MysqlConnect();
if (isset($_GET['q'])) {
    $obj = new project_budget_others();
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $stmt = 'SELECT SUM( project_budget.amount) FROM project_budget JOIN budget_items ON project_budget.item_id = budget_items.item_id WHERE budget_items.parent_item_id =' . $obj->others_code() . ' AND project_budget.project_id =' . $project_id;
    $rs = $con->ExecuteNonQuery($stmt);
    $r = 0;
    while ($row = mysql_fetch_array($rs)) {
        $r = $row[0];
    }
    echo number_format($r, 2);
}