<?php

require_once '../uqu_workplaces.php';
$obj = new Uqu_WorkPlaces();
$result = $obj->GetUquWorkPlaces();
while ($row = mysql_fetch_array($result)) {
    $Researches[] = array('name' => $row['name']);
}
echo json_encode($Researches);
