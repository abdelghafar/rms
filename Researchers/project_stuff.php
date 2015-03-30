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
require_once('../lib/CenterResearch.php');
require_once '../lib/research_stuff.php';
require_once '../lib/Reseaches.php';

require_once '../lib/users.php';

if (isset($_SESSION['q'])) {
    $projectId = $_SESSION['q'];
    $obj = new Reseaches();
    $UserId = $_SESSION['User_Id'];
    $u = new Users();
    $personId = $u->GetPerosnId($UserId, $rule);
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
} else {
    ob_start();
    header('Location:./forbidden.php');
    exit();
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
        function ReloadCoIs()
        {
            var theme = 'energyblue';
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
                        url: 'ajax/project_stuff_CoI.php?q=<? echo $projectId; ?>'
                    };
            var dataAdapter = new $.jqx.dataAdapter(CoIsDataSource);
            $("#gridCoI").jqxGrid(
                    {
                        source: dataAdapter,
                        theme: theme,
                        editable: false,
                        pageable: false,
                        filterable: true,
                        width: 880,
                        pagesize: 5,
                        autoheight: true,
                        columnsresize: true,
                        sortable: true,
                        rtl: true,
                        columns: [
                            {text: 'person_id', datafield: 'person_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                            {text: 'Emplyoee Id / رقم المنسوب', dataField: 'empCode', width: 200, align: 'right', cellsalign: 'right'},
                            {text: 'Name/ الاسم', dataField: 'name_ar', width: 250, align: 'right', cellsalign: 'right'},
                            {text: 'Title / الدرجة العلمية', dataField: 'position', width: 150, align: 'right', cellsalign: 'right'},
                            {text: 'Specialization/ التخصص ', dataField: 'major_Field', width: 200, align: 'right', cellsalign: 'right'},
                            {text: 'Delete/حذف', datafield: 'حذف', width: 80, align: 'center', columntype: 'button', cellsrenderer: function () {
                                    return '..';
                                }, buttonclick: function (row) {
                                    var dataRecord = $("#gridCoI").jqxGrid('getrowdata', row);
                                    var person_id = dataRecord['person_id'];
                                    Delete(person_id);
                                }
                            }
                        ]
                    });


        }

        function ReloadOtherPeronsal()
        {
            var theme = 'energyblue';
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
                        url: 'ajax/project_stuff_other_personal.php?q=<? echo $projectId; ?>'
                    };
            var dataAdapter = new $.jqx.dataAdapter(OtherDataSource);
            $("#gridOthers").jqxGrid(
                    {
                        source: dataAdapter,
                        theme: theme,
                        editable: false,
                        pageable: false,
                        filterable: true,
                        width: 880,
                        pagesize: 5,
                        autoheight: true,
                        columnsresize: true,
                        sortable: true,
                        rtl: true,
                        columns: [
                            {text: 'person_id', datafield: 'person_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                            {text: 'Name / الاسم', dataField: 'name_ar', width: 250, align: 'right', cellsalign: 'right'},
                            {text: 'Specialization / التخصص', dataField: 'major_Field', width: 200, align: 'right', cellsalign: 'right'},
                            {text: 'Title / الدرجة العلمية', dataField: 'position', width: 150, align: 'right', cellsalign: 'right'},
                            {text: 'Role / نوع المشاركة', dataField: 'role_name', width: 200, align: 'right', cellsalign: 'right'},
                            {text: 'Email / البريد الالكتروني', dataField: 'email', width: 200, align: 'right', cellsalign: 'right'},
                            {text: 'Delete / حذف', datafield: 'حذف', width: 90, align: 'center', columntype: 'button', cellsrenderer: function () {
                                    return '..';
                                }, buttonclick: function (row) {
                                    var dataRecord = $("#gridOthers").jqxGrid('getrowdata', row);
                                    var person_id = dataRecord['person_id'];
                                    Delete(person_id);
                                }
                            }
                        ]
                    });

        }


    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var theme = 'energyblue';
            $('#AddNewCoIs').jqxButton({width: '150', height: '30', theme: theme});
            $('#AddNewOtherPersonal').jqxButton({width: '150', height: '30', theme: theme});

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
                        url: 'ajax/project_stuff_PIs.php?q=<? echo $projectId; ?>'
                    };
            var dataAdapter = new $.jqx.dataAdapter(PIDataSource);
            $("#gridPI").jqxGrid(
                    {
                        source: dataAdapter,
                        theme: theme,
                        editable: false,
                        pageable: false,
                        filterable: true,
                        width: 880,
                        pagesize: 5,
                        autoheight: true,
                        columnsresize: true,
                        sortable: true,
                        rtl: true,
                        columns: [
                            {text: 'person_id', datafield: 'person_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                            {text: 'Emplyoee Id / رقم المنسوب', dataField: 'empCode', width: 250, align: 'right', cellsalign: 'right'},
                            {text: 'Name / الاسم', dataField: 'name_ar', width: 280, align: 'right', cellsalign: 'right'},
                            {text: 'Title / الدرجة العلمية', dataField: 'position', width: 200, align: 'right', cellsalign: 'right'},
                            {text: 'Specialization/ التخصص ', dataField: 'major_Field', width: 150, align: 'right', cellsalign: 'right'}
                        ]
                    });

            //CoI Data Source------------------------------------------------------------
            ReloadCoIs();
            //------------------------------------------------------
            //Others
            ReloadOtherPeronsal();

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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#AddNewCoIs').click(function () {
                $.ajax({
                    url: "searchCoAuthor.php?q=" + '<? echo $projectId; ?>',
                    type: "post",
                    datatype: "html",
                    success: function (data) {
                        $('#SearchFrm').html(data);
                    }
                });
            });

            $('#AddNewOtherPersonal').click(function () {
                $.ajax({
                    url: "searchOtherPersonal.php?q=" + '<? echo $projectId; ?>',
                    type: "post",
                    datatype: "html",
                    success: function (data) {
                        $('#SearchPersonalFrm').html(data);
                    }
                });
            });
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
    wizard_step(3);
