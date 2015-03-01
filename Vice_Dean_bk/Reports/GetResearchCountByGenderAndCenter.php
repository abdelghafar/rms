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

$smarty->assign('title', 'عدد المشروعات البحثية ذكور/الاناث');
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

require_once '../../Reports/inc/GetResearchCountByCenterAndGenderFn.php';
$rs = GetResearchCountByCenterAndGenderFn(1435);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="../../js/jquery-ui/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/print.js"></script>
        <script src="../../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/dataTables/media/js/ZeroClipboard.js" type="text/javascript"></script>
        <script src="../../js/dataTables/media/js/dataTables.tableTools.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css" >
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/demo_table_jui.css" >
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/dataTables.tableTools.css" >
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css" >
        <link rel="stylesheet" href="../../common/css/reigster-layout.css" type="text/css" /> 
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatables').dataTable({
                    sPaginationType: "full_numbers",
                    bJQueryUI: true,
                    iDisplayLength: 25,
                    width: 800,
                    sDom: '<"H"Tf">t<"F"ip>',
                    oTableTools: {
                        sSwfPath: "../../js/dataTables/media/swf/copy_csv_xls_pdf.swf",
                        aButtons: ["copy", "xls", "print"]
                    },
                    oLanguage: {
                        sUrl: "../../js/dataTables/media/ar_Ar.txt"}
                });
            });

        </script>

    </head>
    <body>
    <center>
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?php
                    echo 'مرحبا ' . $_SESSION['Alias_Name'];
                    ?>
                </label>
            </legend>
            <table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold" dir="rtl" >
                <thead>
                    <tr>
                        <th><em>م</em></th>
                        <th>المركز البحثي</th>
                        <th>الذكور</th>
                        <th>الاناث</th>
                        <th>الاجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $x = 1;
                    foreach ($rs as $row) {
                        ?>
                        <tr>
                            <td>
                                <?
                                echo $x;
                                $x++;
                                ?>
                            </td>
                            <td><? echo $row['center_name']; ?></td>
                            <td style=" text-align: center;"><? echo $row['male_rcount']; ?></td>
                            <td style=" text-align: center;"><? echo $row['female_rcount']; ?></td>
                            <td style=" text-align: center;"><? echo $row['male_rcount'] + $row['female_rcount']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align:center">#</th>
                        <th style="text-align:right">
                            <label>
                                الاجمــــــــــالي
                            </label>
                        </th>
                        <th style="text-align:center"><? echo $row['male_total_count']; ?></th>
                        <th style="text-align:center"><? echo $row['female_total_count']; ?></th>
                        <th style="text-align:center"><? echo $row['female_total_count'] + $row['male_total_count']; ?></th>
                    </tr>
                </tfoot>
            </table>
        </fieldset>
        <label>
            <a href="index.php" style="float: left;margin-left: 25px;margin-top: 20px;">
                رجوع
            </a></label>
    </center>
</body>
</html>
<?
$smarty->display('../../templates/footer.tpl');
?>