<?php

require_once '../Review_Phases.php';
$obj = new Review_Phases();
$result = $obj->GetAll();
while ($row = mysql_fetch_array($result)) {
    $Researches[] = array('Phase_id' => $row['Phase_id'], 'Phase_Title' => $row['Phase_Title']);
}
echo json_encode($Researches);
?>
