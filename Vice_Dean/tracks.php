<?
session_start();
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">';
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean') {
        header('Location:../Login.php');
    }
}
require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/technologies.php';
require_once '../lib/Tracks.php';
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
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>التخصصات العامة</title>
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
    <script type="text/javascript">
        function Display_New()
        {
            $(document).ready(function () {
                var valueSelected = $('#lstOfTech').val();
                $('#window').css('visibility', 'visible');
                $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 400, width: 650, autoOpen: false, isModal: true, animationType: 'fade'});
                $('#windowContent').load("AddEditTrack.php?action=insert&tech_id=" + valueSelected);
                $('#window').jqxWindow('setTitle', 'اضافة التخصص العام');
                $('#window').jqxWindow('open');
            });
        }

        function Display_Edit(seq_id)
        {
            $(document).ready(function () {
                $('#window').css('visibility', 'visible');
                $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 400, width: 650, autoOpen: false, isModal: true, animationType: 'fade'});
                $('#windowContent').load("AddEditTrack.php?action=edit&seq_id=" + seq_id);
                $('#window').jqxWindow('setTitle', 'تعديل التخصص العام');
                $('#window').jqxWindow('open');
            });
        }

        function Delete(seq_id)
        {
            if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
            {
                var valueSelected = $('#lstOfTech').val();
                $.ajax({
                    type: 'post',
                    url: 'inc/DelTrack.inc.php?seq_id=' + seq_id,
                    datatype: "html",
                    success: function (data) {
                        $.ajax({
                            url: "inc/tracks.inc.php?tech_id=" + valueSelected,
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
            var valueSelected = $('#lstOfTech').val();
            $.ajax({
                url: "inc/tracks.inc.php?tech_id=" + valueSelected,
                type: "post",
                datatype: "html",
                data: $("#Form").serialize(),
                success: function (data) {
                    $('#Result').html(data);
                }
            });
            $('#lstOfTech').on('change', function () {
                valueSelected = this.value;
                $.ajax({
                    url: "inc/tracks.inc.php?tech_id=" + valueSelected,
                    type: "post",
                    datatype: "html",
                    data: $("#Form").serialize(),
                    success: function (data) {
                        $('#Result').html(data);
                    }
                });

            });

            $('#window').on('close', function (event) {
                $.ajax({
                    url: "inc/tracks.inc.php?tech_id=" + valueSelected,
                    type: "post",
                    datatype: "html",
                    data: $("#Form").serialize(),
                    success: function (data) {
                        $('#Result').html(data);
                    }
                });
            });

        });

    </script>
</head>
<body>
    <div id="window" style="visibility: hidden;">
        <div id="windowHeader">
        </div>
        <div id="windowContent" style="overflow: auto;" ></div>
    </div>
    <fieldset style="width: 95%;text-align: right;"> 
        <legend>
            <label>
                التخصصات العامة
            </label>
        </legend>
        <div class="panel_row" style="height: 50px;">
            <div class="panel-cell" style="text-align: left;padding-left: 10px;"> 
                <p>
                    اختر اولوية البحث
                </p>
            </div>
            <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;">
                <form action="inc/tracks.inc.php" method="post" id="Form"> 

                    <select id="lstOfTech" name="lstOfTech" style="width: 200px; height: 25px;">
                        <?
                        $v = new Technologies();
                        $array = $v->GetPairValues();
                        for ($i = 0; $i < count($array['PairValues']); $i++) {
                            print '<option value="' . $array['PairValues'][$i][0] . '">' . $array['PairValues'][$i][1] . '</option>';
                        }
                        ?>
                    </select>

                </form>
            </div>
        </div>
        <a href="#" style="font-size:16px;font-weight: bold;" onclick="Display_New();">اضافة جديد</a>
        <div id="Result">

        </div>
    </fieldset>
<label>
    <a href="index.php" style="float: left;margin-left: 25px;margin-top: 20px;">
        رجوع
    </a>
</label>

</body>
<?
$smarty->display('../templates/footer.tpl');
