<?php

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$conn = new MysqlConnect();
$stmt = "SELECT seq_id,cat_name FROM doc_categories";
$result = $conn->ExecuteNonQuery($stmt);
$jsonArray = array();
while ($row = mysql_fetch_array($result)) {
    $jsonArray[] = array('seq_id' => $row['seq_id'], 'cat_name' => $row['cat_name']);
}
echo json_encode($jsonArray);
