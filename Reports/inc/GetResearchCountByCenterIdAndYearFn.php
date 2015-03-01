<?php
require_once '../../lib/mysqlConnection.php';
//include_once($_SERVER['DOCUMENT_ROOT'] . "/rms/lib/mysqlConnection.php");

function GetResearchCountByCenterIdAndYearFn($year, $center_id) {
    $stmt = "select count(researches.seq_id) as `count` from researches  where  `Withdraw`=0 and center_id=$center_id and research_year=$year";
    $conn = new MysqlConnect();
    $rs = $conn->ExecuteNonQuery($stmt);
    while ($row = mysql_fetch_array($rs)) {
        $ResultSet = $row['count'];
    }
    return $ResultSet;
}

?>