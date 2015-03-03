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
    $objective_approach = $obj->GetObjective_approach_url($projectId);
    $objective_tasks = $obj->GetObjective_tasks_url($projectId);
    $working_plan = $obj->GetWorkingPlanUrl($projectId);
    $value_to_kingdom = $obj->GetValueToKingdomUrl($projectId);
    $budget = $obj->GetBudgetUrl($projectId);
    $outcome_objective = $obj->GetOutcomeObjectiveUrl($projectId);
    $refs_url = $obj->GetRefsUrl($projectId);
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
                $('#arAbsUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=arAbsUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }});
                $('#arAbsUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                    console.log(fileName);
                });
                $('#enAbsUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=enAbsUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf',
                    localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }});
                $('#enAbsUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });
                $('#introUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=introUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }});
                $('#introUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });
                $('#reviewUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=reviewUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }});
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
                $('#research_method_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=research_method&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }, accept: 'application/pdf'});
                $('#research_method_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#research_method_upload_log').html(serverResponce);
                });
                //Objective Approach FileUpload with Event handler.....
                $('#objective_approach_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=objective_approach&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }, accept: 'application/pdf'});
                $('#objective_approach_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var serverResponce = args.response;
                    $('#objective_approach_upload_log').html(serverResponce);
                });
                //Objective tasks FileUpload with event handler....
                $('#objective_tasks_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=objective_tasks&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }, accept: 'application/pdf'});
                $('#objective_tasks_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var serverResponce = args.response;
                    $('#objective_tasks_upload_log').html(serverResponce);
                });
                //working plan FileUpload with event handler....
                $('#working_plan_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=working_plan&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }, accept: 'application/pdf'});
                $('#working_plan_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var serverResponce = args.response;
                    $('#working_plan_upload_log').html(serverResponce);
                });
                //---------------------------------------------value_to_kingdom_upload 
                $('#value_to_kingdom_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=value_to_kingdom&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }, accept: 'application/pdf'});
                $('#value_to_kingdom_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var serverResponce = args.response;
                    $('#value_to_kingdom_upload_log').html(serverResponce);
                });
                //---------------------------------budget_upload
                $('#budget_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=budget&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }, accept: 'application/pdf'});
                $('#budget_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var serverResponce = args.response;
                    $('#budget_upload_log').html(serverResponce);
                });
                //------------outcome_objectives_upload
                $('#outcome_objectives_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=outcome_objectives&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }, accept: 'application/pdf'});
                $('#outcome_objectives_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var serverResponce = args.response;
                    $('#outcome_objectives_upload_log').html(serverResponce);
                });
                //------------------------ref_upload 
                $('#ref_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=refs&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
                        browseButton: 'استعراض',
                        uploadButton: 'تحميل الملف',
                        cancelButton: 'الغاء',
                        uploadFileTooltip: 'تحميل الملف',
                        cancelFileTooltip: 'الغاء التحميل'
                    }, accept: 'application/pdf'});
                $('#ref_upload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var serverResponce = args.response;
                    $('#ref_upload_log').html(serverResponce);
                });
                CheckFiles('<? echo $projectId; ?>');
            });</script>
        <script type="text/javascript">
            //Check Files
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
                            url: 'ajax/checkArabicAbstractUpload.php?q=' + projectId,
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
                            url: 'ajax/checkEngAbstractUpload.php?q=' + projectId,
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
                            url: 'ajax/checkIntroUpload.php?q=' + projectId,
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
                            url: 'ajax/checkLitReviewUpload.php?q=' + projectId,
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
                            url: 'ajax/check_research_methodology.php?q=' + projectId,
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
                    تحميل الملفات
                </label>
            </legend>
            <table style="direction: rtl;border: 1px;width: 100%;">
                <tr style="margin-top: 25px;">
                    <td>
                        الملخص-اللغة العربية / Abstract in Arabic
                        <span class="required">*</span>
                    </td>
                    <td>
                        <a href="#">
                            نموذج الملخص-اللغة العربية/ Template
                        </a>
                    </td>
                    <td>
                        <div id='arAbsUpload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($arabicAbs) > 0) {

                            echo '<a href = "' . '../' . $arabicAbs . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="log1" style="width: 100%;height: auto;"></div>
                    </td>

                </tr>
                <tr>
                    <td>
                        الملخص - اللغة الانجليزية / Abstract in English
                        <span class="required">*</span>
                    </td>
                    <td>
                        <a href="#">
                            نموذج الملخص-اللغة الانجلزية / Template
                        </a>
                    </td>
                    <td>
                        <div id='enAbsUpload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($engAbs) > 0) {

                            echo '<a href = "' . '../' . $engAbs . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="log2" style="width: 100%;height: auto;"></div>
                    </td>

                </tr>
                <tr>
                    <td>
                        مقدمة المشروع / Introduction 
                        <span class="required">*</span>
                    </td>
                    <td>
                        <a href="#">
                            نموذج-مقدمة المشروع / Template
                        </a>
                    </td>
                    <td>
                        <div id='introUpload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($intro) > 0) {

                            echo '<a href = "' . '../' . $intro . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="log3" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        المسح الأدبي / Literature Review
                        <span class="required">*</span>
                    </td>
                    <td>
                        <a href="#">
                            نموذج-المسح الادبي / Template
                        </a>
                    </td>
                    <td>
                        <div id='reviewUpload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($review) > 0) {
                            echo '<a href = "' . '../' . $review . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="log4" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        منهجية البحث / Research Methodology
                        <span class="required">*</span>
                    </td>
                    <td>
                        <a href="#">
                            نموذج-منهجية البحث / Template
                        </a>
                    </td>
                    <td>
                        <div id='research_method_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($research_method) > 0) {
                            echo '<a href = "' . '../' . $research_method . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="research_method_upload_log" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>

                <tr style="display: none;">
                    <td>
                        أهداف المشروع / Objectives 
                    </td>
                    <td>
                        <a href="#">
                            نموذج-أهداف المشروع/ Template
                        </a>
                    </td>
                    <td>
                        <div id='objective_approach_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($objective_approach) > 0) {
                            echo '<a href="' . '../' . $objective_approach . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="objective_approach_upload_log" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>

                <tr style="display: none;">
                    <td>
                        المهام و الأهداف   / Tasks and Objectives 
                    </td>
                    <td>
                        <a href="#">
                            نموذج-المهام و الاهداف / Template
                        </a>
                    </td>
                    <td>
                        <div id='objective_tasks_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($objective_tasks) > 0) {
                            echo '<a href="' . '../' . $objective_tasks . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="objective_tasks_upload_log" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>

                <tr style="display: none;">
                    <td>
                        خطة العمل / Working Plan
                    </td>
                    <td>
                        <a href="#">
                            نموذج-خطة العمل / Template
                        </a>
                    </td>
                    <td>
                        <div id='working_plan_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($working_plan) > 0) {
                            echo '<a href="' . '../' . $working_plan . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="working_plan_upload_log" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>

                <tr style="display: none;">
                    <td>
                        الأهمية للمملكة  / Value to Kingdom
                        <span class="required">*</span>
                    </td>
                    <td>
                        <a href="#">
                            نموذج-الاهمية للمملكة / Template
                        </a>
                    </td>
                    <td>
                        <div id='value_to_kingdom_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($value_to_kingdom) > 0) {
                            echo '<a href="' . '../' . $value_to_kingdom . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="value_to_kingdom_upload_log" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>

                <tr style="display: none;">
                    <td>
                        الميزانية / Budget
                    </td>
                    <td>
                        <a href="#">
                            نموذج-الميزانية / Template
                        </a>
                    </td>
                    <td>
                        <div id='budget_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($budget) > 0) {
                            echo '<a href="' . '../' . $budget . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="budget_upload_log" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>

                <tr style="display: none;">
                    <td>
                        المخرجات و الاهداف / Outcomes and Objectives 
                    </td>
                    <td>
                        <a href="#">
                            نموذج-المخرجات و الاهداف / Template
                        </a>
                    </td>
                    <td>
                        <div id='outcome_objectives_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($outcome_objective) > 0) {
                            echo '<a href="' . '../' . $outcome_objective . '"/>تحميل</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <div id="outcome_objectives_upload_log" style="width: 100%;height: auto;"></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        المراجع العلمية/ References 
                        <span class="required">*</span>
                    </td>
                    <td>
                        <a href="#">
                            نموذج المراجع العلمية / References Template
                        </a>
                    </td>
                    <td>
                        <div id='ref_upload'></div>
                    </td>
                    <td>
                        <?
                        if (strlen($refs_url) > 0) {
                            echo '<a href = "' . '../' . $refs_url . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                        }
                        ?>

                    </td>
                    <td>
                        <div id="ref_upload_log" style="width: 100%;height: auto;"></div>
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
                    <a id="submit_button" onclick="CheckFiles('<? echo $projectId; ?>')
                                    ;" href="#" style="float: right;margin-left: 25px;margin-top: 20px;">
                        <img src="images/next.png" style="border: none;" alt="next"/>

                    </a>
                </td>
                <td>
                    <a href="research_submit.php?q=<? echo $projectId; ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
                        <img src="images/back.png" style="border: none;" alt="back"/>

                    </a>
                </td>
            </tr>
        </table>
    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
