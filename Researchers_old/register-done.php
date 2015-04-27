<?
session_start();
require_once '../js/fckeditor/fckeditor.php';
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

$smarty->display('../templates/Loggedin.tpl');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../common/css/MessageBox.css"/> 
        <script type="text/javascript">
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 5000);
        </script>
    </head>
    <body>
    <center>
        <div class="successbox" style="width:800px;">
            <h2>
                تم حفظ البيانات بنجاح
            </h2>
        </div>
    </center>
</body>
</html>
<?
session_destroy();
$smarty->display('../templates/footer.tpl');
?>