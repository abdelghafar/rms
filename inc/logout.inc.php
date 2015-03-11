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

session_destroy();
?>
<head>
    <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
</head>
<body>
    <?
    header('Location:../index.php') ; 
    ?> 

</body>
<?
$smarty->display('../templates/footer.tpl');
?>
