<?php

require_once '../reseach_status.php';
$obj = new Research_Status();
$rs = $obj->GetPhaseStatus(1);
while ($row = mysql_fetch_array($rs)) {
    $PairValue[] = array('status_id' => $row['status_id'], 'status_name' => $row['status_name']);
}
echo json_encode($PairValue);
?>