</script>

<fieldset style="width: 95%;text-align: right;">
        <legend>
            <label>
                الفريق البحثي / Research Team
            </label>
        </legend>

    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: right;margin-top: 10px;margin-right:25px;margin-bottom: 30px;">

        <h2 style="font-size: 14px">الباحث الرئيس/ PI</h2>
        <hr/>
            <div id="gridPI"></div>
            <br/><br/>

        <h2 style="font-size: 14px">الباحثين المشاركين / CO-Is</h2>
        <hr/>
        <input type="button" style="margin-bottom: 15px;margin-right:730" id='AddNewCoIs' value="Add / اضافة"/>

        <div id='SearchFrm' style="width: 852px;height: auto;">

            </div>

            <div id='gridCoI'></div>
            <br/><br/>

        <h2 style="font-size: 14px">أخري -Other Personal </h2>
        <hr/>
        <input type="button" style="margin-bottom: 15px;margin-right:730 " id='AddNewOtherPersonal'
               value="Add / اضافة"/>

        <div id='SearchPersonalFrm' style="width: 852px;height: auto;"></div>
            <div id='gridOthers'></div>
        </div>
    </fieldset>
    <table style="width: 100%;">
        <tr>
            <td>
                <a href="uploadIntro.php" style="float: right;margin-left: 25px;margin-top: 20px;">
                    <img src="images/back.png" style="border: none;" alt="back"/>
                </a>
            </td>
            <td>
                <a id="submit_button" href="phases.php" style="float: left;margin-left: 25px;margin-top: 20px;">
                    <img src="images/next.png" style="border: none;" alt="next"/>
                </a>
            </td>
        </tr>
    </table>


</body>
<?
$smarty->display('../templates/footer.tpl');
