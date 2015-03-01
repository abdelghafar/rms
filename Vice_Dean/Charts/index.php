<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean') {
        header('Location:../../Login.php');
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
        <link rel="stylesheet" href="../../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../../js/jqwidgets/jqwidgets/styles/jqx.summer.css" type="text/css" />
        <script type="text/javascript" src="../../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/scripts/demos.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/jqwidgets/jqxchart.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../../js/jqwidgets/jqwidgets/jqxdata.js"></script>

        <script type="text/javascript" src="../../js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <link rel="stylesheet" href="../../js/fancyBox/source/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="../../js/fancyBox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $(".fancybox").fancybox();
            });
        </script>
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

            <div class="panel_row" style="padding-right:50px;padding-top: 50px; height: 30px;">
                <div class="panel-cell" style="width: 300px;">
                    <a class="fancybox fancybox.iframe" href="ResearchesCountByGenderAndCenter.php" style="font-size: 16px;font-weight: bold;">
                        عدد المشروعات البحثية المقدمة الذكور / الاناث
                    </a>
                </div>
            </div>
            <div class="panel_row" style="padding-right:50px;padding-top: 50px; height: 30px;">
                <div class="panel-cell" style="width: 300px;">
                    <a class="fancybox fancybox.iframe" href="ResearchPercentageByGender.php" style="font-size: 16px;font-weight: bold;">
                        نسبة المشروعات البحثية الذكور/الاناث
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