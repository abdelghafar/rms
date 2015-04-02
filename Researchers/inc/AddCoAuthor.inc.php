<?php

session_start();
//header 
require_once '../../lib/Reseaches.php';
require_once '../../lib/reseach_track.php';
require_once '../../lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->assign('style_css', '../../style.css');
$smarty->assign('style_responsive_css', '../../style.responsive.css');
$smarty->assign('jquery_js', '../../jquery.js');
$smarty->assign('script_js', '../../script.js');
$smarty->assign('script_responsive_js', '../../script.responsive.js');
$smarty->assign('index_php', '../../index.php');
$smarty->assign('Researchers_register_php', '../../Researchers/register.php');
$smarty->assign('login_php', '../../login.php');
$smarty->assign('fqa_php', '../../fqa.php');
$smarty->assign('contactus_php', '../../contactus.php');

//$smarty->display('../../templates/header.tpl');
//End Header 

require_once '../../lib/persons.php';
require_once '../../lib/research_Authors.php';

$FirstName_ar = "";
$FatherName_ar = "";
$GrandName_ar = "";
$FamilyName_ar = "";
$FirstName_en = "";
$FatherName_en = "";
$GrandName_en = "";
$FamilyName_en = "";
$gender = "";
$Nationality = "";
$BirthDate = "";

$Position = "";
$major_field = "";
$special_field = "";
$university = "";
$college = "";
$dept = "";
$empCode = "";
$eqamaCode = "";
$email = "";
$mobile = "";
$fax = "";


$isValid = TRUE;

if (!isset($_POST['FirstName_ar']) || empty($_POST['FirstName_ar'])) {
    echo 'من فضلك ادخل الاسم الأول باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $FirstName_ar = mysql_escape_string(trim($_POST['FirstName_ar']));

if (!isset($_POST['FatherName_ar']) || empty($_POST['FatherName_ar'])) {
    echo 'من فضلك أدخل بسم الأب ياللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $FatherName_ar = mysql_escape_string(trim($_POST['FatherName_ar']));

if (!isset($_POST['GrandName_ar']) || empty($_POST['GrandName_ar'])) {
    echo 'من فضلك أدخل اسم الجد باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $GrandName_ar = mysql_escape_string(trim($_POST['GrandName_ar']));

if (!isset($_POST['FamilyName_ar']) || empty($_POST['FamilyName_ar'])) {
    echo 'من فضلك ادخل اسم العائلة باللغة العربية' . '<br/>';

    $isValid = FALSE;
} else
    $FamilyName_ar = mysql_escape_string(trim($_POST['FamilyName_ar']));

if (!isset($_POST['FirstName_en']) || empty($_POST['FirstName_en'])) {
    echo 'من فضلك ادخل الاسم الاول باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $FirstName_en = mysql_escape_string(trim($_POST['FirstName_en']));

if (!isset($_POST['FatherName_en']) || empty($_POST['FatherName_en'])) {
    echo 'من فضلك ادخل اسم الأب باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $FatherName_en = mysql_escape_string(trim($_POST['FatherName_en']));

if (!isset($_POST['GrandName_en']) || empty($_POST['GrandName_en'])) {
    echo 'من فضلك ادخل اسم الجد باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $GrandName_en = mysql_escape_string(trim($_POST['GrandName_en']));

if (!isset($_POST['FamilyName_en']) || empty($_POST['FamilyName_en'])) {
    echo 'من فضلك ادخل اسم العائلة باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $FamilyName_en = mysql_escape_string(trim($_POST['FamilyName_en']));

$gender = $_POST['genderType'];

if ($gender == 'ذكر')
    $gender = 0;
else
    $gender = 1;

if (!isset($_POST['Nationality']) || empty($_POST['Nationality'])) {
    $Nationality = "";
} else
    $Nationality = mysql_escape_string(trim($_POST['Nationality']));

$Position = $_POST['Position'];

if (!isset($_POST['major_field']) || empty($_POST['major_field'])) {
    echo 'من فضلك ادخل التخصص العام' . '<br/>';
    $isValid = FALSE;
} else
    $major_field = mysql_escape_string(trim($_POST['major_field']));

if (!isset($_POST['special_field']) || empty($_POST['special_field'])) {
    echo 'من فضلك ادخل التخصص الدقيق' . '<br/>';
    $isValid = FALSE;
} else
    $special_field = mysql_escape_string(trim($_POST['special_field']));

if (!isset($_POST['college']) || empty($_POST['college'])) {
    $college = "";
} else
    $college = mysql_escape_string(trim($_POST['college']));

if (!isset($_POST['dept']) || empty($_POST['dept']))
    $dept = "";
else
    $dept = mysql_escape_string(trim($_POST['dept']));

if (!isset($_POST['empCodeVal']) || empty($_POST['empCodeVal'])) {
    echo 'من فضلك ادخل رقم منسوب الجامعة' . '<br/>';
    $isValid = FALSE;
} else
    $empCode = mysql_escape_string($_POST['empCodeVal']);

if (!isset($_POST['eqamaCodeVal']) || empty($_POST['eqamaCodeVal'])) {
    echo 'من فضلك ادخل رقم الهوية ' . '<br/>';
    $isValid = FALSE;
} else
    $eqamaCode = mysql_escape_string($_POST['eqamaCodeVal']);


if (!isset($_POST['email']) || empty($_POST['email']))
    echo 'من فضلك ادخل البريد الإلكتروني' . '<br/>';
else
    $email = $_POST['email'];

if (!isset($_POST['mobile']) || empty($_POST['mobile']))
    $mobile = "";
else
    $mobile = mysql_escape_string(trim($_POST['mobile']));

if (!isset($_POST['fax']) || empty($_POST['fax']))
    $fax = "";
else
    $fax = mysql_escape_string(trim($_POST['fax']));

$research_id = $_POST['research_id'];
if ($isValid == TRUE) {


    $person = new Persons();
    $isExist = $person->IsExist($eqamaCode);
    if ($isExist == 0) {
        $person->Save(0, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, $gender, $Nationality, $BirthDate, '', $Position, $major_field, $special_field, $university, $college, $dept, $empCode, $eqamaCode, $email, $mobile, $fax, '', '', '', '', '');
        $person_id = $person->GetLastPersonId();
    } else {
        $person_id = $isExist;
    }

    $research_author = new research_Authors();
    $res = $research_author->Save($research_id, $person_id, 0);
    if ($res == 1) {
        echo 'تم حفظ البيانات بنجاح';
    } else
        echo 'لقد حدث خطأ غير معروف برجاء اعادة المحاولة بعد فترة';
} else {
    echo 'من فضلك أكمل باقي البيانات';
}
?>
