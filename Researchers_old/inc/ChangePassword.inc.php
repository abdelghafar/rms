<?php
session_start();
require_once '../../lib/users.php';
$u = new Users();
$password = $_POST['password'];
$userId = $_SESSION['User_Id'];
$passwordConfirm = $_POST['passwordConfirm'];
$Current_Password = md5($_POST['Current_Password']);
$userInfo = $u->GetUser($userId);

if ($userInfo['pass'] != $Current_Password) {
    echo 'من فضلك تأكد من ادخال كلمة المرور الحالية بشكل صحيح';
} else {
    if (md5($password) != md5($passwordConfirm)) {
        echo 'من فضلك ادخل كلمة المرور بشكل صحيح';
    } else {
        $out = $u->ChnagePassword($userId, $password);
        if ($out == 1) {
            echo ' <div class="successbox" style="direction:rtl;width:800px;text-align: right;">';
            echo 'تم حفظ البيانات بنجاح ';
            echo '</div>';
        } else {
            echo '<div class="errormsgbox" style="direction:rtl;width:800px;text-align: right;">';
            echo 'لقد حدث خطأ غير محدد من فضلك أعد المحاولة لاحقا';
            echo '</div>';
        }
    }
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../../common/css/reigster-layout.css"/> 
    <link rel="stylesheet" href="../../common/css/MessageBox.css" type="text/css"/> 
    <style>
        body{
            margin: 0px;
        }
    </style>
</head>
<body style="text-align: center;">

</body>