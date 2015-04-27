<?php

require_once '../../lib/mysqlConnection.php';
if (!isset($_GET['year']) || $_GET['year'] == 0) {
    echo 'No paramters are set...';
    return;
}
if (!isset($_GET['center_id']) || $_GET['center_id'] == 0) {
    echo 'No paramters are set...';
    return;
}

$research_year = $_GET['year'];
$center_id = $_GET['center_id'];

$stmt = "select ifnull(sum(budget),0) as `Sum` from researches join reseacher_centers on researches.center_id = reseacher_centers.id where `Withdraw`=0 and research_year=$research_year and center_id=$center_id";
$conn = new MysqlConnect();
$rs = $conn->ExecuteNonQuery($stmt);
while ($row = mysql_fetch_array($rs)) {
    $ResultSet[] = array(
        'Sum' => $row['Sum']
    );
}
echo json_encode($ResultSet);
?>


