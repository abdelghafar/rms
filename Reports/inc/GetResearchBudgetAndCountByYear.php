<?php

require_once '../../lib/mysqlConnection.php';
require_once 'GetResearchBudgetByCenterIdAndYearFn.php';
require_once 'GetResearchCountByCenterIdAndYearFn.php';

if (isset($_GET['year'])) {
    $year = $_GET['year'];
    $totalBudget = 0;
    $conn = new MysqlConnect();
    $stmt = "Select id ,center_name From reseacher_centers";
    $centerLst = $conn->ExecuteNonQuery($stmt);

    $stmt = "SELECT count(seq_id) as `count` FROM researches where withDraw=0 and `research_year`=$year";
    $result = mysql_query($stmt);
    $totalReseach = 0;
    while ($row = mysql_fetch_array($result)) {
        $totalReseach = $row[0];
    }

    while ($row = mysql_fetch_array($centerLst, MYSQL_ASSOC)) {
        $center_id = $row['id'];
        $budget = GetResearchBudgetByCenterIdAndYearFn($year, $center_id);
        $totalBudget+=$budget;
        $count = GetResearchCountByCenterIdAndYearFn($year, $center_id);
        $list[] = array(
            'center_name' => $row['center_name'],
            'budget' => $budget,
            'count' => $count,
            'percnt' => ($count / $totalReseach) * 100,
            'total_budget' => $totalBudget,
            'total_count' => $totalReseach
        );
    }
    echo json_encode($list);
} else {
    echo 'No Parameters...';
}
?>
