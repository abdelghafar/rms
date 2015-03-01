<?php

session_start();
//header 
require_once '../../lib/Reseaches.php';
require_once '../../lib/reseach_track.php';
require_once '../../lib/GeneratePasswords.php';
require_once '../../lib/users.php';
require_once '../../lib/persons.php';
//$smarty->display('../../templates/header.tpl');
//End Header 
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

$isValid = TRUE;

$UserId = $_SESSION['User_Id'];
$users = new Users();
$person_Id = $users->GetPerosnId($UserId, 'Researcher');

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

if (!isset($_POST['Nationality']) || empty($_POST['Nationality'])) {
    $Nationality = "";
} else
    $Nationality = mysql_escape_string(trim($_POST['Nationality']));

if (!isset($_POST['BirthDateVal']))
    echo 'من فضلك ادخل تاريخ الميلاد' . '<br/>';
else {
    $BirthDate = date_parse($_POST['BirthDateVal']);
    $BirthDate = $BirthDate['year'] . '-' . $BirthDate['month'] . '-' . $BirthDate['day'];
}

if (!isset($_POST['CountryOfBirth']) || empty($_POST['CountryOfBirth']))
    $CountryOfBirth = "";
else
    $CountryOfBirth = mysql_escape_string(trim($_POST['CountryOfBirth']));

$Position = mysql_escape_string($_POST['Position']);

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

$IBAN = $_POST['iban'];
$ibanArray = explode('-', $IBAN);
$IBAN = $ibanArray[0] . $ibanArray[1] . $ibanArray[2] . $ibanArray[3] . $ibanArray[4] . $ibanArray[5];

$NoFile = True;
if ($_FILES['file']['error'] == 4) {
    $NoFile = TRUE;
} else if ($_FILES['file']['error'] == 0) {
    $NoFile = FALSE;
}
//echo '<br/>' . 'NoFile:' . $NoFile . '<br/>';
//echo 'File Error Code:' . $_FILES['file']['name'];


if ($isValid == TRUE) {
    $person = new Persons();
    //$result = $person->Save($person_Id, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, $gender, $Nationality, $BirthDate, $CountryOfBirth, $Position, $major_field, $special_field, $university, $college, $dept, $empCode, $eqamaCode, $email, $mobile, $fax, $city, $country, $POX, $postal_code, $IBAN);
    $result = $person->Save($person_Id, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, $gender, $Nationality, $BirthDate, $CountryOfBirth, $Position, $major_field, $special_field, $university, $college, $dept, $empCode, $eqamaCode, $email, $mobile, $fax, $city, $country, $POX, $postal_Code, $IBAN, '');
    if ($result == 1) {
        echo 'تم تعديل البيانات بنجاح';
    } else {
        echo 'لقد حدث خطأ غير معروف برجاء اعادة المحاولة لاحقا';
    }
}
?>

