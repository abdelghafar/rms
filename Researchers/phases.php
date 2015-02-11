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
                load_tasks_grd();

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
                                                var post_data = '&phase_id=' + dataRecord.seq_id;
                                                var project_id= dataRecord.project_id;
                                                
                                                $.ajax({
                                                    type: 'post',
                                                    url: 'inc/deletePhase.php',
                                                    datatype: "html",
                                                    data: post_data,
                                                    beforeSend: function() {
                                                        $("#phaseresult").html("<img src='images/load.gif'/>loading...");
                                                    },
                                                    success: function(data) {
                                                        $("#phaseresult").html(data);
                                                        if ($("#phase_operation_flag").val() === 'true')
                                                        {
                                                            window.location.assign('phases.php?research_id=' + project_id);
                                                            //$("#phase_form_div").html("");

                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    }
                                ]
                            });
                }

                $("#phases_grd").on('rowdoubleclick', function(event) {
                    var phase_id = $('#phases_grd').jqxGrid('getcellvalue', event.args.rowindex, 'seq_id');
                    $('#global_phase_id').val(phase_id);

                    load_tasks_grd();

                });


                $('#PhaseNewButton').on('click', function() {
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

            function load_tasks_grd()
            {
                var post_data = 'project_id=' + $('#project_id').val() + '&phase_id=' + $('#global_phase_id').val();
                $.ajax({
                    url: "tasks.php",
                    dataType: "html",
                    data: post_data,
                    type: 'POST',
                    beforeSend: function() {
                        $("#tasks_div").html("<img src='images/load.gif'/>loading...");
                    },
                    success: function(data) {
                        $("#tasks_div").html(data);
                    }
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
                    echo ' مراحل المشروع';
                    ?>
                </label>
            </legend>
            <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>" />
            <input type="hidden" id="global_phase_id" name="global_phase_id" value="0" />
            <div class="panel_row">
                <div class="panel-cell" style="width: 100 ;text-align: left;padding-right: 800">
                    <input type="button" value="إضافة مرحلة" id='PhaseNewButton' style="margin: 0px 10px;"  />
                </div>
            </div>


            <div id="phases_grd" style="margin-right: 0px !important; padding-right: 0px !important">

            </div>


        </fieldset>
        <div id="phaseresult" dir="rtl" style="padding-top: 10px; text-align: center">    </div>
        <div id="form_div" style="padding-top: 10px;width: 100%;padding-right: 150" >     </div>
        <div id="tasks_div" style="padding-top: 10px;width: 100%">    </div>

        <table style="width: 100%;">
            <tr style="background-color: #CAD6E2">
                <td>
                    <label><a id="submit_button" href="objectives_tasks.php?research_id=<? echo $project_id;?>" style="float: right;margin-left: 25px;margin-top: 20px;">التالي</a></label>
                </td>
                <td>

                </td>
                
                <td>
                    <label><a href="index.php?program=<? echo $_SESSION['program'] ?>" style="float: left;margin-left: 25px;margin-top: 20px;">السابق</a></label>
                </td>
            </tr>
        </table>
        
    

</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
