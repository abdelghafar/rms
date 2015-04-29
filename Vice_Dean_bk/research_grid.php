<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean')
        header('Location:../Login.php');
}

require_once '../lib/Smarty/libs/Smarty.class.php';
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
require_once '../lib/CenterResearch.php';
$c = new CenterResearch();
$rs = $c->GetResearchesList();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="../js/jquery-ui/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/> 
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatables').dataTable({
                    sPaginationType: "full_numbers",
                    bJQueryUI: true,
                    bLengthChange: true,
                    width: 800,
                    oLanguage: {
                        sUrl: "../js/dataTables/media/ar_Ar.txt"}
                });
            });

        </script>
        <script type="text/javascript">
            function display_research_status(research_code)
            {
                window.showModalDialog("research_status_details_View.php?research_code=" + research_code, "name", "dialogWidth:620px;dialogHeight:300px");
                location.reload();
            }
            function display_Research_details(research_id)
            {
                window.showModalDialog("Research_details.php?research_id=" + research_id, 'PopupPage', 'dialogHeight:500px; dialogWidth:850px; resizable:0');
                location.reload();
            }
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
            <div class="art-layout-cell layout-item-1" style="width: 950px" >

                <table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold" dir="rtl" >
                    <thead>
                        <tr>
                            <th><em>م</em></th>
                            <th>رقم البحث</th>
                            <th>عنوان المشروع </th>
                            <th>الباحث الرئيسي</th>
                            <th>المركز البحثي</th>
                            <th>سنة التقدم</th>
                            <th>حالة البحث</th> 
                            <th>متابعة الحالة</th>
                            <th>التفاصيل</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $x = 1;
                        while ($row = mysql_fetch_array($rs)) {
                            ?>
                            <tr>
                                <td><?
                                    echo $x;
                                    $x++; //$row['id']; 
                                    ?></td>
                                <td><? echo $row['research_code']; ?></td>
                                <td style=" text-align: right;"><? echo $row['title_ar']; ?></td>
                                <td style=" text-align: right;"><? echo $row['name']; ?></td>
                                <td>
                                    <?php
                                    echo $row['center_name'];
                                    ?>
                                </td>
                                <td><? echo $row['research_year']; ?></td>

                                <td><? echo $row['Status_name']; ?></td>

                                <td style="text-align: center;"><a href="#" onClick="display_research_status(<? echo $row['research_code']; ?>);"><img src="images/track.png" style="border:none !important" alt="حذف"/></a></td>
                                <td style="text-align: center;"><a href="#" onClick="display_Research_details(<? echo $row['seq_id'] . ",'" . $row['research_code'] . "'"; ?>);"><img src="images/details.png" style="border:none !important" alt="تعديل"/></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </fieldset>
        <label>
            <a href="index.php" style="float: left;margin-left: 25px;margin-top: 20px;">
                رجوع
            </a></label>
    </center>
</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>