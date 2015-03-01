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
$smarty->assign('contactus_php', 'contactus.php');

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
    <center>
        <p><span style="font-weight: bold; font-size: 16px;">
                للاستفسار او المزيد من المعلومات 
            </span></p><p><span style="font-weight: bold; font-size: 16px;">يرجى الاتصال على</span></p>
        <div class="panel_row" style="height: 50px;">
            <div class="panel-cell">

                <p style="margin-top: 0px;">
                    مساعد أمين المجلس
                </p>

            </div>
            <div class="panel-cell">

                <p style="margin-right: 30px;">
                    4984 
                </p>

            </div>
        </div>
        <div class="panel_row" style="height: 50px;">
            <div class="panel-cell">

                <p style="margin-top: 0px;">
                    سكرتارية   أمانة المجلس
                </p>

            </div>
            <div class="panel-cell">

                <p style="margin-right: 19px;">
                    4923 
                </p>

            </div>
        </div>

        <div class="panel_row" style="height: 50px;">
            <div class="panel-cell">

                <p style="margin-top: 0px;">
                    الدعم الفني
                </p>

            </div>
            <div class="panel-cell">

                <p style="margin-right: 85px;">
                    5145 
                </p>

            </div>
        </div>
        <div class="panel_row" style="height: 50px;">
            <div class="panel-cell">

                <p style="margin-top: 0px;">
                    سنترال الجامعة(العابدية)
                </p>

            </div>
            <div class="panel-cell">

                <p style="margin-right: 60px;">
                    012-5270000  
                </p>

            </div>
        </div>
        <p><span style="font-weight: bold; font-size: 16px;">أو على البريد اليكتروني:&nbsp;</span></p><p><a href="mailto:isr@uqu.edu.sa" style="font-size: 16px; ">isr@uqu.edu.sa</a><span style="font-weight: bold;"></span></p>
        <p><span style="font-weight: bold; font-size: 16px;">معهد البحوث العلمية وإحياء التراث الإسلامي</span></p><p><span style="font-weight: bold; font-size: 16px;">جامعة أم القرى، مكة المكرمة، ص ب (715)</span></p><p><br></p><p><a href="mailto:email@domain.com"></a></p>
    </center>
</body>
</html>


<?
$smarty->display('../templates/footer.tpl');
?>