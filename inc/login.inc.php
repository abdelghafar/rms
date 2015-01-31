<?php

session_start();
ob_start();
require_once '../lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->assign('style_css', '../style.css');
$smarty->assign('style_responsive_css', '../style.responsive.css');
$smarty->assign('jquery_js', '../jquery.js');
$smarty->assign('script_js', '../script.js');
$smarty->assign('script_responsive_js', '../script.responsive.js');
$smarty->assign('index_php', '../index.php');
$smarty->assign('Researchers_register_php', '../Researchers/register.php');
$smarty->assign('login_php', '../login.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');

$smarty->display('../templates/header.tpl');

require_once '../lib/users.php';

$userName = trim($_POST['username']);
$password = $_POST['password'];

$user = new Users();
$userId = $user->Login($userName, $password);
if ($userId != 0) {
    $userName = $user->GetUserName($userId);
    $isTemp = $user->IsTemp($userId);
    $rule = $user->GetUserRule($userId);
    $_SESSION['User_Id'] = $userId;
    $_SESSION['User_Name'] = $userName;
    $_SESSION['Rule'] = $rule;
    $_SESSION['Alias_Name'] = $user->GetAliasName($userId);
    $_SESSION['gender'] = $user->GetUserGender($userId);
    $user->SetLastAccess($userId);
}

if ($isTemp == 1) {
    $FromDate = $user->GetFromDate($userId);
    $ThruDate = $user->GetThruDate($userId);
    $now = date('Y-m-d');
    if ($now >= $FromDate && $now <= $ThruDate) {
        if ($rule == 'Reviewer') {
            header('Location:../Reviewer/index.php');
            exit();
        }
    } else {
        header('Location:../error.php');
        exit();
    }
}


if ($userId == 0) {
    header('Location:../login.php?Attempt=False');
    exit();
}

if ($rule == 'Researcher') {
    header('Location:../Researchers/selectProgram.php');
    exit();
} else if ($rule == 'Reseach_Center') {
    header('Location:../Reseach_Center/index.php');
    exit();
} else if ($rule == 'DeanShip') {
    header('Location:../DeanShip/index.php');
    exit();
} else if ($rule == 'Archive') {
    header('Location:../Archive/index.php');
    exit();
} else if ($rule == 'Vice_Dean') {
    header('Location:../Vice_Dean/index.php');
    exit();
} else if ($rule == 'Council_board') {
    header('Location:../Council_board/index.php');
    exit();
} else {
    header('Location:../login.php');
    exit();
}
ob_flush();
$smarty->display('../templates/footer.tpl');
