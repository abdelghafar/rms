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
if (isset($_GET['program'])) {
    require_once '../lib/program.php';
    $t = new program();

    $program_string = filter_input(INPUT_GET, 'program', FILTER_SANITIZE_STRING);
    switch ($program_string) {
        case 'ba7th': {
                $program_id = $t->GetProgramId('ba7th');
                $_SESSION['program'] = $program_id;
                break;
            }
        case 'ra2d': {
                $program_id = $t->GetProgramId('ra2d');
                $_SESSION['program'] = $program_id;
                break;
            }
        case 'wa3da': {
                $program_id = $t->GetProgramId('wa3da');
                $_SESSION['program'] = $program_id;
                break;
            }
        default : {
                header("Location: index.php");
                break;
            }
    }
} else {
    header('Location: selectProgram.php');
}
require_once '../lib/Smarty/libs/Smarty.class.php';
require_once('../lib/CenterResearch.php');
require_once '../lib/users.php';
require_once '../lib/Util.php';
require_once '../lib/Reseaches.php';
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
$project = new Reseaches();
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
        <script src="../js/php.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <link href="../js/font/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = 'energyblue';
                $('#AddNew').jqxButton({width: '350', height: '30', theme: theme});
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
                            url: 'ajax/Researchers_View.php?id=<? echo $personId; ?>' + '&p=<? echo $_SESSION['program']; ?>' + '&q=1'
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
                                {text: 'Title/العنوان', dataField: 'title_ar', width: 380, align: 'right', cellsalign: 'right'},
                                {text: 'Application date/تاريخ التقديم', dataField: 'status_date', width: 200, align: 'right', cellsalign: 'right'},
                                {text: 'Submit / حفظ', datafield: 'submit', align: 'center', width: 90, columntype: 'button', cellsrenderer: function () {
                                        return '..';
                                    }, buttonclick: function (row) {
                                        var projectId = $("#jqxgrid").jqxGrid('getrowdata', row)['seq_id'];
                                        
                                        window.location.assign('accept.php?q=' + urlencode(base64_encode(projectId)));
                                    }
                                },
                                {text: 'Edit/ تعديل', datafield: 'تعديل', align: 'center', width: 90, columntype: 'button', cellsrenderer: function () {
                                        return '..';
                                    }, buttonclick: function (row) {
                                        var projectId = $("#jqxgrid").jqxGrid('getrowdata', row)['seq_id'];
                                        $.ajax({url: 'ajax/Session.php?q=' + projectId});
                                        window.location.assign('research_submit.php');
                                    }
                                },
                                {text: 'Delete/حذف', datafield: 'حذف', width: 90, align: 'center', columntype: 'button', cellsrenderer: function () {
                                        return "..";
                                    }, buttonclick: function (row) {
                                        var projectId = $("#jqxgrid").jqxGrid('getrowdata', row)['seq_id'];
                                        WithDraw(projectId);
                                    }
                                }
                            ]
                        });

                var SubmitDataSource =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'seq_id'},
                                {name: 'title_ar'},
                                {name: 'status_date'},
                                {name: 'status_name'}
                            ],
                            id: 'seq_id',
                            url: 'ajax/Researchers_View.php?id=<? echo $personId; ?>' + '&p=<? echo $_SESSION['program']; ?>' + '&q=0'
                        };
                var dataAdapter2 = new $.jqx.dataAdapter(SubmitDataSource);

                $("#jqxSubmittedGrid").jqxGrid(
                        {
                            source: dataAdapter2,
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
                                {text: 'Title/العنوان', dataField: 'title_ar', width: 350, align: 'right', cellsalign: 'right'},
                                {text: 'Application date/تاريخ التقديم', dataField: 'status_date', width: 200, align: 'right', cellsalign: 'right'},
                                {text: 'Status/الحالة', dataField: 'status_name', width: 150, align: 'center', cellsalign: 'center'},
                                {text: 'متابعة الحالات/ Track Status', datafield: 'الحالة', align: 'center', width: 200, columntype: 'button', cellsrenderer: function () {
                                        return '..';
                                    }, buttonclick: function (row) {
                                        var projectId = $("#jqxSubmittedGrid").jqxGrid('getrowdata', row)['seq_id'];
                                        display_research_status(projectId);
                                    }
                                },
                                {text: 'Download/ تحميل', datafield: 'Download', align: 'center', width: 200, columntype: 'button', cellsrenderer: function () {
                                        return '..';
                                    }, buttonclick: function (row) {
                                        var projectId = $("#jqxSubmittedGrid").jqxGrid('getrowdata', row)['seq_id'];
                                        Download_File(projectId);
                                    }
                                }
                            ]
                        });
            });</script>
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
            function Download_File(projectId)
            {
                $(document).ready(function () {
                    $.ajax({
                        url: 'ajax/GetURL.php?q=' + projectId,
                        success: function (data, textStatus, jqXHR) {
                            window.location.assign('../' + data, '_blank');
                        }
                    });

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
            <input type="button" value="Apply for a new proposal / التقديم علي مقترح بحثي جديد" id='AddNew' style="margin-top: 10px;margin-bottom: 10px;"/>
            <br/>
            <br/>
            <label>
                المشاريع المحفوظة / Saved Drafts
            </label>
            <hr/>
            <div id="jqxgrid"></div>
            <br/>

            <br/>
            <br/>
            <label>
                المشاريع المقدمة / Proposed Projects 
            </label>
            <hr/>
            <div id="jqxSubmittedGrid"></div>
            <br/>

        </div>

    </fieldset>

</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
