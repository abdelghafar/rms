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
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');
$smarty->display('../templates/Loggedin.tpl');

$c_researches = new CenterResearch();
$user = new Users();
$personId = $user->GetPerosnId($_SESSION['User_Id'], 'Researcher');
$program = $_SESSION[program];
$rs = $c_researches->GetResearchesByResearcherAndProgram($personId, $program);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.columnsresize.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.selection.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.sort.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.edit.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.filter.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmenu.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = 'energyblue';
                $('#AddNew').jqxButton({rtl: true, width: 75, height: '30', theme: theme});
                $('#AddNew').click(function () {
                    window.location.assign('understanding.php?program=<? echo $_SESSION['program']; ?>');
                });
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'seq_id'},
                                {name: 'title_ar'},
                                {name: 'status_date'},
                                {name: 'status_name'}
                            ],
                            id: 'seq_id',
                            url: 'ajax/Researchers_View?id=<? echo $personId; ?>' + '&p=<? echo $program; ?>'
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#jqxgrid").jqxGrid(
                        {
                            source: dataAdapter,
                            theme: theme,
                            editable: false,
                            pageable: true,
                            filterable: true,
                            width: 850,
                            pagesize: 20,
                            autoheight: true,
                            columnsresize: true,
                            sortable: true,
                            rtl: true,
                            columns: [
                                {text: 'seq_id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                                {text: 'العنوان', dataField: 'title_ar', width: 350, align: 'right', cellsalign: 'right'},
                                {text: 'تاريخ التقديم', dataField: 'status_date', width: 100, align: 'right', cellsalign: 'right'},
                                {text: 'الحالة', dataField: 'status_name', width: 250, align: 'center', cellsalign: 'center'},
                                {text: 'الحالة', datafield: 'الحالة', align: 'center', width: 50, columntype: 'button', cellsrenderer: function () {
                                        return 'الحالة';
                                    }, buttonclick: function (row) {
                                        var projectId = $("#jqxgrid").jqxGrid('getrowdata', row)['seq_id'];
                                        display_research_status(projectId);
                                    }
                                },
                                {text: 'تعديل', datafield: 'تعديل', align: 'center', width: 50, columntype: 'button', cellsrenderer: function () {
                                        return 'تعديل';
                                    }, buttonclick: function (row) {
                                        console.log($("#jqxgrid").jqxGrid('getrowdata', row)['seq_id']);
                                        var projectId = $("#jqxgrid").jqxGrid('getrowdata', row)['seq_id'];
                                        window.location.assign('research_submit.php?program=<? echo $program ?>' + '&q=' + projectId);
                                    }
                                },
                                {text: 'حذف', datafield: 'حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function () {
                                        return "..";
                                    }, buttonclick: function (row) {
                                        var projectId = $("#jqxgrid").jqxGrid('getrowdata', row)['seq_id'];
                                        WithDraw(projectId);
                                    }
                                }
                            ]
                        });
            });
        </script>
        <script type="text/javascript">
            function display_research_status(research_id)
            {
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 400, width: 600, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load("research_status_details_View.php?research_id=" + research_id);
                    $('#window').jqxWindow('setTitle', 'حالة البحث');
                    $('#window').jqxWindow('open');
                });
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
                $(document).ready(function () {
                    $('#window').css('visibility', 'visible');
                    $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 450, width: 650, autoOpen: false, isModal: true, animationType: 'fade'});
                    $('#windowContent').load("ResearchEdit.php?research_id=" + research_id + "&research_code=" + research_code);
                    $('#window').jqxWindow('setTitle', 'تفاصيل البحث');
                    $('#window').jqxWindow('open');
                });
            }
        </script>
        <title></title>
    </head>
    <body style="background-color: #ededed;">
        <div id="window" style="visibility: hidden;">
            <div id="windowHeader">
            </div>
            <div id="windowContent" style="overflow: auto;" ></div>
        </div>
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?
                    echo 'مرحبا ' . $_SESSION['User_Name'];
                    ?>
                </label>
            </legend>
            <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: right;margin-top: 10px;margin-right:25px;margin-bottom: 30px;">
                <input type="button" value="إضافة جديد" id='AddNew' style="margin-top: 10px;margin-bottom: 10px;"/>
                <hr/>
                <div id="jqxgrid"></div>
            </div>

        </fieldset>

    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
