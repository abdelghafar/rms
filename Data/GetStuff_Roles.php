<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$con = new MysqlConnect();
$stmt = "SELECT`seq_id`, `role_name` ,`role_name_en`  FROM `stuff_roles` WHERE seq_id > 2";
$result = $con->ExecuteNonQuery($stmt);
while ($row = mysql_fetch_array($result)) {
    $rs[] = array('seq_id' => $row['seq_id'], 'role_name' => $row['role_name_en'] . " / " . $row['role_name']);
}
echo json_encode($rs);
