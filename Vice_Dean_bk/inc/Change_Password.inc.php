<?php
session_start();
require_once '../../lib/users.php';
$u = new Users();
$password = $_POST['password'];
$userId = $_POST['user_id'];
$passwordConfirm = $_POST['passwordConfirm'];
if (md5($password) != md5($passwordConfirm)) {
    echo 'من فضلك ادخل كلمة المرور بشكل صحيح';
} else {
    $out = $u->ChnagePassword($userId, $password);
    if ($out == 1)
        echo 'تم حفظ البيانات بنجاح';
    else
        echo 'لقد حدث خطأ غير محدد من فضلك أعد المحاولة لاحقا';
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../../common/css/reigster-layout.css"/> 
    <style>
        body{
            margin: 0px;
        }
    </style>
</head>
<body>

</body>