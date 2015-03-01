<?php

require_once '../reseach_status.php';
$obj = new Research_Status();
$Phase_id = $_GET['Phase_id'];
$result = $obj->GetPhaseStatus($Phase_id);
while ($row = mysql_fetch_array($result)) {
    $Researches[] = array('status_id' => $row['status_id'], 'status_name' => trim($row['status_name']));
}
echo json_encode($Researches);
?>
