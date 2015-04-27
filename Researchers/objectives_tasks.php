<?
session_start();
if ($_SESSION['Authorized'] == null) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
} else if ($_SESSION['Authorized'] == 0) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
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
$smarty->assign('research_projects_php', 'Researchers_View.php');
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('about_php', '../aboutus.php');

$smarty->assign('login_php', '../login.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');

$smarty->display('../templates/header.tpl');
?>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
    <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/>

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
            $("#ObjectiveNewButton").jqxButton({width: '250', height: '30', theme: theme});
            /*$("#obj_title").jqxInput({width: '400', height: '30', theme: theme, rtl: true});
             $("#obj_desc").jqxInput({width: '400', height: '130', theme: theme, rtl: true});
             $("#sendButton").on('click', function () {

             });*/
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function () {
            //var theme = "";

            objectives_list();
            load_tasks_grd();
            function objectives_list() {
                var post_data = 'project_id=' + $('#project_id').val();
                var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'seq_id'},
                        {name: 'project_id'},
                        {name: 'obj_title'},
                        {name: 'obj_desc'}
                    ],
                    url: 'inc/objectives_list_grid_data.php?' + post_data,
                    cache: false
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#objectives_grd").jqxGrid(
                    {
                        source: source,
                        theme: 'energyblue',
                        editable: false,
                        pageable: true,
                        filterable: true,
                        width: 940,
                        pagesize: 20,
                        autorowheight: true,
                        autoheight: true,
                        columnsresize: true,
                        sortable: true,
                        rtl: true,
                        columns: [
                            {text: 'seq_id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                            {text: 'project_id', datafield: 'project_id', width: 30, align: 'center', cellsalign: 'center', hidden: true},
                            {text: 'Objective / الهدف', datafield: 'obj_title', type: 'string', width: 270, align: 'center', cellsalign: 'right'},
                            {text: 'Approach / الطريقة', datafield: 'obj_desc', type: 'string', width: 380, align: 'center', cellsalign: 'right'},
                            {text: 'Edit/تعديل', datafield: '..', align: 'center', width: 60, columntype: 'button', cellsrenderer: function () {
                                return "..";
                            }, buttonclick: function (row) {
                                var dataRecord = $("#objectives_grd").jqxGrid('getrowdata', row);
                                var post_data = 'seq_id=' + dataRecord.seq_id + '&project_id=' + dataRecord.project_id + '&obj_title=' + dataRecord.obj_title + '&obj_desc=' + dataRecord.obj_desc;
                                $.ajax({
                                    url: "objective_data_form.php",
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
                            {text: 'Assign Tasks/تخصيص مهام ', width: 150, datafield: '', align: 'center', columntype: 'button', cellsrenderer: function () {
                                return "Assign Tasks/تخصيص مهام ";
                            }, buttonclick: function (row) {
                                var dataRecord = $("#objectives_grd").jqxGrid('getrowdata', row);
                                $("#form_div").html("");
                                var post_data = 'project_id=' + dataRecord.project_id + '&objective_id=' + dataRecord.seq_id;

                                $.ajax({
                                    url: "objectives_tasks_det_edit.php",
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
                            {text: 'Delete/حذف', datafield: 'Delete/حذف', width: 80, align: 'center', columntype: 'button', cellsrenderer: function () {
                                return "..";
                            }, buttonclick: function (row) {
                                //window.confirm("هل انت متأكد من حذف هذا البيان");
                                var r = confirm("هل انت متأكد من حذف هذا البيان");
                                if (r == true) {
                                    var dataRecord = $("#objectives_grd").jqxGrid('getrowdata', row);
                                    var post_data = '&objective_id=' + dataRecord.seq_id;
                                    var project_id = dataRecord.project_id;

                                    $.ajax({
                                        type: 'post',
                                        url: 'inc/deleteObjective.php',
                                        datatype: "html",
                                        data: post_data,
                                        beforeSend: function () {
                                            $("#objectiveresult").html("<img src='images/load.gif'/>loading...");
                                        },
                                        success: function (data) {
                                            $("#objectiveresult").html(data);
                                            if ($("#objective_operation_flag").val() === 'true') {
                                                window.location.assign('objectives_tasks.php?q=' + project_id);
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

            $("#objectives_grd").on('rowdoubleclick', function (event) {
                var objective_id = $('#objectives_grd').jqxGrid('getcellvalue', event.args.rowindex, 'seq_id');
                $('#global_objective_id').val(objective_id);
                load_tasks_grd();
            });

            $('#ObjectiveNewButton').on('click', function () {
                var post_data = 'project_id=' + $('#project_id').val() + '&seq_id=' + 0;
                $.ajax({
                    url: "objective_data_form.php",
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

        function load_tasks_grd() {
            var post_data = 'project_id=' + $('#project_id').val() + '&objective_id=' + $('#global_objective_id').val();
            $.ajax({
                url: "objectives_tasks_det.php",
                dataType: "html",
                    data: post_data,
                    type: 'POST',
                beforeSend: function () {
                    $("#tasks_div").html("<img src='images/load.gif'/>loading...");
                },
                success: function (data) {
                    $("#tasks_div").html(data);
                }
                });
        }

        function next_step() {
            var post_data = 'project_id=' + $('#project_id').val() + '&form_name=objectives_tasks';
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
                        window.location.assign('resources_tasks.php');
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
        wizard_step(5);
    </script>
    <fieldset style="width: 95%;text-align: right;">
        <legend>
            <label>
                <?
                echo 'ربط الأهداف بالمراحل والمهام / Objectives, phases and tasks mapping';
                ?>
            </label>
        </legend>

        <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>"/>
        <input type="hidden" id="global_objective_id" name="global_objective_id" value="0"/>

        <h2 style="font-size: 14px">
            الأهداف / Objectives
        </h2>
        <hr/>


        <input type="button" value="Add a new objective / إضافة هدف جديد" id='ObjectiveNewButton'
               style="margin-bottom: 15px;float: left "/>


        <div id="objectives_grd" style="margin-right: 0px !important; padding-right: 0px !important">

        </div>

        <div id="objectiveresult" dir="rtl" style="padding-top: 10px; text-align: center"></div>
        <div id="form_div" style="padding-top: 10px;width: 100%;padding-right: 150"></div>
        <div id="tasks_div" style="padding-top: 10px;width: 100%"></div>
        <div id="step_div" style="padding: 10px;width: 100%;"></div>

    </fieldset>
    <table style="width: 100%;">
        <tr>
            <td>
                <a href="phases.php" style="float: right;margin-top: 20px;">

                    <img src="images/back.png" style="border: none;" alt="back"/>
                </a>
            </td>
            <td>
                <a id="submit_button" href="#" onclick="next_step();" style="float: left;margin-top: 20px;">
                    <img src="images/next.png" style="border: none;" alt="next"/>
                </a>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?
$smarty->display('../templates/footer.tpl');
