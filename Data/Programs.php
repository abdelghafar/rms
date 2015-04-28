<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$conn = new MysqlConnect();
$stmt = "SELECT `program_id`, `program_name` FROM `programs`";
$result = $conn->ExecuteNonQuery($stmt);
$jsonArray = array();
while ($row = mysql_fetch_array($result)) {
    $jsonArray[] = array('id' => $row['program_id'], 'program_name' => $row['program_name']);
}
echo json_encode($jsonArray);
