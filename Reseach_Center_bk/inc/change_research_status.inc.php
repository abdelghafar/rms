<?php

session_start();
require_once '../../lib/CenterResearch.php';
require_once '../../lib/Reseaches.php';
$research_status = 0;
$track_date = "";
$notes = "";


$isValid = TRUE;

if (!isset($_POST['research_code']) || empty($_POST['research_code'])) {
    echo 'هناك خطأ فى إختيار المشروع البحثى من فضلك أعد إختياره من جديد' . '<br/>';
    $isValid = FALSE;
}
else
    $research_code = $_POST['research_code'];
$research = new Reseaches();
$research_id = $research->GetResearchId($research_code);


if (!isset($_POST['research_status']) || empty($_POST['jqxPhaseStatus'])) {
    echo 'من فضلك إختار حالة المشروع البحثى' . '<br/>';
    $isValid = FALSE;
}
else
    $research_status = $_POST['jqxPhaseStatus'];

if (!isset($_POST['track_date'])) {
    echo 'من فضلك أ أختار تاريخ تغيير حالة المشروع البحثى' . '<br/>';
    $isValid = FALSE;
} else {
    $track_date = date_parse($_POST['track_date']);
    $track_date = $track_date['year'] . '-' . $track_date['month'] . '-' . $track_date['day'];
}

$notes = mysql_escape_string($_POST['notes']);



if ($isValid == TRUE) {

    $CenterResearch = new CenterResearch();

    try {
        $status_exist = $CenterResearch->IsExist($research_id, $research_status, $track_date);

        if ($status_exist == 1) {
            echo "لقد سبق إدخال هذه البيانات من قبل";
        } else {
            $r1 = $CenterResearch->Save_Research_Track(0, $research_id, $research_status, $track_date, $notes);
            $r2 = $CenterResearch->update_research_status($research_id, $research_status, $track_date);
            if ($r1 == 1 AND $r2 == 1)
                echo "تم حفظ البيانات بنجاح";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo 'من فضلك أكمل باقي البيانات';
}
?>