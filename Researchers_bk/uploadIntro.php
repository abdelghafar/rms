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
require_once '../lib/Reseaches.php';
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
    $obj = new Reseaches();
    $program = $_SESSION['program'];

    $arabicAbs = $obj->GetAbstract_ar_url($projectId);
    $engAbs = $obj->GetAbstract_en_url($projectId);
    $intro = $obj->GetIntro_url($projectId);
    $review = $obj->GetLitReview_url($projectId);
    $research_method = $obj->GetResearch_method_url($projectId);
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
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnotification.js"></script>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <link href="../common/css/reigster-layout.css" rel="stylesheet" type="text/css"/>
        <link href="../common/css/MessageBox.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#submit_button').click(function () {
                    $.ajax({
                        url: "inc/uploadIntro.inc.php?q=" + '<? echo $projectId; ?>',
                        type: "post",
                        datatype: "html",
                        success: function (data) {
                            $('#result').show();
                            $('#result').html(data);
                        }
                    });
                });
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

                $('#research_method_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=research_method&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});
                $('#research_method_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#research_method_upload_log').html(serverResponce);
                });

                CheckFiles('<? echo $projectId; ?>');
            });</script>
        <script type="text/javascript">
            var arabic_abs_file = 0;
            var eng_abs_file = 0;
            var intro_file = 0;
            var lit_review_file = 0;
            var research_method_url = 0;
            function CheckFiles(projectId)
            {
                $(document).ready(function () {
                    var msg = "";
                    if (projectId !== '') {
                        $.ajax({
                            url: 'ajax/checkArabicAbstractUpload?q=' + projectId,
                            data: {url: projectId},
                            dataType: 'JSON',
                            type: 'POST',
                            cache: false,
                            success: function (result) {
                                if (result == 1) {
                                    arabic_abs_file = 1;
                                    //alert('arabic_abs_file:' + arabic_abs_file);
                                }
                                else {
                                    arabic_abs_file = 0;
                                    //alert('arabic_abs_file:' + arabic_abs_file);
                                    msg += 'Please upload the arabic abstract';
                                }
                                console.log(arabic_abs_file);
                            },
                            error: function (err) {
                                console.log(err);
                            }
                        });
                        $.ajax({
                            url: 'ajax/checkEngAbstractUpload?q=' + projectId,
                            data: {url: projectId},
                            dataType: 'JSON',
                            type: 'POST',
                            cache: false,
                            success: function (result) {
                                if (result == 1) {
                                    eng_abs_file = 1;
                                }
                                else {
                                    eng_abs_file = 0;
                                    msg += 'Please upload the english abstract';
                                }
                                console.log(eng_abs_file);
                            },
                            error: function (err) {

                            }
                        });
                        $.ajax({
                            url: 'ajax/checkIntroUpload?q=' + projectId,
                            data: {url: projectId},
                            dataType: 'JSON',
                            type: 'POST',
                            cache: false,
                            success: function (result) {
                                if (result == 1) {
                                    intro_file = 1;
                                }
                                else {
                                    msg += 'Please upload the introduction';
                                    intro_file = 0;
                                }
                                console.log(intro_file);
                            },
                            error: function (err) {

                            }
                        });
                        $.ajax({
                            url: 'ajax/checkLitReviewUpload?q=' + projectId,
                            data: {url: projectId},
                            dataType: 'JSON',
                            type: 'POST',
                            cache: false,
                            success: function (result) {
                                if (result == 1) {
                                    lit_review_file = 1;
                                }
                                else {
                                    msg += 'Please upload the Review';
                                    lit_review_file = 0;
                                }

                            },
                            error: function (err) {

                            }
                        });
                        $.ajax({
                            url: 'ajax/check_research_methodology?q=' + projectId,
                            data: {url: projectId},
                            dataType: 'JSON',
                            type: 'POST',
                            cache: false,
                            success: function (result) {
                                if (result == 1) {
                                    research_method_url = 1;
                                }
                                else {
                                    msg += 'Please upload the Review';
                                    research_method_url = 0;
                                }

                            },
                            error: function (err) {

                            }
                        });

                    }
                });
            }
        </script>
    </head>
    <body>     
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    بيانات البحث
                </label>
            </legend>
            <table style="direction: rtl;border: 1px;width: 100%;">

                <thead style="font-size: medium;font-weight: bold;">
                    <tr style="margin-bottom: 25px;">
                        <td style="width: 200px;">العنوان</td>
                        <td style="width:100px;">النموذج</td>
                        <td style="width: 150px;">تحميل</td>
                        <td style="width: 100px;"></td>
                        <td style="width: auto;"></td>
                    </tr>
                </thead>
                <tr>
                    <td>
                        الملخص-اللغة العربية
                        <span class="required">*</span>
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
                        <?
                        if (strlen($arabicAbs) > 0) {
                            echo '<a href="' . '../' . $arabicAbs . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="log1" style="width: 100%;height: auto;"></div>
                    </td>

                </tr>
                <tr>
                    <td>
                        الملخص - اللغة الانجليزية
                        <span class="required">*</span>
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
                        <?
                        if (strlen($engAbs) > 0) {
                            echo '<a href="' . '../' . $engAbs . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="log2" style="width: 100%;height: auto;"></div>
                    </td>

                </tr>
                <tr>
                    <td>
                        مقدمة المشروع
                        <span class="required">*</span>
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
                        <?
                        if (strlen($intro) > 0) {
                            echo '<a href="' . '../' . $intro . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="log3" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        المسح الأدبي
                        <span class="required">*</span>
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
                        <?
                        if (strlen($review) > 0) {
                            echo '<a href="' . '../' . $review . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="log4" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        منهجية البحث
                        <span class="required">*</span>
                    </td>
                    <td>
                        <a href="#">
                            نموذج-منهجية البحث
                        </a>
                    </td>
                    <td>
                        <div id='research_method_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($research_method) > 0) {
                            echo '<a href="' . '../' . $research_method . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="research_method_upload_log" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div id="result" class="errormsgbox" style="width: 700px;height:auto;display: none;">
                            <p>
                                يجب تحميل جميع الملفات
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
        <table style="width: 100%;">
            <tr>
                <td>
                    <a id="submit_button" onclick="CheckFiles('<? echo $projectId; ?>');" href="#" style="float: right;margin-left: 25px;margin-top: 20px;">next</a>
                </td>
                <td>
                    <a href="research_submit.php?program=<? echo $_SESSION['program'] . '&q=' . $projectId ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
                        رجوع
                    </a>
                </td>
            </tr>
        </table>
    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
