<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean')
        header('Location:../../Login.php');
}

require_once '../../lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->assign('title', 'تقرير المشروعات البحثية');
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
<?php
require_once '../../lib/CenterResearch.php';
$obj = new CenterResearch();
$centerLst = $obj->GetAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script src="../../js/jquery-ui/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/dataTables/media/js/ZeroClipboard.js" type="text/javascript"></script>
        <script src="../../js/dataTables/Plugins/ColVis/js/dataTables.colVis.js" type="text/javascript"></script>
        <script src="../../js/dataTables/media/js/dataTables.tableTools.js" type="text/javascript"></script>

        <link rel="stylesheet" href="../../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css" >
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/demo_table_jui.css" >
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/dataTables.tableTools.css">
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/Plugins/ColVis/css/dataTables.colvis.jqueryui.css" >
        <link rel="stylesheet" href="../../common/css/reigster-layout.css" type="text/css" /> 
        <script type="text/javascript">
            $(document).ready(function() {
                $("#centerLst").change(function() {
                    var ss = $("#centerLst option:selected").val();
                    var url = "RptGetListOfResearchPerYearAndCenterId.php?type=" + ss;
                    switch (ss)
                    {
                        case '0':
                            url = "RptGetListOfResearchPerYearAndCenterId.php?type=" + ss;
                            break;
                        case 'All':
                            url = "RptGetListOfResearchPerYearAndCenterId.php?type=" + ss;
                            break;
                        default:
                            url:url;
                            break;
                    }
                    $.ajax({
                        url: url,
                        success: function(data) {
                            $('#result').html(data);
                        }
                    });

                });

            });
        </script>
        <title></title>
    </head>
    <body>
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?php
                    echo 'مرحبا ' . $_SESSION['Alias_Name'];
                    ?>
                </label>
            </legend>
            <div class="panel_row">
                <label>
                    من فضلك اختر المركز البحثي
                </label>
                <select name="centerLst" id="centerLst" style="direction: rtl;">
                    <option value="0">من فضلك أختر المركز البحثي</option>
                    <?php
                    while ($row = mysql_fetch_array($centerLst)) {
                        echo '<option value="' . $row['id'] . '">' . $row['center_name'] . '</option>';
                    }
                    ?>
                    <option value="All">عرض الكل</option>
                </select>
            </div>
            <div class="panel_row" style="alignment-adjust: central; ">
                <div id="result" style="width: 900px;min-height:150px;">

                </div>
            </div>
        </fieldset>

        <label>
            <a href="index.php" style="float: left;margin-left: 25px;margin-top: 20px;">
                رجوع
            </a></label>
    </body>
</html>
<?
$smarty->display('../../templates/footer.tpl');
?>