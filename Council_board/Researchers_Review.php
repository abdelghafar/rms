<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Council_board') {
        header('Location:../Login.php');
    }
}

require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/users.php';
require_once '../lib/research_review.php';
require_once '../lib/Council_board.php';

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
?>
<?
$user = new Users();
$personId = $user->GetPerosnId($_SESSION['User_Id'], 'Council_board');
$obj = new Council_board();
$rs = $obj->GetCouncilBoardLstOfResearches($personId);
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

        <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/> 
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
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
            function display_Research_details(research_code)
            {
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 450, width: 900, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load("Research_details.php?research_code=" + research_code);
                    $('#window').jqxWindow('setTitle', 'تفاصيل البحث');
                    $('#window').jqxWindow('open');
                });
                $('#window').on('close', function (event) {
                    location.reload();
                });
            }
            function display_Research_Review(research_id, research_code)
            {
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 600, width: 950, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load("change_research_status.php?research_id=" + research_id + "&research_code=" + research_code);
                    $('#window').jqxWindow('setTitle', 'التحكيم');
                    $('#window').jqxWindow('open');
                });
                $('#window').on('close', function (event) {
                    location.reload();
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
                    echo 'مرحبا ' . $_SESSION['User_Name'];
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
                            <th>ت.الارسال</th>
                            <th>التفاصيل</th>
                            <th>التحكيم</th>
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
                                <td style=" text-align: right"><? echo $row['title_ar']; ?></td>
                                <td style=" text-align: left"><? echo $row['title_en']; ?></td>
                                <td style=" text-align: center"><? echo $row['submission_date']; ?></td>
                                <td style=" text-align: center"><a href="#" onClick="display_Research_details(<? echo $row['research_code'] ?>);"><img src="images/edit.png" style="border:none !important" alt="تعديل"/></a></td>
                                <td style=" text-align: center"><a href="#" onClick="display_Research_Review(<? echo $row['research_id']; ?>,<? echo $row['research_code'] ?>);"><img src="images/review.png" style="border:none !important" alt="تعديل"/></a></td>
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