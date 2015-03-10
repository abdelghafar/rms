<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';

$conn = new MysqlConnect();

if (isset($_GET['q'])) {
    $projectId = $_GET['q'];
    $stmt = 'select CHAR_LENGTH(abstract_ar_url) from researches where seq_id=' . $projectId;
    //echo $stmt;
    $result = $conn->ExecuteNonQuery($stmt);
    $r = 0;
    while ($row = mysql_fetch_array($result)) {
        $r = $row[0];
    }
    if ($r > 0) {
        $result = 1;
    } else {
        $result = 0;
    }

    echo json_encode($result);
} else {
    echo json_encode('Parameter Required...');
} 
