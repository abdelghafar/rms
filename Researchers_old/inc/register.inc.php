<?php
session_start();
//header 
require_once '../../lib/Reseaches.php';
require_once '../../lib/reseach_track.php';
require_once '../../lib/recaptcha/recaptchalib.php';
require_once '../../lib/Smarty/libs/Smarty.class.php';
require_once '../../lib/GeneratePasswords.php';
require_once '../../lib/users.php';
require_once '../../lib/persons.php';
$privatekey = "6LeKVOwSAAAAAH-ndokZDu-ehw9Utiv97D3firlA";

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
$CountryOfBirth = "";
$Position = "";
$major_field = "";
$special_field = "";
$university = "جامعة أم القري";
$college = "";
$dept = "";
$empCode = "";
$eqamaCode = "";
$email = "";
$mobile = "";
$fax = "";
$city = "";
$country = "";
$POX = "";
$postal_code = "";
$user = new Users();
$person = new Persons();
$isValid = TRUE;
$response = "";

if (!isset($_POST['FirstName_ar']) || empty($_POST['FirstName_ar'])) {
    $response .= 'من فضلك ادخل الاسم الأول باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $FirstName_ar = mysql_escape_string(trim($_POST['FirstName_ar']));

if (!isset($_POST['FatherName_ar']) || empty($_POST['FatherName_ar'])) {
    $response .= 'من فضلك أدخل بسم الأب ياللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $FatherName_ar = mysql_escape_string(trim($_POST['FatherName_ar']));

if (!isset($_POST['GrandName_ar']) || empty($_POST['GrandName_ar'])) {
    $response .= 'من فضلك أدخل اسم الجد باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $GrandName_ar = mysql_escape_string(trim($_POST['GrandName_ar']));

if (!isset($_POST['FamilyName_ar']) || empty($_POST['FamilyName_ar'])) {
    $response .= 'من فضلك ادخل اسم العائلة باللغة العربية' . '<br/>';

    $isValid = FALSE;
} else
    $FamilyName_ar = mysql_escape_string(trim($_POST['FamilyName_ar']));

if (!isset($_POST['FirstName_en']) || empty($_POST['FirstName_en'])) {
    $response .= 'من فضلك ادخل الاسم الاول باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $FirstName_en = mysql_escape_string(trim($_POST['FirstName_en']));

if (!isset($_POST['FatherName_en']) || empty($_POST['FatherName_en'])) {
    $response .= 'من فضلك ادخل اسم الأب باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $FatherName_en = mysql_escape_string(trim($_POST['FatherName_en']));

if (!isset($_POST['GrandName_en']) || empty($_POST['GrandName_en'])) {
    $response .= 'من فضلك ادخل اسم الجد باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $GrandName_en = mysql_escape_string(trim($_POST['GrandName_en']));

if (!isset($_POST['FamilyName_en']) || empty($_POST['FamilyName_en'])) {
    $response .= 'من فضلك ادخل اسم العائلة باللغة الانجليزية' . '<br/>';
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

if (!isset($_POST['BirthDateVal']))
    $response .= 'من فضلك ادخل تاريخ الميلاد' . '<br/>';
else {
    $BirthDate = date_parse($_POST['BirthDateVal']);
    $BirthDate = $BirthDate['year'] . '-' . $BirthDate['month'] . '-' . $BirthDate['day'];
}

if (!isset($_POST['CountryOfBirth']) || empty($_POST['CountryOfBirth']))
    $CountryOfBirth = "";
else
    $CountryOfBirth = mysql_escape_string(trim($_POST['CountryOfBirth']));

$Position = $_POST['Position'];

if (!isset($_POST['major_field']) || empty($_POST['major_field'])) {
    $response .= 'من فضلك ادخل التخصص العام' . '<br/>';
    $isValid = FALSE;
} else
    $major_field = mysql_escape_string(trim($_POST['major_field']));

if (!isset($_POST['special_field']) || empty($_POST['special_field'])) {
    $response .= 'من فضلك ادخل التخصص الدقيق' . '<br/>';
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
    $response .= 'من فضلك ادخل رقم منسوب الجامعة' . '<br/>';
    $isValid = FALSE;
} else
    $empCode = mysql_escape_string($_POST['empCodeVal']);

if (!isset($_POST['eqamaCodeVal']) || empty($_POST['eqamaCodeVal'])) {
    $response .= 'من فضلك ادخل رقم الهوية ' . '<br/>';
    $isValid = FALSE;
} else
    $eqamaCode = mysql_escape_string($_POST['eqamaCodeVal']);


if (!isset($_POST['email']) || empty($_POST['email']))
    $response .= 'من فضلك ادخل البريد الإلكتروني' . '<br/>';
else {

    $rs = explode("@", trim($_POST['email']));
    $rs = strtolower($rs[1]);
    if (!strcasecmp($rs, 'uqu.edu.sa'))
        $email = mysql_escape_string($_POST['email']);
    else {
        $response .= 'يجب ان يكون البريد الالكتروني علي نطاق جامعة أم القري' . '<br/>';
        $isValid = FALSE;
    }
}
if (!isset($_POST['mobile']) || empty($_POST['mobile']))
    $mobile = "";
else
    $mobile = mysql_escape_string(trim($_POST['mobile']));

if (!isset($_POST['fax']) || empty($_POST['fax']))
    $fax = "";
else
    $fax = mysql_escape_string(trim($_POST['fax']));

if (!isset($_POST['city']) || empty($_POST['city']))
    $city = "";
else
    $city = mysql_escape_string(trim($_POST['city']));

if (!isset($_POST['country']) || empty($_POST['country']))
    $country = "";
else
    $country = mysql_escape_string(trim($_POST['country']));

if (!isset($_POST['POX']) || empty($_POST['POX']))
    $POX = "";
else
    $POX = mysql_escape_string(trim($_POST['POX']));

if (!isset($_POST['postal_code']) || empty($_POST['postal_code']))
    $postal_code = "";
else
    $postal_code = mysql_escape_string(trim($_POST['postal_code']));

if (strlen($_POST['password']) < 8) {
    $response .= 'Password should be 8 Char at least.' . '<br/>';
    $isValid = FALSE;
}
$rs = $person->IsExistByEmail($_POST['email']);
if ($rs > 0) {
    $response .= 'لقد تم التسجل بواسطه هذا البريد الالكتروني من قبل';
    $isValid = FALSE;
}
$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
if (!$resp->is_valid) {
    $isValid = FALSE;
    $response .= "لقد أدخلت رمز التأكيد بشكل خطأ من فضلك أعد المحاولة";
} else {
    if ($isValid == TRUE) {
        $pass = $_POST['password'];
        $hash = md5(rand(0, 10000));
        try {
            $person_id = $person->Save(0, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, $gender, $Nationality, $BirthDate, $CountryOfBirth, $Position, $major_field, $special_field, $university, $college, $dept, $empCode, $eqamaCode, $email, $mobile, $fax, $city, $country, $POX, $postal_code, '', '');

            $user->Save(0, $email, $pass, $hash, $person_id, 'Researcher', 1, 0, 0, 0, 0, '', date('Y-m-d'));
            echo ' <div class="successbox" style="direction:rtl;width:800px;text-align: right;">';
            echo 'تم حفظ البيانات بنجاح ';
            echo 'يمكنك الانتقال الي' . '<a href="../../login.php" target="_blank"> صفحة الدخول</a>';
            echo '';
            echo '</div>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo '<div class="errormsgbox" style="direction:rtl;width:800px;text-align: right;">';
        echo $response;
        echo '</div>';
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="../../common/css/MessageBox.css" type="text/css"/>

</head>
<body>

</body>
</html>
