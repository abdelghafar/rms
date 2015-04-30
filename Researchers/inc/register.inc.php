<?php
session_start();
//header 
require_once '../../lib/Reseaches.php';
require_once '../../lib/reseach_track.php';
require_once '../../lib/recaptcha/recaptchalib.php';
require_once '../../lib/Smarty/libs/Smarty.class.php';
require_once '../../lib/GeneratePasswords.php';
require_once '../../lib/persons.php';

//ToDo: complete issue #102

$name_ar = "";
$name_en = "";
$gender = "";
$Nationality = "";
$Position = "";
$university = "";
$college = "";
$dept = "";
$email = "";
$mobile = "";
$cat_code = 3;
$ni_image_url = "";

$person = new Persons();
$isValid = TRUE;
$response = "";

if (!isset($_POST['name_ar']) || empty($_POST['name_ar'])) {
    $response .= 'من فضلك ادخل الاسم الأول باللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $name_ar = mysql_real_escape_string(trim($_POST['name_ar']));

if (!isset($_POST['name_en']) || empty($_POST['name_en'])) {
    $response .= 'من فضلك أدخل بسم الأب ياللغة العربية' . '<br/>';
    $isValid = FALSE;
} else
    $name_en = mysql_real_escape_string(trim($_POST['name_en']));

$gender = $_POST['genderType'];

if ($gender == 'ذكر')
    $gender = 0;
else
    $gender = 1;

if (!isset($_POST['selectedCountry']) || empty($_POST['selectedCountry'])) {
    $Nationality = "";
} else
    $Nationality = mysql_real_escape_string(trim($_POST['selectedCountry']));

$Position = $_POST['Position'];

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

$uploadOk =0;
if (!empty($_FILES['fileToUpload']['name'])) {
    $uploadOk = 1;
    echo '<p class="error">' . 'من فضلك قم بتحميل صورة اثبات الهوية' . '</p>';
    if (file_exists($target_file)) {
        echo "<pre>" . "Sorry, file already exists." . '</pre>';
        $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 500000 || $_FILES["fileToUpload"]["size"] == 0) {
        echo "<pre>" . "Sorry, your file is too large." . '</pre>';
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "pdf"
    ) {
        echo "<pre>" . "Sorry, only JPG, JPEG, PNG,GIF and PDF files are allowed." . '</pre>';
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<pre>" . "Sorry, your file was not uploaded." . "<pre>";
// if everything is ok, try to upload file
    }
}

$rs = $person->IsExistByEmail($_POST['email']);
/**
 *
 */
$ni_image_url = "";
$target_dir = "../../uploads/";
$target_file = $target_dir . basename($_FILES["uploadFile"]["name"]);
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if ($uploadOk == 1) {
    var_dump($uploadOk);

    if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
        $file_name = pathinfo(basename($_FILES["uploadFile"]["name"]), PATHINFO_FILENAME) . pathinfo(basename($_FILES["uploadFile"]["name"]), PATHINFO_EXTENSION);
        $ni_image_url = $file_name;
        echo 'file name is = ' . $file_name;
        $ni_image_url = basename($_FILES["uploadFile"]["name"]);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if ($rs > 0) {
    $response .= 'لقد تم التسجل بواسطه هذا البريد الالكتروني من قبل.';
    $isValid = FALSE;
}
if ($isValid == TRUE && isset($_POST['key'])) {
    try {
//        unset($_POST);
        var_dump($ni_image_url);
        $person_id = $person->Save(0, $name_ar, $name_en, $gender, $Nationality, $Position, $university, $college, $dept, $email, $mobile, $cat_code, $ni_image_url);


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
