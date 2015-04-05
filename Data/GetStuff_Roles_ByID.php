<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';
$person_id = $_REQUEST['person_id'];
$project_id = $_REQUEST['project_id'];

$conn = new MysqlConnect();
$stmt = "SELECT role_id FROM research_stuff WHERE research_id =" . $project_id . " AND person_id =" . $person_id;
//echo $stmt;
$result = $conn->ExecuteNonQuery($stmt);
if ($row = mysql_fetch_array($result))
    echo $row['role_id'];
else
    echo 0;
?>
