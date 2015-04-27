<?php

session_start();
require_once '../../lib/users.php';
$u = new Users();
$password = $_POST['password'];
$userId = $_POST['user_id'];
$fromDate = $_POST['fromDateVal'];
$thruDate = $_POST['thruDateVal'];

$passwordConfirm = $_POST['passwordConfirm'];
if (md5($password) != md5($passwordConfirm)) {
    echo 'من فضلك ادخل كلمة المرور بشكل صحيح';
} else {
    $out = $u->ChnagePasswordWithDate($userId, $password, $fromDate, $thruDate);
    if ($out == 1) {
        echo 'تم حفظ البيانات بنجاح';
    } else {
        echo 'لقد حدث خطأ غير محدد من فضلك أعد المحاولة لاحقا';
    }
}