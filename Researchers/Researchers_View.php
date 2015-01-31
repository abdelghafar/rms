<?php
session_start();
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

$c_researches = new CenterResearch();
$user = new Users();
$personId = $user->GetPerosnId($_SESSION['User_Id'], 'Researcher');

$rs = $c_researches->GetResearchesByResearcher($personId);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <script type="text/javascript">
            $(document).ready(function () {
                $('#datatables').dataTable({
                    sPaginationType: "full_numbers",
                    bJQueryUI: true,
                    bLengthChange: true,
                    width: 600,
                    oLanguage: {
                        sUrl: "../js/dataTables/media/ar_Ar.txt"}
                });
            });
        </script>
        <script type="text/javascript">
            function display_research_status(research_id, research_code)
            {
                window.showModalDialog("research_status_details_View.php?research_id=" + research_id + "&research_code=" + research_code, 'PopupPage', 'dialogHeight:450px; dialogWidth:850px; resizable:0');
            }
            function WithDraw(ResearchId)
            {
                if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
                {
                    $.ajax({
                        type: 'post',
                        url: 'inc/WithDraw.inc.php?ResearchId=' + ResearchId,
                        datatype: "html",
                        success: function (data) {
                            location.reload();
                        }
                    });
                }
            }
            function display_research_Edit(research_id, research_code)
            {
                window.showModalDialog("ResearchEdit.php?research_id=" + research_id + "&research_code=" + research_code, 'PopupPage', 'dialogHeight:450px; dialogWidth:900px; resizable:0');
                location.reload();
            }


        </script>
        <title></title>
    </head>
    <body style="background-color: #ededed;">
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?
                    echo 'مرحبا ' . $_SESSION['User_Name'];
                    ?>
                </label>
            </legend>
            <table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold" dir="rtl" >
                <thead>
                    <tr>
                        <th><em>م</em></th>
                        <th>عنوان المشروع - عربى </th>
                        <th>عنوان المشروع - انجليزى</th>
                        <th>
                            التخصص العام
                        </th>

                        <th>سنة التقدم</th>
                        <th>حالة البحث</th>
                        <th>متابعة الحالة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
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
                                ?></td>
                            <td style=" text-align: right"><? echo $row['title_ar']; ?></td>
                            <td style=" text-align: left"><? echo $row['title_en']; ?></td>
                            <td style=" text-align: left"><? echo $row['center_name']; ?></td>
                            <td><? echo $row['research_year']; ?></td>
                            <td style=" text-align: center;"><? echo $row['Status_name']; ?></td>
                            <td style=" text-align: center;"><a href="#" onClick="display_research_status(<? echo $row['seq_id'] . ",'" . $row['research_code'] . "'"; ?>);"><img src="images/track.png" style="border:none !important" alt="متابعة الحالة"/></a></td>

                            <td style=" text-align: center;"><a href="#" onClick="display_research_Edit(<? echo $row['seq_id'] . ",'" . $row['research_code'] . "'"; ?>);"><img src="images/edit.png" style="border:none !important" alt="تعديل"/></a></td>
                            <td style=" text-align: center;"><a href="#" onClick="WithDraw(<? echo $row['seq_id']; ?>);"><img src="images/delete.png" style="border:none !important" alt="حذف"/></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </fieldset>
    <label>
        <a href="index.php?program=<? echo $_SESSION['program'] ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
            رجوع
        </a></label>

</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
