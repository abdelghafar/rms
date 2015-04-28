<?
session_start();
require_once '../../lib/Reseaches.php';
?>

<html>
<head>
    <link rel="stylesheet" href="../../common/css/MessageBox.css" type="text/css"/>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".successbox").hide();
            $(".successbox").fadeIn(4000, 'swing');
        });
    </script>
</head>
<body>
<?
$r = new Reseaches();
$Research_Id = $_POST['Research_Id'];
$Research = $r->GetResearch($Research_Id);

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

if (!isset($_POST['proposed_duration']) || empty($_POST['proposed_duration'])) {
    echo 'من فضلك ادخل فترة المشروع المقترحة' . '<br/>';
    $isValid = FALSE;
} else {
    $proposed_duration = mysql_escape_string(trim($_POST['proposed_duration']));
    $proposed_duration = str_replace('_', ' ', $proposed_duration);
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

$PrevoiusFile = FALSE;
if ($_FILES['file']['error'] == 4) {
    $PrevoiusFile = TRUE;
}
if ($_FILES['file']['size'] > 2 * 1024 * 1024) {
    echo 'حجم الملف يجب أن لا يزيد عن 2 ميجابايت' . '<br/>';
    $isValid = FALSE;
}

$budget = $_POST['currencyInput'];
$seqId = $Research['seq_id'];
$reseach_code = $Research['research_code'];
$Approve_session_no = $Research['Approve_session_no'];
$Approve_date = $Research['Approve_date'];
if ($PrevoiusFile == TRUE) {
    $url = $Research['url'];
} else {
    $fileExtension = end(explode(".", $_FILES["file"]["name"]));
    $fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
    $url = "uploads/Researchers/" . $fileName;
    move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/Researchers/" . $fileName);
}
$Status_id = $Research['status_id'];
$Status_date = $Research['status_date'];
$center_id = $Research['center_id'];
$research_year = $Research['research_year'];

if ($isValid == 1) {
    $result = $r->Save($seqId, $title_ar, $title_en, $proposed_duration, $major_field, $special_field, $reseach_code, $Approve_session_no, $Approve_date, $url, $abstract_ar, $abstract_en, $Status_id, $Status_date, $center_id, $research_year, $budget);
    if ($result == 1) {
        echo '<div class="successbox" style="direction:rtl;width:750px;text-align: right;"><span>' . 'تم حفظ البيانات بنجاح' . '</span></div>';
    }
}
?>

</body>

</html>