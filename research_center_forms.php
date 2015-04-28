<?
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
$smarty->assign('contactus_php', 'contactus.php');

$smarty->display('templates/header.tpl');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>

    </head>
    <body>
        <div class="art-content-layout-row">
            <div class="art-layout-cell art-content"><article class="art-post art-article">
                    <h2 class="art-postheader">النماذج والإستمارات</h2>
                    <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout-wrapper layout-item-0">
                            <div class="art-content-layout layout-item-1">
                                <div class="art-content-layout-row">
                                    <div class="art-layout-cell layout-item-2" style="width: 100%" >
                                        <p><p><p><p></p><table width="607" border="0" cellpadding="0" cellspacing="0" style="width: 100%; "><tbody><tr><td valign="top"><div class="page_title_green" style="width: 607px; background-image: url(http://uqu.edu.sa/isr/images/page_title_green.gif); height: 40px; "><div class="page_title_text_right" style="margin-right: 45px; color: rgb(255, 255, 255); font-size: 18px; font-family: 'Times New Roman', Times, serif; font-weight: bold; vertical-align: middle; padding-top: 7px; ">نماذج خاصة بمدراء المراكز البحثية</div></div></td></tr><tr><td valign="top" dir="rtl"><div style="width: 500px; margin-right: 50px; "><ul style="list-style-image: url(http://uqu.edu.sa/isr/images/word_icon.gif); "><li style="font-size: 12px; font-family: Tahoma; color: rgb(0, 0, 0); text-align: justify; line-height: 2; "><a href="http://uqu.edu.sa/isr/pdf/%D9%86%D9%85%D9%88%D8%B0%D8%AC%20%D8%AA%D9%82%D9%88%D9%8A%D9%85%20%D9%84%D9%85%D8%B4%D8%B1%D9%88%D8%B9%20%D8%A8%D8%AD%D8%AB%D9%8A.doc" target="_blank" class="style4" style="color: rgb(0, 0, 255); font-size: 16px;  font-weight: bold; ">نموذج تقويم لمشروع بحثي باللغة الانجليزية</a></li><li style="font-size: 12px; font-family: Tahoma; color: rgb(0, 0, 0); text-align: justify; line-height: 2; "><a href="http://uqu.edu.sa/isr/pdf/%D8%A7%D8%B3%D8%AA%D9%85%D8%A7%D8%B1%D8%A9%20%D8%A7%D9%84%D9%85%D9%88%D8%A7%D9%81%D9%82%D8%A9%20%D8%B9%D9%84%D9%89%20%D8%AA%D8%AD%D9%83%D9%8A%D9%85%20%D8%A7%D9%84%D8%AA%D9%82%D8%B1%D9%8A%D8%B1%20%D8%A7%D9%84%D9%86%D9%87%D8%A7%D8%A6%D9%8A%20-%20%D8%AA%D8%B1%D8%AC%D9%85%D8%A9.doc" target="_blank" class="style4" style="color: rgb(0, 0, 255); font-size: 16px;  font-weight: bold; ">استمارة الموافقة على تحكيم التقرير النهائي - ترجمة - باللغة الانجليزية</a></li><li style="font-size: 12px; font-family: Tahoma; color: rgb(0, 0, 0); text-align: justify; line-height: 2; "><a href="http://uqu.edu.sa/isr/pdf/%D8%AA%D9%85%D9%88%D8%B0%D8%AC%20%D8%AA%D8%AD%D9%83%D9%8A%D9%85%20%D8%A7%D9%84%D8%AA%D9%82%D8%B1%D9%8A%D8%B1%20%D8%A7%D9%84%D8%AF%D9%88%D8%B1%D9%8A%2017%20-%20%D8%AA%D8%B1%D8%AC%D9%85%D8%A9.doc" target="_blank" class="style4" style="color: rgb(0, 0, 255); font-size: 16px;  font-weight: bold; ">نموذج تحكيم التقرير الدوري 17 - ترجمة - باللغة الاتجليزية</a></li><li style="font-size: 12px; font-family: Tahoma; color: rgb(0, 0, 0); text-align: justify; line-height: 2; "><a href="http://uqu.edu.sa/isr/pdf/%D8%B9%D9%82%D8%AF.doc" target="_blank" class="style4" style="color: rgb(0, 0, 255); font-size: 16px;  font-weight: bold; ">عقد تمويل المشروع البحثي</a></li></ul></div></td></tr></tbody></table><br><p></p></p></p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </article></div>
        </div>
    </body>
</html>


<?
$smarty->display('../templates/footer.tpl');
?>