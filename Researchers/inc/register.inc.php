<?php
session_start();
//header 
require_once '../../lib/Reseaches.php';
require_once '../../lib/reseach_track.php';
require_once '../../lib/recaptcha/recaptchalib.php';
require_once '../../lib/Smarty/libs/Smarty.class.php';
require_once '../../lib/GeneratePasswords.php';
require_once '../../lib/persons.php';


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
$email = "";
$mobile = "";
$fax = "";

$person = new Persons();
$isValid = TRUE;
$response = "";

if (!isset($_POST['FirstName_ar']) || empty($_POST['FirstName_ar'])) {
    $response .= 'من فضلك ادخل الاسم الأول باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $FirstName_ar = mysql_real_escape_string(trim($_POST['FirstName_ar']));

if (!isset($_POST['FatherName_ar']) || empty($_POST['FatherName_ar'])) {
    $response .= 'من فضلك أدخل بسم الأب ياللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $FatherName_ar = mysql_real_escape_string(trim($_POST['FatherName_ar']));

if (!isset($_POST['GrandName_ar']) || empty($_POST['GrandName_ar'])) {
    $response .= 'من فضلك أدخل اسم الجد باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $GrandName_ar = mysql_real_escape_string(trim($_POST['GrandName_ar']));

if (!isset($_POST['FamilyName_ar']) || empty($_POST['FamilyName_ar'])) {
    $response .= 'من فضلك ادخل اسم العائلة باللغة العربية' . '<br/>';

    $isValid = FALSE;
} else
    $FamilyName_ar = mysql_real_escape_string(trim($_POST['FamilyName_ar']));

if (!isset($_POST['FirstName_en']) || empty($_POST['FirstName_en'])) {
    $response .= 'من فضلك ادخل الاسم الاول باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $FirstName_en = mysql_real_escape_string(trim($_POST['FirstName_en']));

if (!isset($_POST['FatherName_en']) || empty($_POST['FatherName_en'])) {
    $response .= 'من فضلك ادخل اسم الأب باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $FatherName_en = mysql_real_escape_string(trim($_POST['FatherName_en']));

if (!isset($_POST['GrandName_en']) || empty($_POST['GrandName_en'])) {
    $response .= 'من فضلك ادخل اسم الجد باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $GrandName_en = mysql_real_escape_string(trim($_POST['GrandName_en']));

if (!isset($_POST['FamilyName_en']) || empty($_POST['FamilyName_en'])) {
    $response .= 'من فضلك ادخل اسم العائلة باللغة الانجليزية' . '<br/>';
    $isValid = FALSE;
} else
    $FamilyName_en = mysql_real_escape_string(trim($_POST['FamilyName_en']));

$gender = $_POST['genderType'];

if ($gender == 'ذكر')
    $gender = 0;
else
    $gender = 1;

if (!isset($_POST['Nationality']) || empty($_POST['Nationality'])) {
    $Nationality = "";
} else
    $Nationality = mysql_real_escape_string(trim($_POST['Nationality']));

if (!isset($_POST['BirthDateVal']))
    $response .= 'من فضلك ادخل تاريخ الميلاد' . '<br/>';
else {
    $BirthDate = date_parse($_POST['BirthDateVal']);
    $BirthDate = $BirthDate['year'] . '-' . $BirthDate['month'] . '-' . $BirthDate['day'];
}

$Position = $_POST['Position'];

if (!isset($_POST['major_field']) || empty($_POST['major_field'])) {
    $response .= 'من فضلك ادخل التخصص العام' . '<br/>';
    $isValid = FALSE;
} else
    $major_field = mysql_real_escape_string(trim($_POST['major_field']));

if (!isset($_POST['special_field']) || empty($_POST['special_field'])) {
    $response .= 'من فضلك ادخل التخصص الدقيق' . '<br/>';
    $isValid = FALSE;
} else
    $special_field = mysql_real_escape_string(trim($_POST['special_field']));

if (!isset($_POST['college']) || empty($_POST['college'])) {
    $college = "";
} else
    $college = mysql_real_escape_string(trim($_POST['college']));

if (!isset($_POST['dept']) || empty($_POST['dept']))
    $dept = "";
else
    $dept = mysql_real_escape_string(trim($_POST['dept']));

if (!isset($_POST['email']) || empty($_POST['email']))
    $response .= 'من فضلك ادخل البريد الإلكتروني' . '<br/>';
else {
    $email = mysql_real_escape_string(trim($_POST['email']));
}
if (!isset($_POST['mobile']) || empty($_POST['mobile']))
    $mobile = "";
else
    $mobile = mysql_real_escape_string(trim($_POST['mobile']));

if (!isset($_POST['fax']) || empty($_POST['fax']))
    $fax = "";
else
    $fax = mysql_real_escape_string(trim($_POST['fax']));

$rs = $person->IsExistByEmail($_POST['email']);
/**
 *
 */
$ni_image_url = "";
$target_dir = "../../uploads/";
$target_file = $target_dir . basename($_FILES["uploadFile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "pdf"
) {
    echo "Sorry, only JPG, JPEG, PNG,GIF and PDF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}

if ($rs > 0) {
    $response .= 'لقد تم التسجل بواسطه هذا البريد الالكتروني من قبل';
    $isValid = FALSE;
}
if ($isValid == TRUE && isset($_POST['key']) && $uploadOk == 1) {
    try {
        unset($_POST);
        if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["uploadFile"]["name"]) . " has been uploaded.";
            $ni_image_url = basename($_FILES["uploadFile"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        $person_id = $person->Save(0, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, $gender, $Nationality, $BirthDate, '', $Position, $major_field, $special_field, $university, $college, $dept, '', '', $email, $mobile, $fax, '', '', '', '', '', '', 3, $ni_image_url);

        echo ' <div class="successbox" style="direction:rtl;width:800px;text-align: right;">';
        echo 'تم حفظ البيانات بنجاح ';
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
?>
<html>
<head>
    <link rel="stylesheet" href="../../common/css/MessageBox.css" type="text/css"/>

</head>
<body>

</body>
</html>
