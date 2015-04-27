<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';
$research_stuff_id = $_REQUEST['research_stuff_id'];

$conn = new MysqlConnect();
$stmt = "SELECT role_id FROM research_stuff WHERE seq_no =" . $research_stuff_id;
//echo $stmt;
$result = $conn->ExecuteNonQuery($stmt);
if ($row = mysql_fetch_array($result))
    echo $row['role_id'];
else
    echo 0;
?>
