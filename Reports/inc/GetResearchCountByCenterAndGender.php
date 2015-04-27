<?php
require_once 'GetResearchCountByCenterAndGenderFn.php';
if (isset($_GET['year'])) {
    $year = $_GET['year'];
    $list = GetResearchCountByCenterAndGenderFn($year);
    echo json_encode($list);
}
else
    echo 'Plz Set Parameters...';
?>
