<?php

require_once '../../lib/mysqlConnection.php';
require_once 'ResearchCountByGender.php';
require_once 'GetResearchCountByCenterIdAndYearFn.php';

if (isset($_GET['year'])) {
    $year = $_GET['year'];

    $male_total_count = ResearchCountByGender($year, 0);
    $female_total_count = ResearchCountByGender($year, 1);
    $total_count = $male_total_count + $female_total_count;

    $list[] = array('text' => 'الذكور', 'val' => $male_total_count / $total_count * 100);
    $list[] = array('text' => 'الاناث', 'val' => $female_total_count / $total_count * 100);


    echo json_encode($list);
} else {
    echo 'Plz Set Paramaters...';
}
?>