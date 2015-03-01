<?php

require_once '../../lib/mysqlConnection.php';

function GetResearchBudgetByCenterIdAndYearFn($year, $center_id) {
    $stmt = "select ifnull(sum(budget),0) as `Sum` from researches join reseacher_centers on researches.center_id = reseacher_centers.id where `Withdraw`=0 and research_year=$year and center_id=$center_id";
    $conn = new MysqlConnect();
    $rs = $conn->ExecuteNonQuery($stmt);
    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $Sum = $row['Sum'];
    }
    return $Sum;
}

?>
