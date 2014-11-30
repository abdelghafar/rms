
<?php

require_once '../doc_categories.php';

$stmt = "SELECT seq_id , cat_name From doc_categories";
$conn = new MysqlConnect();
$result = $conn->ExecuteNonQuery($stmt);
while ($row = mysql_fetch_array($result)) {
    $PairValue[] = array('id' => $row['seq_id'], 'cat_name' => $row['cat_name']);
}
echo json_encode($PairValue);
?>
