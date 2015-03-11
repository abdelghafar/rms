<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';
require_once '../lib/project_budget_travel.php';

$con = new MysqlConnect();
$t = new project_budget_travel();

$stmt = "SELECT `item_id`,`item_title` FROM `budget_items` WHERE `parent_item_id`=" . $t->travel_code();
$result = $con->ExecuteNonQuery($stmt);
while ($row = mysql_fetch_array($result)) {
    $rs[] = array('item_id' => $row['item_id'], 'item_title' => $row['item_title']);
}
echo json_encode($rs);
