<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$conn = new MysqlConnect();
$stmt = "SELECT seq_id,title,title_en FROM project_types where isVisible = 1";
$result = $conn->ExecuteNonQuery($stmt);
$jsonArray = array();
while ($row = mysql_fetch_array($result)) {
    $jsonArray[] = array('seq_id' => $row['seq_id'], 'title' => $row['title_en']." / ". $row['title']);
}
echo json_encode($jsonArray);
