<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean') {
        header('Location:../Login.php');
    }
}
require_once '../../lib/Smarty/libs/Smarty.class.php';
require_once('../../lib/CenterResearch.php');
require_once '../../lib/users.php';
$smarty = new Smarty();

$smarty->assign('style_css', '../../style.css');
$smarty->assign('style_responsive_css', '../../style.responsive.css');
$smarty->assign('jquery_js', '../../jquery.js');
$smarty->assign('script_js', '../../script.js');
$smarty->assign('script_responsive_js', '../../script.responsive.js');
$smarty->assign('index_php', '../../index.php');
$smarty->assign('Researchers_register_php', '../../Researchers/register.php');
$smarty->assign('logout_php', '../../inc/logout.inc.php');
$smarty->assign('fqa_php', '../../fqa.php');
$smarty->assign('contactus_php', '../../contactus.php');
$smarty->display('../../templates/Loggedin.tpl');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../../common/css/reigster-layout.css" type="text/css"/>
        <title></title>
    </head>
    <body style="background-color: #ededed;">
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?php
                    echo 'مرحبا ' . $_SESSION['Alias_Name'];
                    ?>
                </label>
            </legend>

            <div class="panel_row" style="padding-right:50px;padding-top: 50px; height: 60px;">
                <div class="panel-cell" style="width: 150px;">
                    <a href="RptGetListOfResearchPerYear.php" style="font-size: 16px;font-weight: bold;">
                        المشروعات البحثية المقدمة
                    </a>
                </div>
            </div>
            <div class="panel_row" style="padding-right:50px; height: 60px;">
                <div class="panel-cell">
                    <a href="RptGetResearchBudgetAndCountCenterId.php" style="font-size: 16px;font-weight: bold;">
                        الميزانية المقترحة للمشروعات المقدمة  
                    </a>
                </div>
            </div>
            <div class="panel_row" style="padding-right:50px; height: 60px;">
                <div class="panel-cell">
                    <a href="GetResearchCountByGenderAndCenter.php" style="font-size: 16px;font-weight: bold;">
                        عدد المشروعات البحثية المقدمة الذكور / الاناث 
                    </a>

                </div>
            </div>
        </fieldset>
        <label>
            <a href="../index.php" style="float: left;margin-left: 25px;margin-top: 20px;">
                رجوع
            </a></label>
    </body>
</html>
<?
$smarty->display('../../templates/footer.tpl');
?>