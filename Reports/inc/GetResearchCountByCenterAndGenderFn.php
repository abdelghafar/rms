<?php

require_once '../../lib/mysqlConnection.php';
require_once 'GetResearchByCenterIdAndGenderAndYearFn.php';
require_once 'GetResearchCountByCenterIdAndYearFn.php';

function GetResearchCountByCenterAndGenderFn($year) {
    $conn = new MysqlConnect();
    $stmt = "Select id ,center_name From reseacher_centers";
    $centerLst = $conn->ExecuteNonQuery($stmt);
    $male_total_count = 0;
    $female_total_count = 0;
    while ($row = mysql_fetch_array($centerLst, MYSQL_ASSOC)) {
        $center_id = $row['id'];
        $male_rcount = GetResearchByCenterIdAndGenderAndYearFn($year, 0, $center_id);
        $male_total_count+=$male_rcount;
        $female_rcount = GetResearchByCenterIdAndGenderAndYearFn($year, 1, $center_id);
        $female_total_count+=$female_rcount;
        $list[] = array(
            'center_id' => $row['id'],
            'center_name' => $row['center_name'],
            'male_rcount' => $male_rcount,
            'female_rcount' => $female_rcount,
            'male_total_count' => $male_total_count,
            'female_total_count' => $female_total_count,
            'total' => GetResearchCountByCenterIdAndYearFn($year, $center_id)
        );
    }
    return $list;
}
?>



