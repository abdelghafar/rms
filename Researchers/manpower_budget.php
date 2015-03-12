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
$project_id = $_GET["q"];
require_once '../lib/budget.php';
$project_budget = new Budget();
$item_id = 15; // for manpower budget item
$project_budget_total = $project_budget->GetBudgetTotal($project_id);
$project_manpower_total = round($project_budget->GetItemTotal($project_id, $item_id));
$manpower_percent = round($project_manpower_total / $project_budget_total * 100, 2);


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

            $(document).ready(function() {
                //var theme = "";
                var theme = "energyblue";
                $("#manpower_percent").jqxInput({width: '100', height: '30', theme: theme, rtl: true, disabled: true});
                $("#manpower_buget").jqxInput({width: '150', height: '30', theme: theme, rtl: true, disabled: true});
                //("#manpower_budget").jqxInput({width: '150', height: '40', theme: theme, rtl: true});
                //("#manpower_percent").jqxInput({width: '150', height: '40', theme: theme, rtl: true});
                outcomes_list();

                function outcomes_list() {
                    var post_data = 'project_id=' + $('#project_id').val()+'&item_id=' + $('#manpower_id').val();
                    var source =
                            {
                                datatype: "json",
                                datafields: [
                                    {name: 'seq_id'},
                                    {name: 'project_id'},
                                    {name: 'item_id'},
                                    {name: 'person_id'},
                                    {name: 'person_name'},
                                    {name: 'duration'},
                                    {name: 'duration_unit'},
                                    {name: 'dunit_id'},
                                    {name: 'compensation', type: 'number'},
                                    {name: 'total_amount', type: 'number'}
                                ],
                                url: 'inc/manpower_budget_grid_data.php?' + post_data,
                                cache: false
                            };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $("#outcomes_grd").jqxGrid(
                            {
                                source: dataAdapter,
                                theme: 'energyblue',
                                editable: true,
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
                                    {text: 'item_id', datafield: 'item_id', width: 30, align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'person_id', datafield: 'person_id', width: 30, align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'Name -Role / الإسم - المشاركة', datafield: 'person_name', type: 'string', editable: false, width: 430, align: 'center', cellsalign: 'right'},
                                    {text: 'Duration/  المدة', datafield: 'duration', type: 'string', editable: false, width: 100, align: 'center', cellsalign: 'right'},
                                    {text: 'Unit/ الوحدة', datafield: 'duration_unit', type: 'string', editable: false, width: 125, align: 'center', cellsalign: 'right'},
                                    {text: 'dunit_id', datafield: 'dunit_id', width: 30, align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'Compensation/المكافأة ', datafield: 'compensation', width: 125, align: 'center', cellsalign: 'right', columntype: 'numberinput',
                                        validation: function(cell, value) {
                                            if (value < 0) {
                                                return {result: false, message: "قيمة غير صحيحة"};
                                            }
                                            return true;
                                        },
                                        createeditor: function(row, cellvalue, editor) {
                                            editor.jqxNumberInput({digits: 4});
                                        }},
                                    {text: 'Total / الإجمالى', datafield: 'total_amount', type: 'string', editable: false, width: 150, align: 'center', cellsalign: 'right'}
                                ]
                            });
                }
                $("#outcomes_grd").on('cellendedit', function(event)
                {

                    var column = args.datafield;
                    var rowid = args.rowindex;
                    var compensation = args.value;
                    var datarow = $('#outcomes_grd').jqxGrid('getrowdatabyid', rowid);
                    console.log(datarow);
                    var oldvalue = args.oldvalue;
                    var changevalue = (compensation - oldvalue) * datarow.duration;
                    //alert(changevalue);
                    // alert($("#manpower_buget").val());
                    if (column === 'compensation' && oldvalue !== compensation)
                    {
                        var total_amount = compensation * datarow.duration;

                        console.log(compensation * datarow.duration);

                        var post_data = 'seq_id=' + datarow.seq_id + '&project_id=' + datarow.project_id + '&item_id=' + datarow.item_id + '&stuff_id=' + datarow.person_id +
                                '&duration=' + datarow.duration + '&dunit_id=' + datarow.dunit_id + '&compensation=' + compensation + '&amount=' + total_amount;
                        $.ajax({
                            type: 'post',
                            url: 'inc/saveBudgetManPower.php',
                            datatype: "html",
                            data: post_data,
                            beforeSend: function() {
                                //$("#outcomeresult").html("<img src='images/load.gif'/>loading...");
                            },
                            success: function(data) {
                                var newmanpower_total = parseFloat($("#manpower_buget").val()) + changevalue;
                                //alert(newmanpower_total);
                                var newtotal_budget = parseFloat($("#total_buget").val()) + changevalue;
                                $("#manpower_buget").val(newmanpower_total);
                                $("#total_buget").val(newtotal_budget);

                                var newmanpower_percent = (newmanpower_total / newtotal_budget * 100).toFixed(2);
                                $("#manpower_percent").val(newmanpower_percent);

                                if (data !== null && datarow.seq_id === 0)
                                {
                                    $("#outcomes_grd").jqxGrid('setcellvaluebyid', rowid, "seq_id", data);
                                }
                            }
                        });

                        $("#outcomes_grd").jqxGrid('setcellvaluebyid', rowid, "total_amount", total_amount);
                    }
                });
            });
        </script>


        <title></title>
    </head>
    <body style="background-color: #ededed;">

        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    ميزانية المشروع  / Project Budget 

                </label>
            </legend>
            <h2 style="font-size: 14px">
                1. مكافأت الفريق البحثى  / Manpower compensation
            </h2>
            <hr/>
            <input type="hidden" id="manpower_id" name="manpower_id" value="<? echo $item_id; ?>" />
            <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>" />
            <input type="hidden" id="global_outcome_id" name="global_outcome_id" value="0" />

            <div id="outcomes_grd" style="margin-right: 0px !important; padding-right: 0px !important">

            </div>
            <div class="panel_row">

                <div class="panel-cell" style="width: 250px;text-align: left;padding-left: 10px;"> 

                    <h2 style="font-size: 14px"> 
                        إجمالى مكافأت الفريق البحثي
                        <br>
                        project Team Budget Total
                    </h2>

                </div>
                <div class="panel-cell" style="width: 150px; vertical-align: middle"> 
                    <input type="hidden" id="total_buget" name="total_buget" style="font-size: 16;font-weight: bold;margin-right: 10; color: #0000cc ;text-align: center;" <?php echo "value=" . $project_budget_total; ?> disabled="true"/>
                    <input type="text" id="manpower_buget" name="manpower_buget" style="font-size: 16;font-weight: bold;margin-right: 10; color: #0000cc ;text-align: center;" <?php echo "value=" . $project_manpower_total; ?> disabled="true"/>
                </div>

                <div class="panel-cell" style="width: 250px;text-align: left;padding-left: 10px;"> 
                    <h2 style="font-size: 14px"> 
                        نسبة مكافأت الفريق البحثي
                        <br>
                        project Team Budget Percent
                    </h2>
                </div>
                <div class="panel-cell" style="vertical-align: middle"> 
                    <input type="text" id="manpower_percent" name="manpower_percent" style="font-size: 16;font-weight: bold;margin-right: 10; color: #0000cc ;text-align: center;" <?php echo "value=" . $manpower_percent; ?> />%
                </div>
            </div> 
        </fieldset>
        <div id="outcomeresult" dir="rtl" style="padding-top: 10px; text-align: center">    </div>
        <div id="form_div" style="padding-top: 10px;width: 100%;padding-right: 150" >     </div>
        <div id="objectives_div" style="padding-top: 10px;width: 100%">    </div>

        <table style="width: 100%;">
            <tr>
                <td>
                    <a id="submit_button" href="non_manpower_budget.php?q=<? echo $project_id; ?>" style="float: right;margin-left: 25px;margin-top: 20px;">
                        <img src="images/next.png" style="border: none;" alt="next"/>
                    </a>
                </td>
                <td>
                    <a href="outcomes_objectives.php?q=<? echo $project_id; ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
                        <img src="images/back.png" style="border: none;" alt="back"/>
                    </a>
                </td>
            </tr>
        </table>

    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
