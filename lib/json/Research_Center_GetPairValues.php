<?php

require_once '../CenterResearch.php';
$stmt = "Select id ,center_name From reseacher_centers";
$conn = new MysqlConnect();
$result = $conn->ExecuteNonQuery($stmt);
while ($row = mysql_fetch_array($result)) {
    $PairValue[] = array('id' => $row['id'], 'center_name' => $row['center_name']);
}
echo json_encode($PairValue);
?>
