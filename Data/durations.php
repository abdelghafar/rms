<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$conn = new MysqlConnect();
$stmt = "SELECT seq_id,duration_title,duration_title_en,duration_month FROM duration";
$result = $conn->ExecuteNonQuery($stmt);
$jsonArray = array();
while ($row = mysql_fetch_array($result)) {
    $jsonArray[] = array(
        'seq_id' => $row['seq_id'], 
        'duration_title' => $row['duration_title_en']. " / " . $row['duration_title'], 
        'duration_month' => $row['duration_month']);
}
echo json_encode($jsonArray);
