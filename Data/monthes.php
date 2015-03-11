<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';


$conn = new MysqlConnect();

if (isset($_REQUEST['project_id'])) {
    $stmt = "SELECT proposed_duration FROM researches where seq_id  =" . $_REQUEST['project_id'];
    $result = $conn->ExecuteNonQuery($stmt);

    $row = mysql_fetch_array($result);
    //echo $row[proposed_duration];
    $jsonArray = array();
    for ( $i = 1 ; $i < $row[proposed_duration]; $i++) {
        $jsonArray[] = array('month_id' => $i, 'month_name' => $i);
    }
    echo json_encode($jsonArray);
}