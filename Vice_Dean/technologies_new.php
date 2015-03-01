<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean') {
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
if (isset($_GET['seq_id'])) {
    require_once '../lib/technologies.php';
    $t = new Technologies();
    $obj = $t->GetTechnologies($seq_id);
    $seq_id = $_GET['seq_id'];
    $title = null;
    $tech_desc = null;
    $isVisible = null;
    while ($row = mysql_fetch_array($obj)) {
        $seq_id = $row['seq_id'];
        $title = $row['title'];
        $tech_desc = $row['tech_desc'];
        $isVisible = $row['isVisible'];
    }
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>أولويات البحث</title>
    <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
    <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />

    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>

    <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/> 
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
        });</script>
    <script type="text/javascript">

        function Clear()
        {
            $(document).ready(function () {
                $('#Title').val('');
                $('#Desc').val('');
            });
        }
        function Display_Edit(seq_id)
        {
            alert(seq_id);
            $('#frmTable').load();
        }
        function Delete(seq_id)
        {
            if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
            {
                $.ajax({
                    type: 'post',
                    url: 'inc/DelTechnologies.inc.php?seq_id=' + seq_id,
                    datatype: "html",
                    success: function (data) {
                        $.ajax({
                            url: "inc/technologies.inc.php",
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
                url: "inc/technologies.inc.php",
                type: "post",
                datatype: "html",
                data: $("#Form").serialize(),
                success: function (data) {
                    $('#Result').html(data);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var theme = "energyblue";
            $("#Title").jqxInput({width: '400', height: '30', theme: theme, rtl: true});
            $("#Desc").jqxInput({width: '400', height: '100', theme: theme, rtl: true});
            $("#sendButton").jqxButton({width: '50', height: '30', theme: theme});
            $('#closeButton').jqxButton({width: '50', height: '30', theme: theme});
            $('#sendButton').click(function () {
                $.ajax({
                    url: "inc/post.inc.php",
                    type: "post",
                    datatype: "html",
                    data: $("#AddEditTechFrm").serialize(),
                    success: function (data) {
                        $('#q').html(data);
                    }
                });
                Clear();
                $.ajax({
                    url: "inc/technologies.inc.php",
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
        <div id="windowContent" style="overflow: auto;" >
            <input type="button" id="cancel" value="Cancel" />
        </div>
    </div>
    <fieldset style="width: 95%;text-align: right;"> 
        <legend>
            <label>
                أولويات البحث
            </label>
        </legend>
        <form id="AddEditTechFrm" action="#" method="post">
            <input type="hidden" name="seq_id" value="<? echo $seq_id; ?>"/>
            <table style="border: none; width: 600px;display: block;" id="frmTable" >
                <tr>
                    <td style="padding-right: 10px;">
                        <span class="classic">
                            العنوان
                            <span class="required">*</span>
                        </span>
                    </td>
                    <td>
                        <input type="text" id="Title" name="Title" value="<?
                        if ($seq_id > 0) {
                            echo $title;
                        }
                        ?>"/>
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">
                        <span class="classic">
                            التفاصيل
                        </span>
                    </td>
                    <td>
                        <textarea id="Desc" name="Desc" rows="4" cols="20">
                            <?
                            if ($seq_id > 0) {
                                echo $tech_desc;
                            }
                            ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">
                        <span class="classic">
                            اظهار/اخفاء
                        </span>
                    </td>
                    <td>
                        <input type="checkbox" name="chkIsVisible" value="1" <?
                        if ($isVisible == 1) {
                            echo 'checked="checked"';
                        }
                        ?> />
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <input type="button" value="حفظ" id='sendButton' />
                        <input type="button" value="مسح" id='closeButton' onclick="Clear();" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="q" style="height: 30px;"></div>
                    </td>
                </tr>

            </table>
        </form>
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
