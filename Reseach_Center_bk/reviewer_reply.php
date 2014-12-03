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
$rs = $c_researches->GetLstOfResearchReviwers($center_id);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <script type="text/javascript">
            function Display_AddReviewerReply(seqId, research_code)
            {
                window.showModalDialog("AddReviewerReply.php?seqId=" + seqId + "&researchCode=" + research_code, 'PopupPage', 'dialogHeight:350px; dialogWidth:730px; resizable:0');
                location.reload();
            }
            function update_research_status(research_id, research_code)
            {
                window.showModalDialog("change_research_status.php?research_id=" + research_id + "&research_code=" + research_code, 'PopupPage', "dialogWidth:780px;dialogHeight:350px");
                location.reload();
            }
        </script>
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
        <title></title>
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

                            <th>اسم المحكم</th>
                            <th>
                                ت.الارسال
                            </th>
                            <th>م. التحكيم</th>
                            <th>رد المحكم</th>
                            <th>
                                ت.الرد
                            </th>
                            <th>
                                ملاحظات
                            </th>
                            <th>
                                تحميل
                            </th>
                            <th> تعديل الحالة</th>
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

                                <td><? echo $row['reveiwer_name']; ?></td>
                                <td><? echo $row['submission_date']; ?></td>
                                <td style=" text-align:center;">
                                    <? echo $row['Phase_Title']; ?>
                                </td>
                                <td style=" text-align:right;"><? echo $row['Status_name']; ?></td>
                                <td><? echo $row['responce_date']; ?></td>

                                <td><? echo $row['notes']; ?></td>
                                <td style=" text-align:center;padding: 0px;">
                                    <a href="<?
                                    if (strlen($row['attachment_url']) > 0)
                                        echo '../' . $row['attachment_url'];
                                    else
                                        echo '#';
                                    ?>">
                                        <img style="border: 0;" src="../common/images/download.png"/>
                                    </a>

                                </td>
                                <td style=" text-align: center;"><a href="#" onClick="update_research_status(<? echo $row['seq_id'] . ",'" . $row['research_code'] . "'"; ?>);"><img src="images/edit.png" style="border:none !important" alt="تعديل"/></a></td>
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