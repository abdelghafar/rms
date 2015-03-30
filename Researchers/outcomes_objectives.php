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
if (isset($_SESSION['q'])) {
    $project_id = $_SESSION["q"];
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
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
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
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcheckbox.js"></script>

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
            $(document).ready(function () {
                var theme = "energyblue";
                $("#outcomeNewButton").jqxButton({width: '200', height: '30', theme: theme});
                /*$("#outcome_title").jqxInput({width: '400', height: '30', theme: theme, rtl: true});
                 $("#outcome_desc").jqxInput({width: '400', height: '130', theme: theme, rtl: true});
                 $("#sendButton").on('click', function () {
                 
                 });*/
            });
        </script>

        <script type="text/javascript">

            $(document).ready(function () {
                //var theme = "";

                outcomes_list();
                load_objectives_grd();
                function outcomes_list() {
                    var post_data = 'project_id=' + $('#project_id').val();
                    var source =
                            {
                                datatype: "json",
                                datafields: [
                                    {name: 'seq_id'},
                                    {name: 'project_id'},
                                    {name: 'outcome_title'},
                                    {name: 'outcome_desc'}
                                ],
                                url: 'inc/outcomes_list_grid_data.php?' + post_data,
                                cache: false
                            };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $("#outcomes_grd").jqxGrid(
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
                                    {text: 'Outcome / المخرج', datafield: 'outcome_title', type: 'string', width: 300, align: 'center', cellsalign: 'right'},
                                    {text: 'Description/ الوصيف ', datafield: 'outcome_desc', type: 'string', width: 430, align: 'center', cellsalign: 'right'},
                                    {text: 'Update / تعديل', datafield: '..', align: 'center', width: 50, columntype: 'button', cellsrenderer: function () {
                                        return "..";
                                    }, buttonclick: function (row) {
                                        var dataRecord = $("#outcomes_grd").jqxGrid('getrowdata', row);
                                            var post_data = 'seq_id=' + dataRecord.seq_id + '&project_id=' + dataRecord.project_id + '&outcome_title=' + dataRecord.outcome_title + '&outcome_desc=' + dataRecord.outcome_desc;
                                            $.ajax({
                                                url: "outcome_data_form.php",
                                                dataType: "html",
                                                data: post_data,
                                                type: 'POST',
                                                beforeSend: function () {
                                                    $("#form_div").html("<img src='images/load.gif'/>loading...");
                                                },
                                                success: function (data) {
                                                    $("#form_div").html(data);
                                                }
                                            });

                                        }
                                    },
                                    {text: 'Assign a goal / تخصيص هدف', width: 100, datafield: '', align: 'center', columntype: 'button', cellsrenderer: function () {
                                        return "Assign a goal / تخصيص هدف";
                                    }, buttonclick: function (row) {
                                        var dataRecord = $("#outcomes_grd").jqxGrid('getrowdata', row);
                                            $("#form_div").html("");
                                            var post_data = 'project_id=' + dataRecord.project_id + '&outcome_id=' + dataRecord.seq_id;

                                            $.ajax({
                                                url: "outcome_objectives_det_edit.php",
                                                dataType: "html",
                                                data: post_data,
                                                type: 'POST',
                                                beforeSend: function () {
                                                    $("#form_div").html("<img src='images/load.gif'/>loading...");
                                                },
                                                success: function (data) {
                                                    $("#form_div").html(data);
                                                }
                                            });
                                        }
                                    },
                                    {text: 'Delete / حذف', datafield: 'حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function () {
                                        return "..";
                                    }, buttonclick: function (row) {
                                        //window.confirm("هل انت متأكد من حذف هذا البيان");
                                            var r = confirm("هل انت متأكد من حذف هذا البيان");
                                            if (r == true)
                                            {
                                                var dataRecord = $("#outcomes_grd").jqxGrid('getrowdata', row);
                                                var post_data = '&outcome_id=' + dataRecord.seq_id;
                                                var project_id = dataRecord.project_id;

                                                $.ajax({
                                                    type: 'post',
                                                    url: 'inc/deleteoutcome.php',
                                                    datatype: "html",
                                                    data: post_data,
                                                    beforeSend: function () {
                                                        $("#outcomeresult").html("<img src='images/load.gif'/>loading...");
                                                    },
                                                    success: function (data) {
                                                        $("#outcomeresult").html(data);
                                                        if ($("#outcome_operation_flag").val() === 'true')
                                                        {
                                                            window.location.assign('outcomes_objectives.php?q=' + project_id);
                                                            //$("#objective_form_div").html("");

                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    }
                                ]
                            });
                }

                $("#outcomes_grd").on('rowdoubleclick', function (event) {
                    var outcome_id = $('#outcomes_grd').jqxGrid('getcellvalue', event.args.rowindex, 'seq_id');
                    $('#global_outcome_id').val(outcome_id);
                    load_objectives_grd();
                });

                $('#outcomeNewButton').on('click', function () {
                    var post_data = 'project_id=' + $('#project_id').val() + '&seq_id=' + 0;
                    $.ajax({
                        url: "outcome_data_form.php",
                        dataType: "html",
                        data: post_data,
                        type: 'POST',
                        beforeSend: function () {
                            $("#form_div").html("<img src='images/load.gif'/>loading...");
                        },
                        success: function (data) {
                            $("#form_div").html(data);
                        }
                    });
                });
            });</script>

        <script type="text/javascript">

            function load_objectives_grd()
            {
                var post_data = 'project_id=' + $('#project_id').val() + '&outcome_id=' + $('#global_outcome_id').val();
                $.ajax({
                    url: "outcome_objectives_det.php",
                    dataType: "html",
                    data: post_data,
                    type: 'POST',
                    beforeSend: function () {
                        $("#objectives_div").html("<img src='images/load.gif'/>loading...");
                    },
                    success: function (data) {
                        $("#objectives_div").html(data);
                    }
                });
            }

            function next_step()
            {
                var post_data = 'project_id=' + $('#project_id').val() + '&form_name=outcomes_objectives';
                $.ajax({
                    url: "inc/WizardCheck.inc.php",
                    dataType: "html",
                    data: post_data,
                    type: 'POST',
                    beforeSend: function () {
                        $("#step_div").html("<img src='images/load.gif'/>loading...");
                    },
                    success: function (data) {
                        //alert(data);
                        if (data == 1)
                            window.location.assign('manpower_budget.php');
                        else
                            $("#step_div").html(data);
                    }
                });
            }
            function wizard_step(current_step) {
                var cs = current_step;
                for (var i = 1; i < cs; i++) {
                    $("#img_" + i).attr("src", "images/" + i + "_finished.png");
                    //$('#bar_' + i).css('backgroundImage', "url('images/finished.png')");
                }
                $("#img_" + cs).attr("src", "images/" + cs + "_current.png");
                //$('#bar_' + cs).css('backgroundImage', "url('images/current.png')");
                for (var i = cs + 1; i <= 9; i++) {
                    $("#img_" + i).attr("src", "images/" + i + "_unfinish.png");
                    //if (i < 9)
                    // $('#bar_' + i).css('backgroundImage', "url('images/unfinish.png')");
                }
            }
        </script>
        <title></title>
    </head>
    <body style="background-color: #ededed;">
    <div>
        <?
        require_once 'wizard_steps.php';
        ?>
    </div>
    <script type="text/javascript">
        wizard_step(7);
    </script>

    <fieldset style="width: 95%;text-align: right;">
            <legend>
                <label>
                    ربط المخرجات بالأهداف  / Outcomes and goals mapping
                </label>
            </legend>


        <h2 style="font-size: 14px">
                المخرجات / Outcomes
            </h2>
        <hr>
        <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>" />
            <input type="hidden" id="global_outcome_id" name="global_outcome_id" value="0" />
            <div class="panel_row">
                <div class="panel-cell" style="width: 100 ;text-align: left;padding-right: 720">
                    <input type="button" value="Add an outcome / إضافة مخرج" id='outcomeNewButton' style="margin: 0px 10px;"  />
                </div>
            </div>


            <div id="outcomes_grd" style="margin-right: 0px !important; padding-right: 0px !important">

            </div>

            <div id="outcomeresult" dir="rtl" style="padding-top: 10px; text-align: center">    </div>
            <div id="form_div" style="padding-top: 10px;width: 100%;padding-right: 150" >     </div>
            <div id="objectives_div" style="padding-top: 10px;width: 100%">    </div>
            <div id="step_div" style="padding: 10px;width: 100%;">    </div>

    </fieldset>
    <table style="width: 100%;">
        <tr>
            <td>
                <a href="resources_tasks.php" style="float: right;margin-left: 25px;margin-top: 20px;">
                    <img src="images/back.png" style="border: none;" alt="back"/>
                </a>

            </td>
            <td>
                <a id="submit_button" href="#" onclick="next_step();"
                   style="float: left;margin-left: 25px;margin-top: 20px;">
                    <img src="images/next.png" style="border: none;" alt="next"/>
                </a>
            </td>
        </tr>
    </table>
    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
