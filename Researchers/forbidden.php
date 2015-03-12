<?
session_start();
header('HTTP/1.1 403 Forbidden');
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
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div style="min-height: 400px;color: #000;text-align: left;padding-left: 10px;">
            <h1 style="color: #006699;">403 Forbidden or No Permission to Access</h1><span>
                for more information click here
            </span>

            <hr/>
            <h4>For Login <a href="../login.php">Click Here</a></h4>
        </div>
    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
