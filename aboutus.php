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
    $smarty->display('templates/header.tpl');
} else {
    $smarty->display('templates/researcher_header.tpl');
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
        <h1 style="color: #ff0000" >
            نظام إدارة المنح البحثية  
        </h1>

        <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
            قامت عمادة البحث العلمي ممثلة في وكالة العمادة للمعلومات والنشر بالتطوير الذاتي لهذا النظام لمساعدة منسوبي جامعة أم القرى من أعضاء هيئة تدريس وباحثين على التقديم على منح مالية لدعم ابحاثهم.
        </p>

        <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
            قامت وكالة الجامعة للتطوير الأكاديمي وخدمة المجتمع ممثلة في عمادة تقنية المعلومات بدعم عمادة البحث العلمي عن طريق توفير بيئة التطوير ورخص البرامج والخوادم وطرق الاتصال.
        </p>

        <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
            قامت عمادة شئون أعضاء هيئة التدريس والموظفين بالموافقة على الاتصال الرقمي بين النظام وبيانات أعضاء هيئة التدريس. الأمر الذي وفر على المتقدمين تسجيل بياناتهم الأساسية ووفر على عمادة البحث العلمي تدقيق تلك البيانات.
        </p>

        <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">
            يقر فريق التحليل بعمادة البحث العلمي بأنه تم الاعتماد على اللائحة الموحدة للبحث العلمي في الجامعات السعودية الصادرة بقرار مجلس التعليم العالي رقم 02/10/1419هـ وموقع الخطة الوطنية للعلوم والتقنية (nstip.kacst.edu.sa) خلال تطوير هذا الموقع.
        </p>

        <hr>
        <h1 style="color: #ff0000" >
            للمساعدة وطلب الدعم الفني
        </h1>
        <h2 style="text-align: right">- خلال فترة الدوام الرسمي فقط (حسب توفر مسئول الدعم)<br></h3>
            <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">

                الاتصال على أ/سعيد الطلحي جوال: 0582520295 لأعضاء هيئة التدريس <br>
                الاتصال على د.نوره الفاروقي خط مباشر 0125604909 أو سنترال 0125426222 تحويله 7735 لعضوات هيئة التدريس.

            </p>
            <h2 style="text-align: right">
                -  على مدار الساعة
            </h2>
            <p style="font-weight: bold; font-size: 20px;line-height: 2;text-align: justify">

                ارسال بريد الكتروني إلى dsrmalesupport@uqu.edu.sa لأعضاء هيئة التدريس 
                <br> ارسال بريد الكتروني إلى dsrfemalesupport@uqu.edu.sa لعضوات هيئة التدريس
                <br> وسوف يتم الرد بمشيئة الله تعالى في مدة لاتتجاوز 48 ساعة عمل.


            </p>

    </body>
</html>


<?
$smarty->display('../templates/footer.tpl');
?>