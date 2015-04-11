<?
session_start();
if (isset($_SESSION['Authorized'])) {
    if ($_SESSION['Authorized'] != 1) {
        header('Location:../login.php');
    }
}
require_once '../lib/Reseaches.php';
require_once '../lib/users.php';

if (isset($_SESSION['q'])) {
    $project_id = $_SESSION['q'];
    $obj = new Reseaches();
    $personId = $_SESSION['person_id'];
    $isAuthorized = $obj->IsAuthorized($project_id, $personId);
    $CanEdit = $obj->CanEdit($project_id);
    if ($isAuthorized == 1 && $CanEdit == 1) {

    } else {
        echo '<div class="errormsgbox" style="width: 850px;height: 30px;"><h4>This project is locked from the admin</h4></div>';
        exit();
    }
}
require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/project_budget.php';
require_once '../lib/budget_items.php';
require_once '../lib/users.php';
require_once '../lib/Util.php';
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

if (isset($_SESSION['q'])) {
    $projectId = $_SESSION['q'];
} else {
    exit();
}
?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>تحميل الملف</title>
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
        <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/>
        <link rel="stylesheet" href="../common/css/MessageBox.css" type="text/css"/>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $.ajax({url: 'generate_pdf/generate_summary.php?q=<? echo $projectId; ?>', success: function (data) {
                    $.ajax({url: 'generate_pdf/generate_team.php?q=<? echo $projectId; ?>', success: function (data, textStatus, jqXHR) {
                        $.ajax({url: 'generate_pdf/generate_details.php?q=<? echo $projectId; ?>', success: function (data, textStatus, jqXHR) {
                            $.ajax({url: 'generate_pdf/merge_pdf.php?q=<? echo $projectId; ?>', success: function (data, textStatus, jqXHR) {
                                $('#download_file').show();
                                $('#loadingDiv').hide();
                                $('#download_file_url').attr('href', data);
                                $('#submit_button').show();
                            }
                            });

                        }
                        });
                    }
                    });
                }, beforeSend: function () {
                    $('#loadingDiv').show();
                }
                });
            });
        </script>
    </head>
    <body>
    <div id="loadingDiv" style="display: none;width: 880px;" class="Infobox">
        <img src="../common/images/loading.gif" style="border: none;" alt=""/>

        <p>
            يرجي الانتظار حتي يقوم النظام ببناء الملف...
        </p>
    </div>

    <div id="download_file" style="display: none;width: 870px;margin-right: 10px;" class="successbox">
        لقد تم انشاء الملف بنجاح
        <a id="download_file_url" href="#">اضعط هنا للحصول عليه</a>
    </div>

    <table style="width: 100%;">
        <tr>
            <td>
                <a href="accept.php" style="float: right;margin-top: 20px;">
                    <img src="images/back.png" style="border: none;margin-left: 0px;" alt="back"/>
                </a>

            </td>
            <td>
                <a id="submit_button" href="final_submit.php"
                   style="float: left;margin-top: 20px;display: none;">
                    <img src="images/next.png" style="border: none;margin-right: 0px;" alt="next"/>
                </a>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?
$smarty->display('../templates/footer.tpl');
