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
    <title>التخصصات الدقيقة</title>
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
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
    <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>

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
        });
    </script>
    <script type="text/javascript">
        function Display_New()
        {
            $(document).ready(function () {
                var valueSelected = $('#track').val();
                $('#window').css('visibility', 'visible');
                $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 400, width: 650, autoOpen: false, isModal: true, animationType: 'fade'});
                $('#windowContent').load("AddEditSubtrack.php?action=insert&track_id=" + valueSelected);
                $('#window').jqxWindow('setTitle', 'اضافة التخصص الدقيق');
                $('#window').jqxWindow('open');
            });
        }

        function Display_Edit(seq_id)
        {
            $(document).ready(function () {
                $('#window').css('visibility', 'visible');
                $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 400, width: 650, autoOpen: false, isModal: true, animationType: 'fade'});
                $('#windowContent').load("AddEditSubtrack.php?action=edit&subtrack_id=" + seq_id);
                $('#window').jqxWindow('setTitle', 'تعديل التخصص الدقيق');
                $('#window').jqxWindow('open');
            });
        }

        function Delete(seq_id)
        {
            if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
            {
                var valueSelected = $('#track').val();
                $.ajax({
                    type: 'post',
                    url: 'inc/DelSubtrack.inc.php?seq_id=' + seq_id,
                    datatype: "html",
                    success: function (data) {
                        $.ajax({
                            url: "inc/subtracks.inc.php?track_id=" + valueSelected,
                            type: "post",
                            datatype: "html",
                            data: $("#Form").serialize(),
                            success: function (data) {
                                $('#Result').html(data);
                                $('#loading-image').hide();
                            }, beforeSend: function () {
                                $("#loading-image").show();
                            }
                        });
                    }
                });
            }
        }

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var valueSelected = $('#track').val();
            $.ajax({
                url: "inc/subtracks.inc.php?track_id=" + valueSelected,
                type: "post",
                datatype: "html",
                data: $("#Form").serialize(),
                success: function (data) {
                    $('#loading-image').hide();
                    $('#Result').html(data);
                },
                beforeSend: function () {
                    $("#loading-image").show();
                }
            });
            $('#track').on('change', function () {
                valueSelected = $('#track').val();
                $.ajax({
                    url: "inc/subtracks.inc.php?track_id=" + valueSelected,
                    type: "post",
                    datatype: "html",
                    data: $("#Form").serialize(),
                    success: function (data) {
                        $('#loading-image').hide();
                        $('#Result').html(data);
                    },
                    beforeSend: function () {
                        $("#loading-image").show();
                    }
                });

            });

            $('#window').on('close', function (event) {
                $.ajax({
                    url: "inc/subtracks.inc.php?track_id=" + valueSelected,
                    type: "post",
                    datatype: "html",
                    data: $("#Form").serialize(),
                    success: function (data) {
                        $('#loading-image').hide();
                        $('#Result').html(data);
                    }, beforeSend: function () {
                        $("#loading-image").show();
                    }
                });
            });

            //--------------------------------------------------------------------
            var ResearchCenterDataSource = {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'title'}
                ],
                url: '../Data/technologies.php'
            };
            var TracksDataSource = null;
            var dataAdapter = new $.jqx.dataAdapter(ResearchCenterDataSource);
            $("#technologies").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '300px', height: '30px', displayMember: 'title', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر الاولوية"});
            $('#technologies').on('change', function (event)
            {
                var args = event.args;
                if (args) {
                    // index represents the item's index.                      
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    $('#technologiesVal').val(value);
                    //alert('centers is:' + $("#technologies").val());
                    TracksDataSource = {
                        datatype: "json",
                        datafields: [
                            {name: 'track_id'},
                            {name: 'track_name'}
                        ],
                        url: '../Data/tracks.php?tech_id=' + $("#technologies").val()
                    };
                    dataAdapter = new $.jqx.dataAdapter(TracksDataSource);
                    $("#track").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '300px', height: '30px', displayMember: 'track_name', valueMember: 'track_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص العام"});
                }
            });
            dataAdapter = new $.jqx.dataAdapter(TracksDataSource);
            $("#track").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '300px', height: '30px', displayMember: 'track_name', valueMember: 'track_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص العام"});
            //----------------------------------------------------------------------------
            $('#track').on('change', function (event)
            {
                var args = event.args;
                if (args) {
                    // index represents the item's index.                      
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    //alert($('#track').val());
                    $('#trackVal').val($('#track').val());
                }
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
                التخصصات الدقيقة
            </label>
        </legend>
        <form action="inc/subtracks.inc.php" method="post" id="Form"> 
            <table style="width: 450px;border-width: 0;">
                <tr>
                    <td>
                        <p>
                            أولوية البحث
                        </p>
                    </td>
                    <td>
                        <div id="technologies"></div>
                        <input type="hidden" name="technologiesVal" id="technologiesVal"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            التخصص  العام
                        </p>
                    </td>
                    <td>
                        <div id="track"></div>
                        <input type="hidden" name="trackVal" id="trackVal"/>
                    </td>
                </tr>
            </table>
            <div id="loading-image">
                <img src="../common/images/ajax-loader.gif" width="16" height="16" alt="Loading"/>
            </div>
            <div id="Result">

            </div>
        </form>
    </fieldset>
<label>
    <a href="index.php" style="float: left;margin-left: 25px;margin-top: 20px;">
        رجوع
    </a>
</label>

</body>
<?
$smarty->display('../templates/footer.tpl');
