<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$project_id = $_REQUEST['project_id'];

$conn = new MysqlConnect();

$stmt = "SELECT program_id FROM programs,researches WHERE programs.program_id = researches.program AND researches.seq_id =" . $project_id;
$result = $conn->ExecuteNonQuery($stmt);
$row = mysql_fetch_array($result);
$program_id = $row['program_id'];


$stmt = "SELECT `seq_id`, `goal_title` FROM `program_goals` WHERE program_id=" . $program_id;
//echo $stmt;
$result2 = $conn->ExecuteNonQuery($stmt);
$jsonArray = array();
while ($row = mysql_fetch_array($result2)) {
    $jsonArray[] = array('id' => $row['seq_id'], 'goal_title' => $row['goal_title']);
}
echo json_encode($jsonArray);
