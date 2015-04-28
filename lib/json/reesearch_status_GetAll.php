<?php

require_once '../reseach_status.php';
$obj = new Research_Status();
$rs = $obj->GetAll();
while ($row = mysql_fetch_array($rs)) {
    $PairValue[] = array('status_id' => $row['status_id'], 'status_name' => $row['status_name'], 'phase_id' => $row['phase_id']);
}
echo json_encode($PairValue);
?>
