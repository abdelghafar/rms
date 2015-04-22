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
$smarty->assign('research_projects_php', 'Researchers/Researchers_View.php');
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
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="common/css/reigster-layout.css" type="text/css"/>

    </head>
    <body>
    <center>


        <fieldset style="width: 95%;text-align: right;">
            <legend>
                <label>
                    النماذج و الاستمارات
                </label>
            </legend>
            <div class="panel_row" style="padding-right: 50px; text-align: right">
                <ul>
                    <li style="text-align: right !important">
                        <a href="forms/Arabic_Summary.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color: blue">
                            الملخص العربي/ Arabic summary
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/English_Summary.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color:blue ">
                            الملخص الإنجليزي/ English summary
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/Introduction.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color: blue">
                            المقدمة / Introduction
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/Literature_Review.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color: blue">
                            البحث الآدبي / literature review
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/Research_Methodology.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color: blue">
                            منهجية البحث / Research Methodology
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/Value_to_Kingdom.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color: blue">
                            قيمة المشروع للمملكة / Value To Kingdom
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/References.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color: blue">
                            المراجع العلمية/ References
                        </a>
                    </li>
                    <br>
                    <li style="text-align: right !important">
                        <a href="forms/CV.docx" target="_blank" style="font-size: 16;font-weight: bold;color: blue">
                            السيرة الذاتية / CV
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/CO-I Consent Letter.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color: blue">
                            خطاب موافقة الباحث المشارك/ CO-I consent letter
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/Consultant_Consent_Letter.docx" target="_blank"
                           style="font-size: 16;font-weight: bold;color: blue">
                            خطاب موافقة المستشار/ Consultant consent letter
                        </a>
                    </li>
                </ul>
            </div>
        </fieldset>
    </center>
    </body>


    </html>
<?
$smarty->display('../templates/footer.tpl');
?>