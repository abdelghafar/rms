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
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');
$smarty->display('../templates/Loggedin.tpl');
require_once '../lib/Reseaches.php';
$users = new Users();
$userId = $_SESSION['User_Id'];
$personId = $users->GetPerosnId($userId, 'Researcher');
if (isset($_GET['q'])) {
    $projectId = $_GET['q'];
} else {
    exit();
}
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>أهداف المشروع</title>
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css"
              href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>

        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxfileupload.js"></script>
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
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
        <script type="text/javascript">
            function Display_New() {
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 450, width: 650, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load("AddObjective.php?rcode=" + '<?php echo $projectId; ?>');
                    $('#window').jqxWindow('setTitle', 'اضافة اهداف المشروع');
                    $('#window').jqxWindow('open');
                });
            }

            function Delete(seq_id) {
                if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true) {
                    $.ajax({
                        type: 'post',
                        url: 'inc/DelObjectives.inc.php?seq_id=' + seq_id,
                        datatype: "html",
                        success: function (data) {
                            var valueSelected = $('#lstOfResearches').val();
                            $.ajax({
                                url: "inc/Objectivies.inc.php?research_id=" + valueSelected,
                                type: "post",
                                datatype: "html",
                                data: $("#Form").serialize(),
                                success: function (data) {
                                    $('#Result').html(data);
                                }
                            });
                        }
                    });
                }
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $.ajax({
                    type: 'post',
                    url: 'inc/Objectivies.inc.php?pid=' + '<? echo $_GET['q']; ?>',
                    datatype: "html",
                    success: function (data) {
                        $.ajax({
                            url: "inc/Objectivies.inc.php?pid=" + '<? echo $_GET['q']; ?>',
                            type: "post",
                            datatype: "html",
                            data: $("#Form").serialize(),
                            success: function (data) {
                                $('#Result').html(data);
                            }
                        });
                    }
                });
            });

        </script>
    </head>
    <body>
    <div id="window" style="visibility: hidden;">
        <div id="windowHeader">
        </div>
        <div id="windowContent" style="overflow: auto;"></div>
    </div>
    <fieldset style="width: 95%;text-align: right;">

        <legend>
            <label>
                أهداف المشروع
            </label>
        </legend>
        <form id='Form' method="post">
            <input type="hidden" name="pid" value="<?
            if (isset($_GET['q'])) {
                echo $projectId;
            }
            ?>"/>
        </form>
        <a href="#" style="font-size:16px;font-weight: bold;" onclick="Display_New();">اضافة جديد</a>

        <div id="Result">

        </div>

    </fieldset>
    <label>

    </label>

    </body>
<?
$smarty->display('../templates/footer.tpl');
