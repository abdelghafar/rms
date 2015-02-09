<?
session_start();
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">';
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
require_once '../lib/research_stuff.php';
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

<?
require_once '../lib/Reseaches.php';
$users = new Users();
$userId = $_SESSION['User_Id'];
$personId = $users->GetPerosnId($userId, 'Researcher');
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>الباحثين المشاركين</title>
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
//            $('#AddNew').jqxButton({rtl: true, width: 75, height: '30', theme: theme});
//            $('#AddNew').click(function () {
//                window.location.assign('understanding.php?program=<? echo $_SESSION['program']; ?>');
//            });
            var PIDataSource =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'person_id'},
                            {name: 'name_ar'},
                            {name: 'role_name'},
                            {name: 'empCode'},
                            {name: 'position'},
                            {name: 'major_Field'}
                        ],
                        id: 'person_id',
                        url: 'ajax/project_stuff_PIs?q=<? echo $projectId; ?>'
                    };
            var dataAdapter = new $.jqx.dataAdapter(PIDataSource);
            $("#gridPI").jqxGrid(
                    {
                        source: dataAdapter,
                        theme: theme,
                        editable: false,
                        pageable: false,
                        filterable: true,
                        width: 850,
                        pagesize: 5,
                        autoheight: true,
                        columnsresize: true,
                        sortable: true,
                        rtl: true,
                        columns: [
                            {text: 'person_id', datafield: 'person_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                            {text: 'اسم الباحث', dataField: 'name_ar', width: 250, align: 'right', cellsalign: 'right'},
                            {text: 'الوظيفة', dataField: 'role_name', width: 100, align: 'right', cellsalign: 'right'},
                            {text: 'رقم المنسوب', dataField: 'empCode', width: 250, align: 'center', cellsalign: 'center'},
                            {text: 'الدرجة العلمية', dataField: 'position', width: 100, align: 'right', cellsalign: 'right'},
                            {text: 'التخصص العام', dataField: 'major_Field', width: 100, align: 'right', cellsalign: 'right'}
                        ]
                    });

            //CoI Data Source------------------------------------------------------------
            var CoIsDataSource =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'person_id'},
                            {name: 'name_ar'},
                            {name: 'role_name'},
                            {name: 'empCode'},
                            {name: 'position'},
                            {name: 'major_Field'}
                        ],
                        id: 'person_id',
                        url: 'ajax/project_stuff_CoI?q=<? echo $projectId; ?>'
                    };
            dataAdapter = new $.jqx.dataAdapter(CoIsDataSource);
            $("#gridCoI").jqxGrid(
                    {
                        source: dataAdapter,
                        theme: theme,
                        editable: false,
                        pageable: false,
                        filterable: true,
                        width: 850,
                        pagesize: 5,
                        autoheight: true,
                        columnsresize: true,
                        sortable: true,
                        rtl: true,
                        columns: [
                            {text: 'person_id', datafield: 'person_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                            {text: 'اسم الباحث', dataField: 'name_ar', width: 250, align: 'right', cellsalign: 'right'},
                            {text: 'الوظيفة', dataField: 'role_name', width: 100, align: 'right', cellsalign: 'right'},
                            {text: 'رقم المنسوب', dataField: 'empCode', width: 250, align: 'center', cellsalign: 'center'},
                            {text: 'الدرجة العلمية', dataField: 'position', width: 100, align: 'right', cellsalign: 'right'},
                            {text: 'التخصص العام', dataField: 'major_Field', width: 100, align: 'right', cellsalign: 'right'},
                            {text: 'حذف', datafield: 'حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function () {
                                    return '..';
                                }, buttonclick: function (row) {
                                }
                            }
                        ]
                    });

            //------------------------------------------------------
            //Others
            var OtherDataSource =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'person_id'},
                            {name: 'name_ar'},
                            {name: 'role_name'},
                            {name: 'email'},
                            {name: 'position'},
                            {name: 'major_Field'},
                            {name: 'nationality'}
                        ],
                        id: 'person_id',
                        url: 'ajax/project_stuff_other_personal?q=<? echo $projectId; ?>'
                    };
            dataAdapter = new $.jqx.dataAdapter(OtherDataSource);
            $("#gridOthers").jqxGrid(
                    {
                        source: dataAdapter,
                        theme: theme,
                        editable: false,
                        pageable: false,
                        filterable: true,
                        width: 850,
                        pagesize: 5,
                        autoheight: true,
                        columnsresize: true,
                        sortable: true,
                        rtl: true,
                        columns: [
                            {text: 'person_id', datafield: 'person_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                            {text: 'اسم الباحث', dataField: 'name_ar', width: 250, align: 'right', cellsalign: 'right'},
                            {text: 'البريد الالكتروني', dataField: 'email', width: 200, align: 'right', cellsalign: 'right'},
                            {text: 'الجنسية', dataField: 'nationality', width: 100, align: 'center', cellsalign: 'center'},
                            {text: 'الدرجة العلمية', dataField: 'position', width: 100, align: 'right', cellsalign: 'right'},
                            {text: 'التخصص العام', dataField: 'major_Field', width: 100, align: 'right', cellsalign: 'right'},
                            {text: 'حذف', datafield: 'حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function () {
                                    return '..';
                                }, buttonclick: function (row) {
                                }
                            }
                        ]
                    });

        });

    </script>
    <script type="text/javascript">
        function Display_AddCoAuthor()
        {
            $(document).ready(function () {
                $('#window').css('visibility', 'visible');
                $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 300, width: 700, autoOpen: false, isModal: true, animationType: 'fade'});
                $('#windowContent').load("searchCoAuthor.php?rcode=" + '<? echo $projectId ?>');
                $('#window').jqxWindow('setTitle', 'اضافة باحث مشارك');
                $('#window').jqxWindow('open');
            });
        }

        function Delete(person_id)
        {
            if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
            {
                $.ajax({
                    type: 'post',
                    url: 'inc/Del_Person.inc.php?person_id=' + person_id + "&rcode=" + '<? echo $projectId; ?>',
                    datatype: "html",
                    success: function (data) {
                        location.reload();
                    }
                });
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                url: "inc/project_stuff.inc.php?research_id=" + '<? echo $_GET['q']; ?>',
                type: "post",
                datatype: "html",
                data: $("#coAuthorsForm").serialize(),
                success: function (data) {
                    $('#Result').html(data);
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
                الفريق البحثي
            </label>
        </legend>
        <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: right;margin-top: 10px;margin-right:25px;margin-bottom: 30px;">

            <span class="classic-font">الباحث الرئيسي</span>
            <div id="gridPI"></div>
            <br/><br/>
            <span class="classic-font">الباحثين المشاركين</span>
            <div id='gridCoI'></div>
            <br/><br/>
            <span class="classic-font">أخري</span>
            <div id='gridOthers'></div>

        </div>
        <table style="width: 100%;">
            <tr>
                <td>
                    <a id="submit_button" href="workingPlan.php?q=<? echo $projectId; ?>" style="float: right;margin-left: 25px;margin-top: 20px;">next</a>
                </td>
                <td>
                    <a href="uploadIntro.php?program=<? echo $_SESSION['program'] . '&q=' . $projectId; ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
                        رجوع
                    </a>
                </td>
            </tr>
        </table>
    </fieldset>

</body>
<?
$smarty->display('../templates/footer.tpl');
