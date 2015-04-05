<?
session_start();
require_once './redirect.php';
Redirect();
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
$smarty->assign('fqa_php', 'fqa.php');
$smarty->assign('about_php', 'aboutus.php');

$smarty->display('templates/header.tpl');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div class="art-content-layout layout-item-1">
            <div class="art-content-layout-row">
                <div class="art-layout-cell layout-item-2" style="width: 25%" >
                    <h3 style="text-align: right;">شروط التقديم</h3>
                    <p><img width="64" height="64" alt="" src="images/41_64x64.png" style="float:left;margin-right:10px;" class=""></p><p style="text-align: justify;">
                        شروط التقدم لتمويل المشروعات البحثية والعناصر المطلوب إستيفائها</p><p style="text-align: left;"><a href="#" target="_self"><span style="font-weight: bold; color: rgb(245, 37, 10); ">...التفاصيل</span></a></p>
                    <p>
                    </p>
                </div><div class="art-layout-cell layout-item-3" style="width: 25%" >
                    <h3 style="text-align: right;">إجراءات تمويل المشاريع البحثية</h3>
                    <p><img width="64" height="64" alt="" src="images/48_64x64.png" style="float:left;margin-right:10px;" class=""></p>
                    <p style="text-align: justify;">خطوات ومراحل تمويل المشروع البحثيى&nbsp;من مرحلة التقديم حتى مرحلة إتمام تنفيذ المشروع البحثى.</p>
                    <p style="text-align: left;"><span style="text-align: left;"><a href="#" target="_self" style="text-decoration: underline; color: rgb(219, 157, 0);"><span style="font-weight: bold; color: rgb(245, 37, 10); ">...التفاصيل</span></a></span><a href="#" style="text-decoration: underline; color: rgb(255, 207, 87); cursor: pointer;"></a><a href="#"></a></p>
                </div><div class="art-layout-cell layout-item-4" style="width: 25%" >
                    <h3 style="text-align: right;">لائحة البحث العلمى السعودية</h3>
                    <p><img width="64" height="64" alt="" src="images/15_64x64.png" style="float:left;margin-right:10px;" class=""></p>
                    <p style="text-align: justify;">كل ما يتعلق بالقواعد واللوائح &nbsp;المنظمة لعملية البحث العلمى بالجامعات السعودية.<br></p>
                    <p style="text-align: left;"><span style="text-align: left;"><a href="#" target="_self" style="text-decoration: underline; color: rgb(219, 157, 0);"><span style="font-weight: bold; color: rgb(245, 37, 10); ">...التفاصيل</span></a></span><a href="#" style="text-decoration: underline; color: rgb(255, 207, 87); cursor: pointer;"></a><a href="#"></a></p>
                </div><div class="art-layout-cell layout-item-3" style="width: 25%" >
                    <h3 style="text-align: right;">النماذج والإستمارات</h3>
                    <p><img width="64" height="64" alt="" src="images/34_64x64.png" style="float:left;margin-right:10px;" class=""></p>
                    <p style="text-align: justify;">النماذج المستخدمة فى عملية تمويل المشروعات البحثية للكل من الباحثين والمحكمين.</p>
                    <p style="text-align: left;"><span style="text-align: left;"><a href="#" target="_self" style="text-decoration: underline; color: rgb(219, 157, 0);"><span style="font-weight: bold; color: rgb(245, 37, 10);">...التفاصيل</span></a></span><a href="#" style="text-decoration: underline; color: rgb(255, 207, 87);"></a><a href="#"></a></p>
                </div>
            </div>
        </div>


    </body>
</html>


<?
$smarty->display('../templates/footer.tpl');
?>