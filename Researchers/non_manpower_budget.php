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
require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/project_budget.php';
require_once '../lib/budget_items.php';

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
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');
$smarty->display('../templates/Loggedin.tpl');

if (isset($_GET['q'])) {
    $projectId = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
} else {
    exit();
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>تابع- الملزانية</title>
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />

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

        <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/> 
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = 'energyblue';
                $('#AddNewMaterials').jqxButton({rtl: true, width: 75, height: '30', theme: theme});
                var MaterialsDataSource =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'seq_id'},
                                {name: 'amount', type: 'float'},
                                {name: 'compensation'},
                                {name: 'desc'},
                                {name: 'item_title'}
                            ],
                            id: 'person_id',
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
                            width: 800,
                            pagesize: 5,
                            autoheight: true,
                            columnsresize: true,
                            sortable: true,
                            rtl: true,
                            columns: [
                                {text: 'seq_id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                                {text: 'العنوان', dataField: 'item_title', width: 400, align: 'right', cellsalign: 'right'},
                                {text: 'القيمة', dataField: 'amount', width: 100, align: 'right', cellsalign: 'right'},
                                {text: 'ملاحظات', dataField: 'desc', width: 250, align: 'right', cellsalign: 'right'},
                                {text: 'حذف', datafield: 'حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function () {
                                        return '..';
                                    }, buttonclick: function (row) {
                                        var dataRecord = $("#grid_materials").jqxGrid('getrowdata', row);
                                        var person_id = dataRecord['seq_id'];
                                        Delete(person_id);
                                    }
                                }
                            ]
                        });
            });

        </script> 
        <script type="text/javascript">
            function Delete(person_id)
            {
                if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
                {
                    $.ajax({
                        type: 'post',
                        url: 'inc/Del_Person.inc.php?person_id=' + person_id + "&q=" + '<? echo $projectId; ?>',
                        datatype: "html",
                        success: function (data) {
                            window.location.reload();
                        }
                    });

                }
            }
        </script>
    </head>
    <body>
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    الميزانية-تابع
                </label>
            </legend>
            <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: right;margin-top: 10px;margin-right:25px;margin-bottom: 30px;">
                <span class="classic-font">المواد الخام و الأجهزة</span>
                <hr/>
                <input type="button" id='AddNewMaterials' value="اضافة جديد"/>
                <div id="grid_materials"></div>
                <br/><br/>
            </div>
        </fieldset>
    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
