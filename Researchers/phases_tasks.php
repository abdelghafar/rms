<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Researcher') {
        header('Location:../Login.php');
    }
}
$project_id = $_GET["research_id"];

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
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>

        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script> 
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmenu.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.columnsresize.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.selection.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>

        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxknockout.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.sort.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.edit.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxgrid.filter.js"></script>

        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>	
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcombobox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>	

        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnumberinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/globalization/globalize.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttongroup.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcheckbox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxradiobutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                var theme = "energyblue";
                $("#PhaseNewButton").jqxButton({width: '100', height: '30', theme: theme});
                /*$("#phase_name").jqxInput({width: '400', height: '30', theme: theme, rtl: true});
                 $("#phase_desc").jqxInput({width: '400', height: '130', theme: theme, rtl: true});
                 $("#sendButton").on('click', function () {
                 
                 });*/
            });
        </script>

        <script type="text/javascript">

            $(document).ready(function() {
                //var theme = "";

                phases_list();
                tasks_list(0);

                function phases_list() {
                    var post_data = 'project_id=' + $('#project_id').val();
                    var source =
                            {
                                datatype: "json",
                                datafields: [
                                    {name: 'seq_id'},
                                    {name: 'project_id'},
                                    {name: 'phase_name'},
                                    {name: 'phase_desc'}
                                ],
                                url: 'inc/phases_list_grid_data.php?' + post_data,
                                cache: false
                            };

                    var dataAdapter = new $.jqx.dataAdapter(source);

                    $("#phases_grd").jqxGrid(
                            {
                                source: source,
                                theme: 'energyblue',
                                editable: false,
                                pageable: true,
                                filterable: true,
                                width: 930,
                                pagesize: 20,
                                autorowheight: true,
                                autoheight: true,
                                columnsresize: true,
                                sortable: true,
                                rtl: true,
                                columns: [
                                    {text: 'seq_id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'project_id', datafield: 'project_id', width: 30, align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'إسم المرحلة', datafield: 'phase_name', type: 'string', width: 350, align: 'center', cellsalign: 'right'},
                                    {text: 'الوصف', datafield: 'phase_desc', type: 'string', width: 380, align: 'center', cellsalign: 'right'},
                                    {text: 'تعديل', datafield: '..', align: 'center', width: 50, columntype: 'button', cellsrenderer: function() {
                                            return "..";
                                        }, buttonclick: function(row) {
                                            var dataRecord = $("#phases_grd").jqxGrid('getrowdata', row);
                                            var post_data = 'seq_id=' + dataRecord.seq_id + '&project_id=' + dataRecord.project_id + '&phase_name=' + dataRecord.phase_name + '&phase_desc=' + dataRecord.phase_desc;
                                            $.ajax({
                                                url: "phase_data_form.php",
                                                dataType: "html",
                                                data: post_data,
                                                type: 'POST',
                                                beforeSend: function() {
                                                    $("#form_div").html("<img src='images/load.gif'/>loading...");
                                                },
                                                success: function(data) {
                                                    $("#form_div").html(data);
                                                }
                                            });

                                        }
                                    },
                                    {text: 'إضافة مهام', width: 100, datafield: '', align: 'center', columntype: 'button', cellsrenderer: function() {
                                            return "إضافة مهام";
                                        }, buttonclick: function(row) {
                                            var dataRecord = $("#phases_grd").jqxGrid('getrowdata', row);
                                               $("#form_div").html("");
                                            var post_data = 'project_id=' + dataRecord.project_id + '&phase_id=' + dataRecord.seq_id + '&task_id=' + 0;

                                            $.ajax({
                                                url: "task_data_form.php",
                                                dataType: "html",
                                                data: post_data,
                                                type: 'POST',
                                                beforeSend: function() {
                                                    $("#form_div").html("<img src='images/load.gif'/>loading...");
                                                },
                                                success: function(data) {
                                                    $("#form_div").html(data);
                                                }
                                            });
                                        }
                                    },
                                    {text: 'حذف', datafield: 'حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function() {
                                            return "..";
                                        }, buttonclick: function(row) {
                                            //window.confirm("هل انت متأكد من حذف هذا البيان");
                                            var r = confirm("هل انت متأكد من حذف هذا البيان");
                                            if (r == true)
                                            {
                                                var dataRecord = $("#phases_grd").jqxGrid('getrowdata', row);
                                                var post_data = '&poem_id=' + dataRecord.id;
                                                $.ajax({
                                                    type: 'post',
                                                    url: 'bll/deletePoem.php',
                                                    datatype: "html",
                                                    data: post_data,
                                                    beforeSend: function() {
                                                        $("#phaseresult").html("<img src='images/load.gif'/>loading...");
                                                    },
                                                    success: function(data) {
                                                        $("#phaseresult").html(data);
                                                        if ($("#phase_operation_flag").val() === 'true')
                                                        {
                                                            var selectedrowindex = $("#phases_grd").jqxGrid('getselectedrowindex');
                                                            var rowscount = $("#phases_grd").jqxGrid('getdatainformation').rowscount;
                                                            if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                                                                var id = $("#phases_grd").jqxGrid('getrowid', selectedrowindex);
                                                                var commit = $("#phases_grd").jqxGrid('deleterow', id);
                                                            }
                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    }
                                ]
                            });
                }

                function tasks_list(phase_id) {
                    var post_data = 'project_id=' + $('#project_id').val() + '&phase_id=' + phase_id;
                    var source =
                            {
                                datatype: "json",
                                datafields: [
                                    {name: 'project_id'},
                                    {name: 'phase_id'},
                                    {name: 'task_id'},
                                    {name: 'task_name'},
                                    {name: 'start_date'},
                                    {name: 'end_date'},
                                    {name: 'task_desc'},
                                    {name: 'objective_id'},
                                    {name: 'phase_name'}
                                ],
                                url: 'inc/tasks_list_grid_data.php?' + post_data,
                                cache: false
                            };

                    var dataAdapter = new $.jqx.dataAdapter(source);

                    $("#tasks_grd").jqxGrid(
                            {
                                source: source,
                                theme: 'energyblue',
                                editable: false,
                                pageable: true,
                                filterable: true,
                                width: 930,
                                pagesize: 20,
                                autorowheight: true,
                                autoheight: true,
                                columnsresize: true,
                                sortable: true,
                                rtl: true,
                                columns: [
                                    {text: 'project_id', datafield: 'project_id', align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'phase_id', datafield: 'phase_id', align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'task_id', datafield: 'task_id', align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'إسم المرحلة', datafield: 'phase_name', type: 'string', width: 200, align: 'center', cellsalign: 'right'},
                                    {text: 'إسم المهمة', datafield: 'task_name', type: 'string', width: 200, align: 'center', cellsalign: 'right'},
                                    {text: 'بداية المهمة', datafield: 'start_date', type: 'string', width: 80, align: 'center', cellsalign: 'right'},
                                    {text: 'نهاية المهمة', datafield: 'end_date', type: 'string', width: 80, align: 'center', cellsalign: 'right'},
                                    {text: 'وصف المهمة', datafield: 'task_desc', type: 'string', width: 270, align: 'center', cellsalign: 'right'},
                                    {text: 'objective_id', datafield: 'objective_id', align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'تعديل', datafield: '..', align: 'center', width: 50, columntype: 'button', cellsrenderer: function() {
                                            return "..";
                                        }, buttonclick: function(row) {
                                            var dataRecord = $("#tasks_grd").jqxGrid('getrowdata', row);
                                            var post_data = 'seq_id=' + dataRecord.seq_id + '&project_id=' + dataRecord.project_id + '&phase_name=' + dataRecord.phase_name + '&phase_desc=' + dataRecord.phase_desc;
                                            $.ajax({
                                                url: "task_data_form.php",
                                                dataType: "html",
                                                data: post_data,
                                                type: 'POST',
                                                beforeSend: function() {
                                                    $("#form_div").html("<img src='images/load.gif'/>loading...");
                                                },
                                                success: function(data) {
                                                    $("#form_div").html(data);
                                                }
                                            });

                                        }
                                    },
                                    {text: 'حذف', datafield: 'حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function() {
                                            return "..";
                                        }, buttonclick: function(row) {
                                            //window.confirm("هل انت متأكد من حذف هذا البيان");
                                            var r = confirm("هل انت متأكد من حذف هذا البيان");
                                            if (r == true)
                                            {
                                                var dataRecord = $("#tasks_grd").jqxGrid('getrowdata', row);
                                                var post_data = '&task_id=' + dataRecord.task_id;
                                                $.ajax({
                                                    type: 'post',
                                                    url: 'bll/deleteTask.php',
                                                    datatype: "html",
                                                    data: post_data,
                                                    beforeSend: function() {
                                                        $("#taskresult").html("<img src='images/load.gif'/>loading...");
                                                    },
                                                    success: function(data) {
                                                        $("#taskresult").html(data);
                                                        if ($("#task_operation_flag").val() === 'true')
                                                        {
                                                            var selectedrowindex = $("#tasks_grd").jqxGrid('getselectedrowindex');
                                                            var rowscount = $("#tasks_grd").jqxGrid('getdatainformation').rowscount;
                                                            if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                                                                var id = $("#tasks_grd").jqxGrid('getrowid', selectedrowindex);
                                                                var commit = $("#tasks_grd").jqxGrid('deleterow', id);
                                                            }
                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    }
                                ]
                            });
                }

                $('#PhaseNewButton').on('click', function() {
                    $("#form_div").html("");
                    var post_data = 'project_id=' + $('#project_id').val() + '&seq_id=' + 0;
                    $.ajax({
                        url: "phase_data_form.php",
                        dataType: "html",
                        data: post_data,
                        type: 'POST',
                        beforeSend: function() {
                            $("#form_div").html("<img src='images/load.gif'/>loading...");
                        },
                        success: function(data) {
                            $("#form_div").html(data);
                        }
                    });
                });

            });
        </script>

        <script type="text/javascript">

            function WithDraw(ResearchId)
            {
                if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
                {
                    $.ajax({
                        type: 'post',
                        url: 'inc/WithDraw.inc.php?ResearchId=' + ResearchId,
                        datatype: "html",
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            }

            function update_research(research_id)
            {
//                window.showModalDialog("ResearchEdit.php?research_id=" + research_id + "&research_code=" + research_code, 'PopupPage', 'dialogHeight:450px; dialogWidth:900px; resizable:0');

                $(document).ready(function() {

                    window.location.assign('phases.php?research_id=' + research_id);
                });
            }


        </script>
        <title></title>
    </head>
    <body style="background-color: #ededed;">

        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?
                    echo 'المراحل والمهام ';
                    ?>
                </label>
            </legend>
            <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>" />
            <div class="panel_row">
                <div class="panel-cell" style="width: 100 ;text-align: left;padding-right: 800">
                    <input type="button" value="إضافة مرحلة" id='PhaseNewButton' style="margin: 0px 10px;"  />
                </div>
            </div>


            <div id="phases_grd" style="margin-right: 0px !important; padding-right: 0px !important">

            </div>

            <div id="phaseresult" dir="rtl" style="padding-top: 10px">    </div>

            <div id="form_div" style="padding-top: 10px;width: 100%">
            </div>

            <div id="taskresult" dir="rtl" style="padding-top: 10px">    </div>

            <div id="tasks_grd">

            </div>

        </fieldset>
    <label>
        <a href="index.php?program=<? echo $_SESSION['program'] ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
            رجوع
        </a></label>

</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
