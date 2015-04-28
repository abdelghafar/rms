<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 12/04/15
 * Time: 10:43 ص
 */
$current_date = date('Y-m-d');
//echo $current_date ." <br> ";
require_once '../../lib/submitRound.php';

$current_round = new SubmitRound();
$current_round_rs = $current_round->GetCurrentRound();
while ($row=  mysql_fetch_array($current_round_rs))
{
    //echo $row['start_date'] . "    " . $row['end_date'];
    if($current_date>= $row['start_date'] && $current_date<= $row['end_date'])
        echo 1;
    else 
        echo 0;
}
//if (isset($_GET['q'])) {
//    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
//    $obj = new Reseaches();
//    echo $obj->IsDraftCompleted($project_id);
//}