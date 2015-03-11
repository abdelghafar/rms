<?
session_start();
require_once 'lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();


$smarty->assign('style_css', 'style.css');
$smarty->assign('style_responsive_css', 'style.responsive.css');
$smarty->assign('jquery_js', 'jquery.js');
$smarty->assign('script_js', 'script.js');
$smarty->assign('script_responsive_js', 'script.responsive.js');
$smarty->assign('index_php', 'index.php');
$smarty->assign('Researchers_register_php', 'Researchers/register.php');

$smarty->assign('login_php', 'login.php');
$smarty->assign('logout_php', 'inc/logout.inc.php');
$smarty->assign('fqa_php', 'fqa.php');
$smarty->assign('aboutus_php', 'aboutus.php');

if (isset($_SESSION['User_Id']) == true && $_SESSION['User_Id'] != 0) {
    $smarty->display('templates/Loggedin.tpl');
} else {
    $smarty->display('templates/header.tpl');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="common/css/reigster-layout.css" type="text/css"/> 
        <title></title>

    </head>
    <body>
    
        <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
                هذا الموقع يمكن منسوبي جامعة أم القرى من أعضاء هيئة تدريس وباحثين من التقديم على منح مالية لدعم ابحاثهم.
        </p>
        <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
           
                تم تطوير هذا الموقع بالتعاون المشترك بين وكالة الجامعة للتطوير الأكاديمي وخدمة المجتمع ممثلة في عمادة تقنية المعلومات ووكالة الجامعة للدراسات العليا والبحث العلمي ممثلة في عمادة البحث العلمي. حيث وفرت عمادة تقنية المعلومات بيئة التطوير ورخص البرامج والخوادم وطرق الاتصال وقامت عمادة البحث العلمي بتحليل وتطوير الموقع.
           
        </p>
        
         <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
           
يقر فريق التحليل بعمادة البحث العلمي إلى أنه تمت الاستفادة من موقع الخطة الوطنية للعلوم والتقنية (NSTIP.KACST.EDU.SA) خلال تطوير هذا الموقع.
        </p>
</body>
</html>


<?
$smarty->display('../templates/footer.tpl');
?>