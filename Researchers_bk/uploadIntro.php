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
require_once '../js/fckeditor/fckeditor.php';
require_once '../lib/CenterResearch.php';
require_once '../lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->assign('style_css', '../style.css');
$smarty->assign('style_responsive_css', '../style.responsive.css');
$smarty->assign('jquery_js', '../jquery.js');
$smarty->assign('script_js', '../script.js');
$smarty->assign('script_responsive_js', '../script.responsive.js');
$smarty->assign('index_php', '../index.php');
$smarty->assign('Researchers_register_php', '../Researchers/register.php');
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');
$smarty->display('../templates/Loggedin.tpl');
$projectId = null;
if (isset($_GET['q'])) {
    $projectId = $_GET['q'];
} else {
    exit();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />

        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxfileupload.js"></script>

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <link href="../common/css/reigster-layout.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#arAbsUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=arAbsUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});
                $('#arAbsUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });

                $('#enAbsUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=enAbsUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});
                $('#enAbsUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });

                $('#introUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=introUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});
                $('#introUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });
                $('#reviewUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=reviewUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});

                $('#arAbsUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log1').html(serverResponce);
                });
                $('#enAbsUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log2').html(serverResponce);
                });
                $('#introUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log3').html(serverResponce);
                });
                $('#reviewUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log4').html(serverResponce);
                });
            });
        </script>
    </head>
    <body>     
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    بيانات البحث
                </label>
            </legend>
            <table style="direction: rtl;border: 1px;">
                <thead style="font-size: medium;font-weight: bold;">
                    <tr style="margin-bottom: 25px;">
                        <td style="width: 200px;">العنوان</td>
                        <td style="width: 200px;">النموذج</td>
                        <td style="width: 200px;">تحميل</td>
                        <td style="width: auto;"></td>
                    </tr>
                </thead>
                <tr>
                    <td>
                        الملخص-اللغة العربية
                    </td>
                    <td>
                        <a href="#">
                            نموذج الملخص-اللغة العربية
                        </a>
                    </td>
                    <td>
                        <div id='arAbsUpload'></div>
                    </td>
                    <td>
                        <div id="log1" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        الملخص - اللغة الانجليزية
                    </td>
                    <td>
                        <a href="#">
                            نموذج الملخص-اللغة الانجلزية
                        </a>
                    </td>
                    <td>
                        <div id='enAbsUpload'></div>
                    </td>
                    <td>
                        <div id="log2" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        مقدمة المشروع
                    </td>
                    <td>
                        <a href="#">
                            نموذج-مقدمة المشروع
                        </a>
                    </td>
                    <td>
                        <div id='introUpload'></div>
                    </td>
                    <td>
                        <div id="log3" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        المسح الأدبي
                    </td>
                    <td>
                        <a href="#">
                            نموذج-المسح الادبي
                        </a>
                    </td>
                    <td>
                        <div id='reviewUpload'></div>
                    </td>
                    <td>
                        <div id="log4" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
            </table>
        </fieldset>
    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
