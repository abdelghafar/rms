<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$conn = new MysqlConnect();
if (isset($_GET['tech_id'])) {
    $stmt = "SELECT track_id,track_name from tracks where tech_id=" . $_GET['tech_id'];
    $result = $conn->ExecuteNonQuery($stmt);
    $jsonArray = array();
    while ($row = mysql_fetch_array($result)) {
        $jsonArray[] = array('track_id' => $row['track_id'], 'track_name' => $row['track_name']);
    }
    echo json_encode($jsonArray);
}

