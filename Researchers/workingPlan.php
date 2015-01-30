<?
session_start();
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">';
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Researcher') {
        header('Location:../Login.php');
    }
}
require_once '../lib/Smarty/libs/Smarty.class.php';
require_once('../lib/CenterResearch.php');
require_once '../lib/research_Authors.php';
require_once '../lib/users.php';
$smarty = new Smarty();

$smarty->assign('style_css', '../style.css');
$smarty->assign('style_responsive_css', '../style.responsive.css');
$smarty->assign('jquery_js', '../jquery.js');
$smarty->assign('script_js', '../script.js');
$smarty->assign('script_responsive_js', '../script.responsive.js');
$smarty->assign('index_php', '../index.php');
$smarty->assign('Researchers_register_php', '../Researchers/register.php');
$smarty->assign('login_php', '../login.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');
$smarty->display('../templates/Loggedin.tpl');

require_once '../lib/Reseaches.php';
$users = new Users();
$userId = $_SESSION['User_Id'];
$personId = $users->GetPerosnId($userId, 'Researcher');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>خطة العمل</title>
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />

        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>

        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <Script type="text/javascript">
            $('#datatables').dataTable({
                sPaginationType: "full_numbers",
                bJQueryUI: true,
                bLengthChange: true,
                width: 400,
                oLanguage: {
                    sUrl: "../js/dataTables/media/ar_Ar.txt"}
            });
        </script>
    </head>
    <body>
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    الباحثين المشاركين
                </label>
            </legend>

            <div class="panel_row" style="height: 50px;">
                <div class="panel-cell" style="text-align: left;padding-left: 10px;"> 
                    <p>
                        اختر البحث
                    </p>
                </div>
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;">
                    <form action="inc/co_authors.inc.php" method="post" id="coAuthorsForm"> 

                        <select id="lstOfResearches" name="lstOfResearches" style="width: 200px; height: 25px;">
                            <?
                            $v = new Reseaches();
                            $array = $v->GetListOfResearchPerResearcherId($personId);
                            for ($i = 0; $i < count($array['PairValues']); $i++) {
                                print '<option value="' . $array['PairValues'][$i][0] . '">' . $array['PairValues'][$i][1] . '</option>';
                            }
                            ?>
                        </select>

                    </form>
                </div>
            </div>
            <a href="#" style="font-size:16px;font-weight: bold;" onclick="Display_AddCoAuthor();">اضافة باحث</a>
            <div id="Result">

            </div>
        </fieldset>
    </body>
</html>
