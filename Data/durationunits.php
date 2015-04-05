<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';


$conn = new MysqlConnect();


$stmt = "SELECT seq_id,unit_name FROM duration_units ORDER BY seq_id" ;
$result = $conn->ExecuteNonQuery($stmt);
$jsonArray = array();
while ($row = mysql_fetch_array($result)) {
    $jsonArray[] = array('seq_id' => $row['seq_id'], 'unit_name' => $row['unit_name']);
}
echo json_encode($jsonArray);
