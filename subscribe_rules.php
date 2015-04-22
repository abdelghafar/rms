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
//$smarty->display('templates/header.tpl');
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
                    شروط التقديم للمشروعات البحثية
                </label>
            </legend>
            <div class="panel_row" style="padding-right: 50px; text-align: right">
                <ul>
                    <li style="text-align: right !important">
                        <a href="forms/Raaed_Conditions.pdf" target="_blank"
                           style="font-size: 16;font-weight: bold;color: #006600">
                            برنامج رائد/ Raaed program
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/Baheth_Conditions.pdf" target="_blank"
                           style="font-size: 16;font-weight: bold;color:royalblue ">
                            برنامج باحث / Baheth program
                        </a>
                    </li>
                    <li style="text-align: right !important">
                        <a href="forms/Waeda_Conditions.pdf" target="_blank"
                           style="font-size: 16;font-weight: bold;color: violet">
                            برنامج واعدة / Waeda program
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