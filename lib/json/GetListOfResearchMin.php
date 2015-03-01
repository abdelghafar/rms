<?php

require_once '../Reseaches.php';
$obj = new Reseaches();
$result = $obj->GetListOfResearchMin();
while ($row = mysql_fetch_array($result)) {
    $Researches[] = array('seq_id' => $row['seq_id'], 'research_code' => $row['research_code'], 'title_ar' => $row['title_ar'], 'research_year' => $row['research_year'], 'center_name' => $row['center_name']);
}
echo json_encode($Researches);
?>
