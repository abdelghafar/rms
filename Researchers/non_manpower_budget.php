<?
session_start();

if (isset($_SESSION['Authorized'])) {
    if ($_SESSION['Authorized'] != 1) {
        header('Location:../Login.php');
    }
}

require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/project_budget.php';
require_once '../lib/budget_items.php';
require_once '../lib/Reseaches.php';
require_once '../lib/users.php';


if (isset($_SESSION['q'])) {
    $projectId = $_SESSION['q'];
    $obj = new Reseaches();
    $personId = $_SESSION['person_id'];
    $isAuthorized = $obj->IsAuthorized($projectId, $personId);
    $CanEdit = $obj->CanEdit($projectId);
    if ($isAuthorized == 1 && $CanEdit == 1) {
        $project = $obj->GetResearch($projectId);
        $title_ar = $project['title_ar'];
        $title_en = $project['title_en'];
        $duration = $project['proposed_duration'];
        $techId = $project['center_id'];
        $major_field_id = $project['major_field'];
        $speical_field_id = $project['special_field'];
    } else {
        ob_start();
        header('Location:./forbidden.php');
        exit();
    }
}
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
    <title>تابع- الميزانية</title>
    <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>

    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>

    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxfileupload.js"></script>
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
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnumberinput.js"></script>
    <script src="../js/numeral.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
    <script type="text/javascript">
    $(document).ready(function () {
        var materials_seq_id = null;
        var materials_amount = null;
        var materials_desc = null;
        var materials_item_id = null;

        var travel_seq_id = null;
        var travel_amount = null;
        var travel_desc = null;
        var travel_item_id = null;
        var theme = 'energyblue';
        $('#AddNewMaterials').jqxButton({width: 300, height: '30', theme: theme});
        $('#AddNewTravel').jqxButton({width: 300, height: '30', theme: theme});

        $('#item_amount').jqxNumberInput({rtl: true, width: '250px', height: '30px', inputMode: 'simple', spinButtons: true, theme: theme, max: 100000, min: 1, decimalDigits: 0});
        $('#item_amount_val').val($('#item_amount').jqxNumberInput('getDecimal'));

        $('#item_amount').on('valueChanged', function () {
            var value = $('#item_amount').jqxNumberInput('getDecimal');
            $('#item_amount_val').val(value);
        });

        $('#travel_amount').jqxNumberInput({rtl: true, width: '250px', height: '30px', inputMode: 'simple', spinButtons: true, theme: theme, max: 100000, min: 1, decimalDigits: 0});
        $('#travel_amount').on('valueChanged', function () {
            var value = $('#travel_amount').jqxNumberInput('getDecimal');
            $('#travel_amount_val').val(value);
        });

        $('#material_save_button').jqxButton({width: 80, height: 30, theme: theme});
        $('#travel_save_button').jqxButton({width: 80, height: 30, theme: theme});

        $('#material_save_button').on('click', function () {
            if (materials_seq_id === null) {
                $.ajax({url: "inc/save_material_items.inc.php",
                    type: "post",
                    dataType: "json",
                    data: $('#material_form').serialize(),
                    success: function (data) {
                        if (data > 0) {
                            $('#materials_table').hide();
                            Reload_grid_materials();
                        }
                    }
                });
            } else {
                $.ajax({url: "inc/save_material_items.inc.php?seq_id=" + materials_seq_id,
                    data: $('#material_form').serialize(),
                    type: "post",
                    success: function (data) {
                        if (data >= 0) {
                            $('#materials_table').hide();
                            Reload_grid_materials();
                        }
                    }
                });
            }

        });
        $('#travel_save_button').on('click', function () {
            if (travel_seq_id === null) {
                $.ajax({url: "inc/save_travel_items.inc.php",
                    type: "post",
                    dataType: "json",
                    data: $('#travel_form').serialize(),
                    success: function (data) {
                        if (data > 0) {
                            $('#travel_table').hide();
                            Reload_grid_travel();
                        }
                    }
                });
            } else {
                $.ajax({url: "inc/save_travel_items.inc.php?seq_id=" + travel_seq_id,
                    type: "post",
                    dataType: "json",
                    data: $('#travel_form').serialize(),
                    success: function (data) {
                        if (data > 0) {
                            $('#travel_table').hide();
                            Reload_grid_travel();
                        }
                    }
                });
            }

        });
        $('#material_cancel_button').jqxButton({width: 80, height: 30, theme: theme});
        $('#material_cancel_button').on('click', function () {
            $('#materials_table').hide();
        });

        $('#travel_cancel_button').jqxButton({width: 80, height: 30, theme: theme});
        $('#travel_cancel_button').on('click', function () {
            $('#travel_table').hide();
        });

        var materials_items_source = {datatype: "json",
            datafields: [
                {name: 'item_id'},
                {name: 'item_title'}
            ],
            id: 'item_id',
            url: '../Data/materials_items.php'};
        var materials_items_adapter = new $.jqx.dataAdapter(materials_items_source);
        $('#lst_materials_items').jqxDropDownList({width: '300', height: '30', theme: theme, source: materials_items_adapter, displayMember: 'item_title', valueMember: 'item_id', rtl: true, promptText: 'Select Item / من فضلك اختر'});

        $('#lst_materials_items').on('select', function (event) {
            var args = event.args;
            if (args.index !== -1) {
                var item = $('#lst_materials_items').jqxDropDownList('getItem', args.index);
                var item_value = item.value;
                if (item !== null) {
                    $('#materials_items_val').val(item_value);
                }
            }

        });

        var travel_items_source = {datatype: "json",
            datafields: [
                {name: 'item_id'},
                {name: 'item_title'}
            ],
            id: 'item_id',
            url: '../Data/travel_items.php'};
        var travel_items_adapter = new $.jqx.dataAdapter(travel_items_source);
        $('#lst_travel_items').jqxDropDownList({width: '300', height: '30', theme: theme, source: travel_items_adapter, displayMember: 'item_title', valueMember: 'item_id', rtl: true, promptText: 'Select Item / من فضلك اختر'});

        $('#lst_travel_items').on('select', function (event) {
            var args = event.args;
            if (args.index !== -1) {
                var item = $('#lst_travel_items').jqxDropDownList('getItem', args.index);
                var item_value = item.value;
                if (item !== null) {
                    $('#travel_items_val').val(item_value);
                }
            }
        });


        var MaterialsDataSource =
        {
            datatype: "json",
            datafields: [
                {name: 'seq_id'},
                {name: 'amount', type: 'float'},
                {name: 'desc'},
                {name: 'item_title'}
            ],
            id: 'seq_id',
            url: 'ajax/project_budget_materials.php?q=<? echo $projectId; ?>'
        };
        var dataAdapter = new $.jqx.dataAdapter(MaterialsDataSource);
        $("#grid_materials").jqxGrid(
            {
                source: dataAdapter,
                theme: theme,
                editable: false,
                pageable: false,
                filterable: true,
                width: 940,
                pagesize: 5,
                autoheight: true,
                columnsresize: true,
                sortable: true,
                rtl: true,
                columns: [
                    {text: 'seq_id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                    {text: 'Type/ النوع', dataField: 'item_title', width: 440, align: 'right', cellsalign: 'right'},
                    {text: 'Cost / القيمة', dataField: 'amount', width: 100, align: 'right', cellsalign: 'right'},
                    {text: 'Notes / ملاحظات', dataField: 'desc', width: 300, align: 'right', cellsalign: 'right'},
                    {text: 'Delete / حذف', datafield: 'حذف', width: 100, align: 'center', columntype: 'button', cellsrenderer: function () {
                        return '..';
                    }, buttonclick: function (row) {
                        var dataRecord = $("#grid_materials").jqxGrid('getrowdata', row);
                        var seq_id = dataRecord['seq_id'];
                        Delete(seq_id);
                        Reload_grid_materials();
                    }
                    }
                ]
            });
        $('#grid_materials').on('rowdoubleclick', function (event) {
            var rowindex = $('#grid_materials').jqxGrid('getselectedrowindex');
            var dataRecord = $("#grid_materials").jqxGrid('getrowdata', rowindex);
            var material_seq_id = dataRecord['seq_id'];
            $.ajax({datatype: "json", url: '../Data/get_project_budget_item.php?seq_id=' + material_seq_id,
                success: function (data) {
                    if (data === null) {
                        console.error('No data found...');
                    }
                    else {
                        var json_data = JSON.parse(data);
                        $('#materials_table').show();
                        materials_seq_id = json_data[0]['seq_id'];
                        materials_amount = json_data[0]['amount'];
                        materials_desc = json_data[0]['desc'];
                        materials_item_id = json_data[0]['item_id'];
                        $('#item_amount').jqxNumberInput({value: materials_amount});
                        $('#lst_materials_items').val(materials_item_id);
                        $('#materials_desc').val(materials_desc);
                    }
                }
            });

        });
        var TravelDataSource =
        {
            datatype: "json",
            datafields: [
                {name: 'seq_id'},
                {name: 'amount', type: 'float'},
                {name: 'desc'},
                {name: 'item_title'}
            ],
            id: 'seq_id',
            url: 'ajax/project_budget_travel.php?q=<? echo $projectId; ?>'
        };
        dataAdapter = new $.jqx.dataAdapter(TravelDataSource);
        $("#grid_travel").jqxGrid(
            {
                source: dataAdapter,
                theme: theme,
                editable: false,
                pageable: false,
                filterable: true,
                width: 940,
                pagesize: 5,
                autoheight: true,
                columnsresize: true,
                sortable: true,
                rtl: true,
                columns: [
                    {text: 'seq_id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                    {text: 'Type/ النوع', dataField: 'item_title', width: 440, align: 'right', cellsalign: 'right'},
                    {text: 'Cost / القيمة', dataField: 'amount', width: 100, align: 'right', cellsalign: 'right'},
                    {text: 'Notes / ملاحظات', dataField: 'desc', width: 300, align: 'right', cellsalign: 'right'},
                    {text: 'Delete / حذف', datafield: 'حذف', width: 100, align: 'center', columntype: 'button', cellsrenderer: function () {
                        return '..';
                    }, buttonclick: function (row) {
                        var dataRecord = $("#grid_travel").jqxGrid('getrowdata', row);
                        var seq_id = dataRecord['seq_id'];
                        Delete(seq_id);
                        Reload_grid_travel();
                    }
                    }
                ]
            });
        $('#grid_travel').on('rowdoubleclick', function (event) {
            var rowindex = $('#grid_travel').jqxGrid('getselectedrowindex');
            var dataRecord = $("#grid_travel").jqxGrid('getrowdata', rowindex);
            travel_seq_id = dataRecord['seq_id'];
            $.ajax({datatype: "json", url: '../Data/get_project_budget_item.php?seq_id=' + travel_seq_id,
                success: function (data) {
                    if (data === null) {
                        console.error('No data found...');
                    }
                    else {
                        var json_data = JSON.parse(data);
                        $('#travel_table').show();
                        travel_seq_id = json_data[0]['seq_id'];
                        travel_amount = json_data[0]['amount'];
                        travel_desc = json_data[0]['desc'];
                        travel_item_id = json_data[0]['item_id'];
                        $('#travel_amount').jqxNumberInput({value: travel_amount});
                        $('#lst_travel_items').val(travel_item_id);
                        $('#travel_desc').val(travel_desc);
                    }
                }
            });
        });
        $('#AddNewTravel').click(function () {
            travel_seq_id = null;
            $('#lst_travel_items').jqxDropDownList({selectedIndex: -1});
            $('#travel_amount').jqxNumberInput('clear');
            $('#travel_desc').val('');
            $('#travel_table').show();
        });
        $('#AddNewMaterials').click(function () {
            materials_seq_id = null;
            $('#lst_materials_items').jqxDropDownList({selectedIndex: -1});
            $('#item_amount').jqxNumberInput('clear');
            $('#materials_desc').val('');
            $('#materials_table').show();
        });
    });
    </script>
    <script type="text/javascript">
        function Delete(seq_id) {
            if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true) {
                $.ajax({
                    type: 'post',
                    url: 'inc/Del_project_budget.inc.php?q=' + seq_id,
                    datatype: "html",
                    success: function (data) {
                    }
                });
            }
        }
        function Reload_grid_materials() {
            var MaterialsDataSource =
            {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'amount', type: 'float'},
                    {name: 'desc'},
                    {name: 'item_title'}
                ],
                id: 'person_id',
                url: 'ajax/project_budget_materials.php?q=<? echo $projectId; ?>'
            };
            var dataAdapter = new $.jqx.dataAdapter(MaterialsDataSource);
            $("#grid_materials").jqxGrid({source: dataAdapter});
            Calc_material_footer();
        }

        function Reload_grid_travel() {
            var TravelDataSource =
            {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'amount', type: 'float'},
                    {name: 'desc'},
                    {name: 'item_title'}
                ],
                id: 'seq_id',
                url: 'ajax/project_budget_travel.php?q=<? echo $projectId; ?>'
            };
            var dataAdapter = new $.jqx.dataAdapter(TravelDataSource);
            $("#grid_travel").jqxGrid({source: dataAdapter});
            Calc_travels_footer();
        }
        function Reload_other_items() {
            var Others_Items_DataSource =
            {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'amount', type: 'float'},
                    {name: 'desc'},
                    {name: 'item_title'}
                ],
                id: 'seq_id',
                url: 'ajax/project_budget_otherItems.php?q=<? echo $projectId; ?>'
            };
            var dataAdapter = new $.jqx.dataAdapter(Others_Items_DataSource);
            $("#grid_others").jqxGrid({source: dataAdapter});
            Calc_Others_footer();
        }
        function Calc_material_footer() {
            $(document).ready(function () {
                $.ajax({url: 'ajax/project_materials_total.php?q=<? echo $projectId ?>', success: function (data, textStatus, jqXHR) {
                    var material_total = 0;
                    material_total = data;
                    $('#materials_total').html(material_total);
                    $.ajax({url: 'ajax/project_total_budegt.php?q=<? echo $projectId ?>', success: function (xdata, textStatus, jqXHR) {
                        var project_total = 0;
                        project_total = xdata;
                        var material_percent = parseFloat(material_total) / parseFloat(project_total);
                        console.log('material_total:' + material_total);
                        console.log('project_total:' + project_total);
                        console.log('perce' + material_total / project_total);
//                        $('#materials_percent').html(numeral(material_percent).format('00.00%'));
                        $('#materials_percent').html(material_percent * 100);
                    }});
                }});
            });
        }
        function Calc_travels_footer() {
            $(document).ready(function () {
                $.ajax({url: 'ajax/project_travel_total.php?q=<? echo $projectId ?>', success: function (data, textStatus, jqXHR) {
                    var travel_total = 0;
                    travel_total = data;
                    $('#travel_total').html(travel_total);
                    $.ajax({url: 'ajax/project_total_budegt.php?q=<? echo $projectId ?>', success: function (xdata, textStatus, jqXHR) {
                        var project_total = 0;
                        project_total = xdata;
                        var travel_percent = parseFloat(travel_total) / parseFloat(project_total);
                        $('#travel_percent').html(numeral(travel_percent).format('00.00%'));
                    }});
                }});
            });
        }
        function Calc_Others_footer() {
            $(document).ready(function () {
                $.ajax({url: 'ajax/project_others_total.php?q=<? echo $projectId ?>', success: function (data, textStatus, jqXHR) {
                    var others_total = 0;
                    others_total = data;
                    $('#others_total').html(others_total);
                    $.ajax({url: 'ajax/project_total_budegt.php?q=<? echo $projectId ?>', success: function (xdata, textStatus, jqXHR) {
                        var project_total = 0;
                        project_total = xdata;
                        console.log(project_total);
                        var others_percent = parseFloat(others_total) / parseFloat(project_total);
                        $('#others_percent').html(numeral(others_percent).format('00.00%'));
                    }});
                }});
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var others_seq_id = null;
            var others_amount = null;
            var others_desc = null;
            var others_item_id = null;
            var theme = 'energyblue';
            $('#AddNewOthers').jqxButton({width: 300, height: '30', theme: theme});
            $('#AddNewOthers').click(function () {
                others_seq_id = null;
                $('#lst_others_items').jqxDropDownList({selectedIndex: -1});
                $('#others_amount').jqxNumberInput('clear');
                $('#others_desc').val('');
                $('#others_table').show();
            });
            $('#others_amount').jqxNumberInput({rtl: true, width: '250px', height: '30px', inputMode: 'simple', spinButtons: true, theme: theme, max: 100000, min: 1, decimalDigits: 0});
            $('#others_amount').on('valueChanged', function () {
                var value = $('#others_amount').jqxNumberInput('getDecimal');
                $('#others_amount_val').val(value);
            });

            $('#others_save_button').jqxButton({width: 80, height: 30, theme: theme});
            $('#others_cancel_button').jqxButton({width: 80, height: 30, theme: theme});
            $('#others_cancel_button').on('click', function () {
                $('#others_table').hide();
            });
            var others_items_source = {datatype: "json",
                datafields: [
                    {name: 'item_id'},
                    {name: 'item_title'}
                ],
                id: 'item_id',
                url: '../Data/other_items.php'};
            var others_items_adapter = new $.jqx.dataAdapter(others_items_source);
            $('#lst_others_items').jqxDropDownList({width: '300', height: '30', theme: theme, source: others_items_adapter, displayMember: 'item_title', valueMember: 'item_id', rtl: true, promptText: 'Select Item / من فضلك اختر'});

            $('#lst_others_items').on('select', function (event) {
                var args = event.args;
                if (args.index !== -1) {
                    var item = $('#lst_others_items').jqxDropDownList('getItem', args.index);
                    var item_value = item.value;
                    if (item !== null) {
                        $('#others_items_val').val(item_value);
                    }
                }
            });
            var Others_Items_DataSource =
            {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'amount', type: 'float'},
                    {name: 'desc'},
                    {name: 'item_title'}
                ],
                id: 'seq_id',
                url: 'ajax/project_budget_otherItems.php?q=<? echo $projectId; ?>'
            };
            var dataAdapter = new $.jqx.dataAdapter(Others_Items_DataSource);
            $("#grid_others").jqxGrid(
                {
                    source: dataAdapter,
                    theme: theme,
                    editable: false,
                    pageable: false,
                    filterable: true,
                    width: 940,
                    pagesize: 5,
                    autoheight: true,
                    columnsresize: true,
                    sortable: true,
                    rtl: true,
                    columns: [
                        {text: 'seq_id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'Type / النوع', dataField: 'item_title', width: 440, align: 'right', cellsalign: 'right'},
                        {text: 'Cost/ القيمة', dataField: 'amount', width: 100, align: 'right', cellsalign: 'right'},
                        {text: 'Notes/ملاحظات', dataField: 'desc', width: 300, align: 'right', cellsalign: 'right'},
                        {text: 'Delete/حذف', datafield: 'حذف', width: 100, align: 'center', columntype: 'button', cellsrenderer: function () {
                            return '..';
                        }, buttonclick: function (row) {
                            var dataRecord = $("#grid_others").jqxGrid('getrowdata', row);
                            var seq_id = dataRecord['seq_id'];
                            Delete(seq_id);
                            Reload_other_items();
                        }
                        }
                    ]
                });
            $('#grid_others').on('rowdoubleclick', function (event) {
                var rowindex = $('#grid_others').jqxGrid('getselectedrowindex');
                var dataRecord = $("#grid_others").jqxGrid('getrowdata', rowindex);
                others_seq_id = dataRecord['seq_id'];
                $.ajax({datatype: "json", url: '../Data/get_project_budget_item.php?seq_id=' + others_seq_id,
                    success: function (data) {
                        if (data === null) {
                            console.error('No data found...');
                        }
                        else {
                            var json_data = JSON.parse(data);
                            $('#others_table').show();
                            others_seq_id = json_data[0]['seq_id'];
                            others_amount = json_data[0]['amount'];
                            others_desc = json_data[0]['desc'];
                            others_item_id = json_data[0]['item_id'];
                            $('#others_amount').jqxNumberInput({value: others_amount});
                            $('#lst_others_items').val(others_item_id);
                            $('#others_desc').val(others_desc);
                        }
                    }
                });
            });

            $('#others_save_button').on('click', function () {
                if (others_seq_id === null) {
                    $.ajax({url: "inc/save_other_items.inc.php",
                        type: "post",
                        dataType: "json",
                        data: $('#others_form').serialize(),
                        success: function (data) {
                            if (data > 0) {
                                $('#others_table').hide();
                                Reload_other_items();
                            }
                        }
                    });
                } else {
                    $.ajax({url: "inc/save_other_items.inc.php?seq_id=" + others_seq_id,
                        type: "post",
                        dataType: "json",
                        data: $('#others_form').serialize(),
                        success: function (data) {
                            if (data > 0) {
                                $('#others_table').hide();
                                Reload_other_items();
                            }
                        }
                    });
                }

            });
            Calc_material_footer();
            Calc_travels_footer();
            Calc_Others_footer();
        });

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
    </head>
    <body>
    <div>
        <?
        require_once 'wizard_steps.php';
        ?>
    </div>
    <script type="text/javascript">
        wizard_step(9);
    </script>
    <fieldset style="width: 97%;text-align: right;">
    <legend>
        <label>
            تابع ميزانية المشروع(المتطلبات) / (Project Budget Cont.(Requirements
        </label>
    </legend>


    <h2 style="font-size: 14px">المواد و الاجهزة / Materials and Equipment </h2>
    <hr/>
    <input type="button" id='AddNewMaterials' value="Add new requirement / اضافة متطلب جديد"
           style="float: left;margin-bottom: 15px;"/>
    <br/>

    <form id="material_form" action="#" method="post">
        <div style="padding-top: 10px;width: 70%;padding-right: 150">
            <input type="hidden" name="project_id" value="<? echo $projectId; ?>"/>

            <table id="materials_table" style="display: none; width: 100%">
                <tr>
                    <td valign="middle">
                        <span class="classic">النوع / Type</span>
                        <span class="required">*</span>
                    </td>
                    <td>
                        <div id="lst_materials_items"></div>
                        <input type="hidden" id="materials_items_val" name="materials_items_val"/>
                    </td>
                </tr>
                <tr>
                    <td>
                                <span class="classic">
                                    التكلفة / Cost
                                </span>
                        <span class="required">*</span>
                    </td>
                    <td>
                        <div id="item_amount"></div>
                        <input type="hidden" id="item_amount_val" name="item_amount_val"/>
                    </td>
                </tr>
                <tr>
                    <td>
                                <span class="classic">
                                    ملاحظات / Notes
                                </span>
                    </td>
                    <td>
                        <textarea id="materials_desc" name="item_desc" rows="4" cols="1" style="width: 450px;">
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <input type="button" value="حفظ" id='material_save_button'/>
                        <input type="button" value="اغلاق" id='material_cancel_button'/>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <div id="grid_materials"></div>

    <table id="materials_footer">
        <tr>
            <td>
                        <span class="classic">
                            الاجمالي / PROJECT TEAM MATERIALS TOTAL:
                        </span>
            </td>
            <td>
                <label id="materials_total">
                    0
                </label>
            </td>
            <td>
                        <span class="classic">
                            النسبة المئوية / PROJECT TEAM MATERIALS PERCENT
                        </span>
            </td>
            <td>
                <label id="materials_percent">
                    0
                </label>
            </td>
        </tr>
    </table>

    <br/><br/>

    <h2 style="font-size: 14px">الرحلات / Travel</h2>
    <hr/>
    <input type="button" id='AddNewTravel' value="Add new requirement / اضافة متطلب جديد"
           style="float: left;margin-bottom: 15px;"/>
    <br/>

    <form id="travel_form" action="#" method="post">
        <div style="padding-top: 10px;width: 70%;padding-right: 150">
            <input type="hidden" name="project_id" value="<? echo $projectId; ?>"/>
            <table id="travel_table" style="display: none; width: 100%">
                <tr>
                    <td valign="middle">
                        <span class="classic">النوع / Type</span>
                        <span class="required">*</span>
                    </td>
                    <td>
                        <div id="lst_travel_items"></div>
                        <input type="hidden" id="travel_items_val" name="travel_items_val"/>
                    </td>
                </tr>
                <tr>
                    <td>
                                <span class="classic">
                                    القيمة / Cost 
                                </span>
                        <span class="required">*</span>
                    </td>
                    <td>
                        <div id="travel_amount"></div>
                        <input type="hidden" id="travel_amount_val" name="travel_amount_val"/>
                    </td>
                </tr>
                <tr>
                    <td>
                                <span class="classic">
                                    ملاحظات / Notes 
                                </span>
                    </td>
                    <td>
                        <textarea id="travel_desc" name="item_desc" rows="4" cols="20" style="width: 450px;">
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <input type="button" value="حفظ" id='travel_save_button'/>
                        <input type="button" value="اغلاق" id='travel_cancel_button'/>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <div id="grid_travel"></div>
    <table id="travel_footer">
        <tr>
            <td>
                        <span class="classic">
                            الاجمالي / PROJECT TEAM MATERIALS TOTAL:
                        </span>
            </td>
            <td>
                <label id="travel_total">
                    0
                </label>
            </td>
            <td>
                        <span class="classic">
                            النسبة المئوية / PROJECT TEAM MATERIALS PERCENT
                        </span>
            </td>
            <td>
                <label id="travel_percent">
                    0
                </label>
            </td>
        </tr>
    </table>
    <br/><br/>

    <h2 style="font-size: 14px">أخري / Others</h2>
    <hr/>
    <input type="button" id='AddNewOthers' value="Add new requirement / اضافة متطلب جديد"
           style="float: left;margin-bottom: 15px;"/>
    <br/>

    <form id="others_form" action="#" method="post">
        <div style="padding-top: 10px;width: 70%;padding-right: 150">
            <input type="hidden" name="project_id" value="<? echo $projectId; ?>"/>
            <table id="others_table" style="display: none; width: 100%">
                <tr>
                    <td valign="middle">
                        <span class="classic">النوع / Type</span>
                        <span class="required">*</span>
                    </td>
                    <td>
                        <div id="lst_others_items"></div>
                        <input type="hidden" id="others_items_val" name="others_items_val"/>
                    </td>
                </tr>
                <tr>
                    <td>
                                <span class="classic">
                                    القيمة / Cost
                                </span>
                        <span class="required">*</span>
                    </td>
                    <td>
                        <div id="others_amount"></div>
                        <input type="hidden" id="others_amount_val" name="others_amount_val"/>
                    </td>
                </tr>
                <tr>
                    <td>
                                <span class="classic">
                                    ملاحظات / Notes
                                </span>
                    </td>
                    <td>
                        <textarea id="others_desc" name="others_desc" rows="4" cols="20" style="width: 450px;">
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <input type="button" value="حفظ" id='others_save_button'/>
                        <input type="button" value="اغلاق" id='others_cancel_button'/>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <div id="grid_others"></div>
    <table id="others_footer">
        <tr>
            <td>
                        <span class="classic">
                            الاجمالي / PROJECT TEAM MATERIALS TOTAL:
                        </span>
            </td>
            <td>
                <label id="others_total">
                    0
                </label>
            </td>
            <td>
                        <span class="classic">
                            النسبة المئوية / PROJECT TEAM MATERIALS PERCENT
                        </span>
            </td>
            <td>
                <label id="others_percent">
                    0
                </label>
            </td>
        </tr>
    </table>
    <br/><br/>

    </fieldset>
    <table style="width: 100%;">
        <tr>
            <td style="display: block;">
                <a href="manpower_budget.php" style="float: right;margin-left: 25px;margin-top: 20px;">
                    <img src="images/back.png" style="border: none;" alt="back"/>
                </a>
            </td>

            <td>
                <a href="Researchers_View.php" style="float: left;margin-left: 25px;margin-top: 20px;">
                    <img src="images/finish.png" style="border: none;" alt="next"/>
                </a>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?
$smarty->display('../templates/footer.tpl');
