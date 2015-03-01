<?
session_start();
require_once '../../lib/Reseaches.php';
require_once '../../lib/CenterResearch.php';
require_once '../../lib/Settings.php';
require_once '../../lib/reseach_track.php';
require_once '../../lib/research_Authors.php';
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
} else
    $title_ar = mysql_escape_string(trim($_POST['title_ar']));

if (!isset($_POST['title_en']) || empty($_POST['title_en'])) {
    echo 'من فضلك ادخل العنوان باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $title_en = mysql_escape_string(trim($_POST['title_en']));

$research = new Reseaches();
$isExist = $research->IsExist($title_en);
if ($isExist > 0) {
    echo 'لقد تم تسجبل هذا البحث من قبل' . '<br/>';
    $isValid = FALSE;
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

if (!isset($_FILES['abstract_ar_file']['name']) || empty($_FILES['abstract_ar_file']['name'])) {
    echo 'من فضلك قم بتحميل الملخص باللغة العربية ' . '<br/>';
    $isValid = FALSE;
}
if ($_FILES['abstract_ar_file']['size'] > 1 * 1024 * 1024) {
    echo 'حجم الملف يجب أن لا يزيد عن  1  ميجابايت' . '<br/>';
    $isValid = FALSE;
}

if (!isset($_FILES['abstract_en_file']['name']) || empty($_FILES['abstract_en_file']['name'])) {
    echo 'من فضلك قم بتحميل الملخص باللغة الإنجليزية ' . '<br/>';
    $isValid = FALSE;
}
if ($_FILES['abstract_en_file']['size'] > 1 * 1024 * 1024) {
    echo 'حجم الملف يجب أن لا يزيد عن 1 ميجابايت' . '<br/>';
    $isValid = FALSE;
}

if (!isset($_FILES['introduction_file']['name']) || empty($_FILES['introduction_file']['name'])) {
    echo 'من فضلك قم بتحميل المقدمة' . '<br/>';
    $isValid = FALSE;
}
if ($_FILES['introduction_file']['size'] > 2 * 1024 * 1024) {
    echo 'حجم الملف يجب أن لا يزيد عن 2 ميجابايت' . '<br/>';
    $isValid = FALSE;
}

if (!isset($_FILES['literature_review_file']['name']) || empty($_FILES['literature_review_file']['name'])) {
    echo 'من فضلك قم بتحميل المسح الأدبي ' . '<br/>';
    $isValid = FALSE;
}
if ($_FILES['literature_review_file']['size'] > 4 * 1024 * 1024) {
    echo 'حجم الملف يجب أن لا يزيد عن 4 ميجابايت' . '<br/>';
    $isValid = FALSE;
}

if (!isset($_FILES['file']['name']) || empty($_FILES['file']['name'])) {
    echo 'من فضلك قم بتحميل نموذج -2' . '<br/>';
    $isValid = FALSE;
}
if ($_FILES['file']['size'] > 8 * 1024 * 1024) {
    echo 'حجم الملف يجب أن لا يزيد عن 8 ميجابايت' . '<br/>';
    $isValid = FALSE;
}

$setting = new Settings();
$research_year = $setting->GetCurrYear();

$budget = $_POST['budgetValue'];
$Status_Id = 1;
$Status_Date = date('Y-m-d');

echo $_FILES["abstract_ar_url"]["name"];

$fileExtension = end(explode(".", $_FILES["abstract_ar_file"]["name"]));
$abstract_ar_fileName = $UserId . "_" . md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;

$fileExtension = end(explode(".", $_FILES["abstract_en_file"]["name"]));
$abstract_en_fileName = $UserId . "_" . md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;

$fileExtension = end(explode(".", $_FILES["introduction_file"]["name"]));
$introduction_fileName = $UserId . "_" . md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;

$fileExtension = end(explode(".", $_FILES["literature_review_file"]["name"]));
$literature_review_fileName = $UserId . "_" . md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;

$fileExtension = end(explode(".", $_FILES["file"]["name"]));
$fileName = $UserId . "_" . md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;

$proposal_fileName = $UserId . '_' . md5(date('Y-m-d H:i:s')) . '.pdf';


if ($isValid == FALSE) {
    echo '<label>' . 'برجاء التأكد من صحة البيانات' . '<label/>';
}

$res = new Reseaches();
//$research_code = $res->GenerateResearchCode($research_center);
$research_code = 000000;
if ($isValid == TRUE) {
    $researcher = new Reseaches();

    $research_id = $researcher->Save(0, $title_ar, $title_en, $proposed_duration, $trackId, $subtrackId, $research_code, $Approve_session_no, $Approve_date, "uploads/abstracts_ar/" . $abstract_ar_fileName, "uploads/abstracts_en/" . $abstract_en_fileName, "uploads/introductions/" . $introduction_fileName, "uploads/literature_reviews/" . $literature_review_fileName, "uploads/Researchers/" . $fileName, $Status_Id, $Status_Date, $technologiesId, $research_year, $budget, $program, "uploads/generated_proposals/" . $proposal_fileName, "uploads/complete_proposals/" . $proposal_fileName);
    $x = $research_id;

    $track = new Reseaches_track();
    $y = $track->Save($research_id, $Status_Id, $Status_Date, $notes);
//    echo 'y is:' . $y;
    $research_author = new research_Authors();
    $research_author->Save($research_id, $person_id, 1);

//    $researchCenter = new CenterResearch();
//    $researchCenterName = $researchCenter->GetRCenterNameById($research_center);

    if (file_exists("../../uploads/abstracts_ar/" . $abstract_ar_fileName)) {
        echo $_FILES["abstract_ar_file"]["name"] . " already exists. ";
    } else {
        $rs1 = move_uploaded_file($_FILES["abstract_ar_file"]["tmp_name"], "../../uploads/abstracts_ar/" . $abstract_ar_fileName);
        //echo 'move_uploaded_file=' . $rs;
    }

    if (file_exists("../../uploads/abstracts_en/" . $abstract_en_fileName)) {
        echo $_FILES["abstract_en_file"]["name"] . " already exists. ";
    } else {
        $rs2 = move_uploaded_file($_FILES["abstract_en_file"]["tmp_name"], "../../uploads/abstracts_en/" . $abstract_en_fileName);
        //echo 'move_uploaded_file=' . $rs;
    }

    if (file_exists("../../uploads/introductions/" . $introduction_fileName)) {
        echo $_FILES["introduction_file"]["name"] . " already exists. ";
    } else {
        $rs3 = move_uploaded_file($_FILES["introduction_file"]["tmp_name"], "../../uploads/introductions/" . $introduction_fileName);
        //echo 'move_uploaded_file=' . $rs;
    }

    if (file_exists("../../uploads/literature_reviews/" . $literature_review_fileName)) {
        echo $_FILES["literature_review_file"]["name"] . " already exists. ";
    } else {
        $rs4 = move_uploaded_file($_FILES["literature_review_file"]["tmp_name"], "../../uploads/literature_reviews/" . $literature_review_fileName);
        //echo 'move_uploaded_file=' . $rs;
    }

    if (file_exists("../../uploads/Researchers/" . $fileName)) {
        echo $_FILES["file"]["name"] . " already exists. ";
    } else {
        $rs5 = move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/Researchers/" . $fileName);
        //echo 'move_uploaded_file=' . $rs;
    }
    if ($x != 0 && $rs1 == 1 && $rs2 == 1 && $rs3 == 1 && $rs4 == 1 && $rs5 == 1 && $y == 1) {
        echo '<div class="successbox" style="width:800px;direction: rtl;">';
        echo 'تم حفظ البيانات بنجاح' . ' ' . '<a target="_blank" href="Print.php?' . 'research_code=' . base64_encode($research_id) . 'title_ar=' . base64_encode($title_ar) . '&program=' . base64_encode($program) . '&submit=' . base64_encode($Status_Date) . '&budget=' . base64_encode($budget) . '">طباعة نموذج التقديم الإلكتروني</a>';
        //require_once 'Print.php';
        //generate_proposal_pdf($research_id, $title_ar, $program, $Status_Date, $budget, $proposal_fileName);
        //merge_proposal_pdf($proposal_fileName, $abstract_ar_fileName, $abstract_en_fileName, $introduction_fileName, $literature_review_fileName, $proposal_fileName);
        //echo 'تم حفظ البيانات بنجاح' . ' ' . '<a target="_blank" href="../../uploads/complete_proposals/" . $proposal_fileName . ".pdf"> طباعة نموذج التقديم الإلكتروني</a>';
        //echo 'تم حفظ البيانات بنجاح' . ' ' . '<a target="_blank" href="pdf_merge.php?' . 'generated_proposal_fileName=' . base64_encode($proposal_fileName) . '&abstract_ar_fileName=' . base64_encode($abstract_ar_fileName) . '&abstract_en_fileName=' . base64_encode($abstract_en_fileName) . '&introduction_fileName=' . base64_encode($introduction_fileName) . '&literature_review_fileName=' . base64_encode($literature_review_fileName) . '&complete_proposal_fileName=' . base64_encode($proposal_fileName) . '">طباعة نموذج التقديم الإلكتروني</a>';
        //       

        echo '</div>';
    } else {
        echo '<p>لقد  فشلت عمليه ادخال البيانات</p>' . '<br/>';
        echo 'x= ' . $x . '<br/>';
        echo 'rs1= ' . $rs1 . '<br/>';
        echo 'rs2= ' . $rs2 . '<br/>';
        echo 'rs3= ' . $rs3 . '<br/>';
        echo 'rs4= ' . $rs4 . '<br/>';
        echo 'rs5= ' . $rs5 . '<br/>';
        echo 'y= ' . $y . '<br/>';
    }
}
?>
<link href="../../common/css/MessageBox.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

