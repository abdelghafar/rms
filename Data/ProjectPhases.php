<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';
if (isset($_GET['pid'])) {
    $conn = new MysqlConnect();
    $stmt = "SELECT seq_id,phase_title FROM project_plan where project_id= " . $_GET['pid'];
    $result = $conn->ExecuteNonQuery($stmt);
    $jsonArray = array();
    while ($row = mysql_fetch_array($result)) {
        $jsonArray[] = array('seq_id' => $row['seq_id'], 'phase_title' => $row['phase_title']);
    }
    echo json_encode($jsonArray);
} else {
    echo 'project id required..';
} 