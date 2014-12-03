<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
   header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Reseach_Center') {
        header('Location:../Login.php');
    }
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

require_once('../lib/CenterResearch.php');

$c_researches = new CenterResearch();
$center_id = $c_researches->GetResearchCenterByUserName($_SESSION['User_Name']);

$rs = $c_researches->AllCenterResearch($center_id);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
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
        <script type="text/javascript">
            $(document).ready(function () {
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

            function display_Assign_council_board(research_id, research_code)
            {
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 550, width: 850, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load('Assign_council_board.php' + "?research_id=" + research_id + "&research_code=" + research_code);
                    $('#window').jqxWindow('setTitle', 'اضافة الفاحص المبدئي');
                    $('#window').jqxWindow('open');
                });
            }
            function display_Assign_Reviewer(research_id, research_code)
            {
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 550, width: 850, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load('Assign_Reviewer.php' + "?research_id=" + research_id + "&research_code=" + research_code);
                    $('#window').jqxWindow('setTitle', 'اضافة المحكمين');
                    $('#window').jqxWindow('open');
                });
            }
            function display_research_status(research_id, research_code)
            {
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 550, width: 850, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load('research_status_details_View.php' + "?research_id=" + research_id + "&research_code=" + research_code);
                    $('#window').jqxWindow('setTitle', 'متابعة حالة البحث');
                    $('#window').jqxWindow('open');
                });
            }
            function display_Research_details(research_id)
            {
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 550, width: 850, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load('Research_details.php' + "?research_id=" + research_id);
                    $('#window').jqxWindow('setTitle', 'تفاصيل البحث');
                    $('#window').jqxWindow('open');
                });
            }

        </script>

    </head>
    <body>
    <center>
        <div id="window" style="visibility: hidden;">
            <div id="windowHeader">
            </div>
            <div id="windowContent" style="overflow: auto;" ></div>
        </div>

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
                            <th>عنوان المشروع - عربى </th>
                            <th>عنوان المشروع - انجليزى</th>
                            <th>سنة التقدم</th>
                            <th>حالة البحث</th>
                            <th>الفرز المبدئي</th>
                            <th>التحكيم</th>
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
                                    $x++;
                                    ?>
                                </td>
                                <td> <?php
                                    $code = $row['research_code'];
                                    $link = '<a href="researches.php?id=' . base64_encode($row['seq_id']) . '">' . $code . '</a>';
                                    echo $link;
                                    ?>
                                </td>
                                <td style=" text-align: right">
                                    <?php
                                    echo $row['title_ar'];
                                    ?>
                                </td>
                                <td style=" text-align: left"><? echo $row['title_en']; ?></td>
                                <td><? echo $row['research_year']; ?></td>

                                <td><? echo $row['Status_name']; ?></td>
                                <td style="text-align: center;
                                    "><a href="#" onClick="display_Assign_council_board(<?php echo $row['seq_id'] . "," . $row['research_code'] ?>);">
                                        <img src="images/edit.png" style="border:none !important" alt="الفرز المبدئي"/></a>
                                </td>
                                <td>
                                    <a href="#" onClick="display_Assign_Reviewer(<? echo $row['seq_id'] . "," . $row['research_code'] ?>);"><img src="images/edit.png" style="border:none !important" alt="تحكيم"/></a>
                                </td>
                                <td>
                                    <a href="#" onClick="display_research_status(<? echo $row['seq_id'] . ",'" . $row['research_code'] . "'"; ?>);"><img src="../common/images/research-track.png" style="border:none !important" alt="تعديل"/></a>
                                </td>

                                <td>
                                    <a href="#" onClick="display_Research_details(<? echo $row['seq_id']; ?>)
                                                    ;"><img src="../common/images/view-list-details.png" style="border:none !important" alt="حذف"/></a>

                                </td>
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