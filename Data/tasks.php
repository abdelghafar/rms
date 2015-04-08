<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';


$conn = new MysqlConnect();

if (isset($_REQUEST['phase_id'])) {
    $stmt = "SELECT task_id,task_name FROM project_tasks where phase_id =" . $_REQUEST['phase_id'];
    $result = $conn->ExecuteNonQuery($stmt);
    $jsonArray = array();
    while ($row = mysql_fetch_array($result)) {
        $jsonArray[] = array('task_id' => $row['task_id'], 'task_name' => $row['task_name']);
    }
    echo json_encode($jsonArray);
}