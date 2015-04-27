<?php

require_once '../../lib/mysqlConnection.php';
if (!isset($_GET['year']) || $_GET['year'] == 0) {
    echo 'Paramter Year is not set...';
    return;
}
if (!isset($_GET['center_id']) || $_GET['center_id'] == 0) {
    echo 'Paramter center_id is not set...';
    return;
}

$research_year = $_GET['year'];
$center_id = $_GET['center_id'];

$stmt = "select count(researches.seq_id) as `count` from researches where `Withdraw`=0 and center_id=$center_id and research_year=$research_year";
$conn = new MysqlConnect();
$rs = $conn->ExecuteNonQuery($stmt);

while ($row = mysql_fetch_array($rs)) {
    $ResultSet[] = array(
        'count' => $row['count']
    );
}
echo json_encode($ResultSet);
?>
