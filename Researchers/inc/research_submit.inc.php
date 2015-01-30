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
$major_field = "";
$special_field = "";
$research_code = "";
$research_center = 0;
$Approve_session_no = 0;
$Approve_date = '';
$research_year = 0;
$abstract_en = "";
$abstract_ar = "";
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
}

if (!isset($_POST['major_field']) || empty($_POST['major_field'])) {
    echo 'من فضلك ادخل التخصص العام' . '<br/>';
    $isValid = FALSE;
} else
    $major_field = mysql_escape_string(trim($_POST['major_field']));

if (!isset($_POST['special_field']) || empty($_POST['special_field'])) {
    echo 'من فضلك ادخل التخصص  الدقيق' . '<br/>';
    $isValid = FALSE;
} else
    $special_field = mysql_escape_string(trim($_POST['special_field']));

if (!isset($_POST['abstract_ar']) || empty($_POST['abstract_ar'])) {
    echo 'من فضلك ادخل الملخص باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $abstract_ar = mysql_escape_string(trim($_POST['abstract_ar']));

if (!isset($_POST['abstract_en']) || empty($_POST['abstract_en'])) {
    echo 'من فضلك ادخل الملخص باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $abstract_en = mysql_escape_string(trim($_POST['abstract_en']));

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

$research_center = $_POST['research_center'];
$budget = $_POST['budgetValue'];
$Status_Id = 1;
$Status_Date = date('Y-m-d');
$fileExtension = end(explode(".", $_FILES["file"]["name"]));
$fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;


if ($isValid == FALSE) {
    echo '<label>' . 'برجاء التأكد من صحة البيانات' . '<label/>';
}

$res = new Reseaches();
$research_code = $res->GenerateResearchCode($research_center);
if ($isValid == TRUE) {
    $researcher = new Reseaches();
    print_r($_POST) . '<br/>';
    $research_id = $researcher->Save(0, $title_ar, $title_en, $proposed_duration, $major_field, $special_field, $research_code, $Approve_session_no, $Approve_date, "uploads/Researchers/" . $fileName, $abstract_ar, $abstract_en, $Status_Id, $Status_Date, $research_center, $research_year, $budget, $program);
    $x = $research_id;

    $track = new Reseaches_track();
    $y = $track->Save($research_id, $Status_Id, $Status_Date, $notes);
    echo 'y is:' . $y;
    $research_author = new research_Authors();
    $research_author->Save($research_id, $person_id, 1);

    $researchCenter = new CenterResearch();
    $researchCenterName = $researchCenter->GetRCenterNameById($research_center);
    if (file_exists("../../uploads/Researchers/" . $fileName)) {
        echo $_FILES["file"]["name"] . " already exists. ";
    } else {
        $rs = move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/Researchers/" . $fileName);
        echo 'move_uploaded_file=' . $rs;
    }
    if ($x != 0 && $rs == 1 && $y == 1) {
        echo '<div class="successbox" style="width:850px;">';
        echo 'تم حفظ البيانات بنجاح' . ' ' . '<a href="Print.php?research_code=' . base64_encode($research_code) . '&title_ar=' . base64_encode($title_ar) . '&rcenter=' . base64_encode($researchCenterName) . '&submit=' . base64_encode($Status_Date) . '&budget=' . base64_encode($budget) . '">من فضلك اضغط هنا للحصول علي ايصال الاستلام</a>';
        echo '</div>';
    } else {
        echo '<p>لقد  فشلت عمليه ادخال البيانات</p>' . '<br/>';
        echo 'x= ' . $x . '<br/>';
        echo 'rs= ' . $rs . '<br/>';
        echo 'y= ' . $y . '<br/>';
    }
}


