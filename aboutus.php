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
$smarty->assign('research_projects_php', 'Researchers/selectProgram.php');
$smarty->assign('logout_php', 'inc/logout.inc.php');
$smarty->assign('about_php', 'aboutus.php');

$smarty->assign('fqa_php', 'fqa.php');
$smarty->assign('contactus_php', 'contactus.php');

if (isset($_SESSION['program']) && $_SESSION['program'] > 0) {
    $smarty->display('templates/researcher_header.tpl');
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
        قامت عمادة البحث العلمي ممثلة في وكالة العمادة للمعلومات والنشر بالتطوير الذاتي لهذا النظام لمساعدة منسوبي جامعة
        أم القرى من أعضاء هيئة تدريس وباحثين على التقديم على منح مالية لدعم ابحاثهم.

    </p>

    <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
        تم تطوير هذا الموقع بالتعاون المشترك بين وكالة الجامعة للتطوير الأكاديمي وخدمة المجتمع ممثلة في عمادة تقنية
        المعلومات ووكالة الجامعة للدراسات العليا والبحث العلمي ممثلة في عمادة البحث العلمي. حيث وفرت عمادة تقنية
        المعلومات بيئة التطوير ورخص البرامج والخوادم وطرق الاتصال وقامت عمادة البحث العلمي بتحليل وتطوير الموقع.
    </p>

    <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
        قامت عمادة شئون أعضاء هيئة التدريس والموظفين مشكورة بالموافقة على الاتصال الرقمي بين النظام وبيانات أعضاء هيئة
        التدريس. الأمر الذي وفر على المتقدمين تسجيل بياناتهم الأساسية ووفر على عمادة البحث العلمي تدقيق تلك البيانات
    </p>

    <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
        يقر فريق التحليل بعمادة البحث العلمي بأنه تمت الاستفادة من موقع الخطة الوطنية للعلوم والتقنية
        (nstip.kacst.edu.sa) خلال تطوير هذا الموقع.
    </p>
    </body>
    </html>


<?
$smarty->display('../templates/footer.tpl');
?>