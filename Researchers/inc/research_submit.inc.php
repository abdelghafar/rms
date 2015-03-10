<?
session_start();
require_once '../../lib/Reseaches.php';
require_once '../../lib/CenterResearch.php';
require_once '../../lib/Settings.php';
require_once '../../lib/reseach_track.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/Smarty/libs/Smarty.class.php';
require_once '../../lib/users.php';

$seqId = 0;
$title_ar = "";
$title_en = "";
$proposed_duration = 0;
$research_code = "";
$Approve_session_no = 0;
$Approve_date = '';
$research_year = 0;
$program = $_SESSION['program'];
$user = new Users();
$UserId = $_SESSION['User_Id'];
$person_id = $user->GetPerosnId($UserId, 'Researcher');
$isValid = TRUE;

if (!isset($_POST['title_ar']) || empty($_POST['title_ar'])) {
    echo 'من فضلك ادخل العنوان باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else {
    $title_ar = mysql_escape_string(trim($_POST['title_ar']));
}

if (!isset($_POST['title_en']) || empty($_POST['title_en'])) {
    echo 'من فضلك ادخل العنوان باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else {
    $title_en = mysql_escape_string(trim($_POST['title_en']));
}

if (!isset($_POST['proposed_duration']) || empty($_POST['proposed_duration'])) {
    echo 'من فضلك ادخل فترة المشروع المقترحة' . '<br/>';
    $isValid = FALSE;
} else {
    $proposed_duration = $_POST['proposed_duration'];
}

if (!isset($_POST['technologiesVal']) || empty($_POST['technologiesVal'])) {
    echo 'من فضلك ادخل اولوية البحث' . '<br/>';
    $isValid = FALSE;
} else {
    $technologiesId = mysql_escape_string(trim($_POST['technologiesVal']));
}

if (!isset($_POST['trackVal']) || empty($_POST['trackVal'])) {
    echo 'من فضلك ادخل التخصص  العام' . '<br/>';
    $isValid = FALSE;
} else {
    $trackId = mysql_escape_string(trim($_POST['trackVal']));
}

if (!isset($_POST['subtrackVal']) || empty($_POST['subtrackVal'])) {
    echo 'من فضلك ادخل التخصص  الدقيق' . '<br/>';
    $isValid = FALSE;
} else {
    $subtrackId = mysql_escape_string(trim($_POST['subtrackVal']));
}

if ($isValid == FALSE) {
    echo '<label>' . 'برجاء التأكد من صحة البيانات' . '<label/>';
}

//ToDo:Update Query
if (isset($_GET['q'])) {
    $projectId = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $r = new Reseaches();
    $upload_dir = '../../uploads/' . $projectId . '/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir);
    }
    $isExist = $r->IsExist($title_ar);
    if ($isExist > 0 && $isExist != $projectId) {
        echo 'لقد تم تسجبل هذا البحث من قبل' . '<br/>';
        $isValid = FALSE;
    }
    if ($isValid == TRUE) {
        $updateResult = $r->UpdateIntro($projectId, $title_ar, $title_en, $proposed_duration, $technologiesId, $trackId, $subtrackId);
        if ($updateResult == 1) {
            echo '<script>' . 'window.location.assign("uploadIntro.php?q=' . $projectId . '")' . '</script>';
        } else {
            echo 'Error in update data ...';
        }
    } else {
        echo 'لقد  فشلت عمليه ادخال البيانات' . '<br/>';
    }
}
//ToDo:insert stmt
else {
    $setting = new Settings();
    $research_year = $setting->GetCurrYear();
    $Status_Id = 1;
    $Status_Date = date('Y-m-d');
    $res = new Reseaches();
    $isExist = $res->IsExist($title_ar);
    if ($isExist > 0) {
        echo 'لقد تم تسجبل هذا البحث من قبل' . '<br/>';
        $isValid = FALSE;
    }
    $research_code = '';
    if ($isValid == TRUE) {
        $researcher = new Reseaches();
        $research_id = $researcher->Save(0, $title_ar, $title_en, $proposed_duration, $trackId, $subtrackId, $research_code, $Approve_session_no, $Approve_date, '', '', '', '', '', $Status_Id, $Status_Date, $technologiesId, $research_year, $program, '', '');
        $x = $research_id;
        //create dir 

        $upload_dir = '../../uploads/' . $research_id . '/';
        if (!mkdir($upload_dir)) {
            die('Can not create project Dir');
        }
        $track = new Reseaches_track();
        if ($research_id != 0) {
            $y = $track->Save($research_id, $Status_Id, $Status_Date, $notes);
            $research_author = new research_stuff();
            $research_author->Save($research_id, $person_id, 1);
            if ($x >= 0 && $y == 1) {
                echo '<script>' . 'window.location.assign("uploadIntro.php?q=' . $research_id . '")' . '</script>';
            } else {
                echo '<p>لقد  فشلت عمليه ادخال البيانات</p>' . '<br/>';
                echo 'x= ' . $x . '<br/>';
                echo 'y= ' . $y . '<br/>';
            }
        }
    }
}
?>
<link href="../common/css/MessageBox.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />