<?
session_start();

if ($_SESSION['Authorized'] == null) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
} else if ($_SESSION['Authorized'] == 0) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
}

require_once '../js/fckeditor/fckeditor.php';
require_once '../lib/Reseaches.php';
require_once '../lib/persons.php';
require_once '../lib/users.php';
require_once '../lib/Smarty/libs/Smarty.class.php';
$projectId = null;

//Check Authorization  
if (isset($_SESSION['q'])) {
    $projectId = $_SESSION['q'];
    $obj = new Reseaches();
    $program = $_SESSION['program'];
    $personId = $_SESSION['person_id'];
    $person = new Persons();
    $isAuthorized = $obj->IsAuthorized($projectId, $personId);
    $CanEdit = $obj->CanEdit($projectId);
    if ($isAuthorized == 1 && $CanEdit == 1) {
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
        $ResumeUrl = $person->GetResumeUrl($personId);
        $finishing_scholarship_url = $person->GetFinishingScholarshipUrl($personId);
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
$smarty->assign('Researchers_register_php', '../Researchers/register.php');
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
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">

    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>

    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxfileupload.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnotification.js"></script>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
    <link href="../common/css/reigster-layout.css" rel="stylesheet" type="text/css"/>
    <link href="../common/css/MessageBox.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">
    $(document).ready(function () {
        var projectId = '<? echo $projectId; ?>';
        $('#submit_button').click(function () {
            $.ajax({
                url: "inc/uploadIntro.inc.php?q=" + '<? echo $projectId; ?>',
                type: "post",
                datatype: "html",
                success: function (data) {
                    if (data != null) {
                        $('#result').show();
                        $('#result').html(data);
                    }
                }
            });
        });

        /*
         arAbsUpload
         */
        $('#arAbsUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=arAbsUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
            browseButton: 'استعراض',
            uploadButton: 'تحميل الملف',
            cancelButton: 'الغاء',
            uploadFileTooltip: 'تحميل الملف',
            cancelFileTooltip: 'الغاء التحميل'
        }});
        $('#arAbsUpload').on('uploadEnd', function (event) {
            var arabic_summary_url;
            var args = event.args;
            var fileName = args.file;
            var serverResponce = args.response;
            //get arabic_summary_url
            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=arabic_summary", success: function (data) {
                    arabic_summary_url = data;
                }
            });
            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=arAbsUpload", type: 'POST', success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#arAbsUpload_log').html('');
                    $('#arabic_summary_url').html('<a id="arabic_summary_url" target="_blank" href = "' + '../' + arabic_summary_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#arabic_summary_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=arabic_summary", success: function (data) {
                            if (data == 1) {
                                $('#arAbsUpload_log').html('');
                                $('#arAbsUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#arAbsUpload_log').html('');
                                $('#arAbsUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});

        });
        /*
         enAbsUpload
         */
        $('#enAbsUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=enAbsUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf',
            localization: {
                browseButton: 'استعراض',
                uploadButton: 'تحميل الملف',
                cancelButton: 'الغاء',
                uploadFileTooltip: 'تحميل الملف',
                cancelFileTooltip: 'الغاء التحميل'
            }});
        $('#enAbsUpload').on('uploadEnd', function (event) {
            var english_summary_url;
            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=english_summary", success: function (data) {
                    english_summary_url = data;
                }
            });
            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=enAbsUpload", type: 'POST', success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#enAbsUpload_log').html('');
                    $('#english_summary_url').html('<a target="_blank" id="english_summary_url" href = "' + '../' + english_summary_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#english_summary_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=english_summary", success: function (data) {
                            if (data == 1) {
                                $('#enAbsUpload_log').html('');
                                $('#enAbsUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#enAbsUpload_log').html('');
                                $('#enAbsUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});
        });
        /*
         introUpload
         */
        $('#introUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=introUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
            browseButton: 'استعراض',
            uploadButton: 'تحميل الملف',
            cancelButton: 'الغاء',
            uploadFileTooltip: 'تحميل الملف',
            cancelFileTooltip: 'الغاء التحميل'
        }});
        $('#introUpload').on('uploadEnd', function (event) {
            var introduction_url;
            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=introduction", success: function (data) {
                    introduction_url = data;
                    console.log("introduction=" + introduction_url);
                }
            });
            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=introUpload", success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#introUpload_log').html('');
                    $('#introduction_url').html('<a id="introduction_url" target="_blank" href = "' + '../' + introduction_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#introduction_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=introduction", success: function (data) {
                            if (data == 1) {
                                $('#introUpload_log').html('');
                                $('#introUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#introUpload_log').html('');
                                $('#introUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});
        });

        /**
         * review
         */
        $('#reviewUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=reviewUpload&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
            browseButton: 'استعراض',
            uploadButton: 'تحميل الملف',
            cancelButton: 'الغاء',
            uploadFileTooltip: 'تحميل الملف',
            cancelFileTooltip: 'الغاء التحميل'
        }});

        $('#reviewUpload').on('uploadEnd', function (event) {
            var review_url;
            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=literature_review", success: function (data) {
                    review_url = data;
                }
            });

            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=reviewUpload", success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#reviewUpload_log').html('');
                    $('#review_url').html('<a id="review_url" target="_blank" href = "' + '../' + review_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#review_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=literature_review", success: function (data) {
                            if (data == 1) {
                                $('#reviewUpload_log').html('');
                                $('#reviewUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#reviewUpload_log').html('');
                                $('#reviewUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});
        });
        /**
         *
         * research_method_upload
         */
        $('#research_method_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=research_method&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
            browseButton: 'استعراض',
            uploadButton: 'تحميل الملف',
            cancelButton: 'الغاء',
            uploadFileTooltip: 'تحميل الملف',
            cancelFileTooltip: 'الغاء التحميل'
        }, accept: 'application/pdf'});
        $('#research_method_upload').on('uploadEnd', function (event) {
            var research_method_url;
            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=research_method", success: function (data) {
                    research_method_url = data;
                }
            });

            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=research_method", success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#research_method_upload_log').html('');
                    $('#research_method_url').html('<a id="introduction_url" target="_blank" href = "' + '../' + research_method_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#research_method_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=research_method", success: function (data) {
                            if (data == 1) {
                                $('#research_method_upload_log').html('');
                                $('#research_method_upload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#research_method_upload_log').html('');
                                $('#research_method_upload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});


        });

        /**
         * Value to kingdom upload
         *
         */

        $('#value_to_kingdom_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=value_to_kingdom&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, localization: {
            browseButton: 'استعراض',
            uploadButton: 'تحميل الملف',
            cancelButton: 'الغاء',
            uploadFileTooltip: 'تحميل الملف',
            cancelFileTooltip: 'الغاء التحميل'
        }, accept: 'application/pdf'});

        $('#value_to_kingdom_upload').on('uploadEnd', function (event) {
            var value_to_kingdom_url;

            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=value_to_kingdom", success: function (data) {
                    value_to_kingdom_url = data;
                }
            });

            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=value_to_kingdom", success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#value_to_kingdom_upload_log').html('');
                    $('#value_to_kingdom_url').html('<a id="value_to_kingdom_url" target="_blank" href = "' + '../' + value_to_kingdom_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#value_to_kingdom_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=value_to_kingdom", success: function (data) {
                            if (data == 1) {
                                $('#value_to_kingdom_upload_log').html('');
                                $('#value_to_kingdom_upload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#value_to_kingdom_upload_log').html('');
                                $('#value_to_kingdom_upload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});


        });

        /**
         * Refs
         */
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
            //$('#ref_upload_log').html(serverResponce);
            var ref_url;
            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=refs", success: function (data) {
                    ref_url = data;
                }
            });

            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=refs", success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#ref_upload_log').html('');
                    $('#ref_url').html('<a id="ref_url" target="_blank" href = "' + '../' + ref_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#ref_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=refs", success: function (data) {
                            if (data == 1) {
                                $('#ref_upload_log').html('');
                                $('#ref_upload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#ref_upload_log').html('');
                                $('#ref_upload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});
        });
        /**
         *ResumeUpload
         *
         */
        $('#ResumeUpload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=resume&q=' + '<? echo $projectId; ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
            browseButton: 'استعراض',
            uploadButton: 'تحميل الملف',
            cancelButton: 'الغاء',
            uploadFileTooltip: 'تحميل الملف',
            cancelFileTooltip: 'الغاء التحميل'
        }});

        $('#ResumeUpload').on('uploadEnd', function (event) {
            var args = event.args;
            var fileName = args.file;
            var serverResponce = args.response;
            var resume_url;
            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=resume", success: function (data) {
                    resume_url = data;
                }
            });
            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=resume", success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#ResumeUpload_log').html('');
                    $('#resume_url').html('<a id="resume_url" target="_blank" href = "' + '../' + resume_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#resume_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=resume", success: function (data) {
                            if (data == 1) {
                                $('#ResumeUpload_log').html('');
                                $('#ResumeUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#ResumeUpload_log').html('');
                                $('#ResumeUpload_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});
        });

        /**
         *finishing_scholarship_url
         */

        $('#finishing_scholarship_url_upload').jqxFileUpload({width: 200, uploadUrl: 'inc/fileUpload.php?type=finishing_scholarship&q=' + '<? echo $projectId ?>', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
            browseButton: 'استعراض',
            uploadButton: 'تحميل الملف',
            cancelButton: 'الغاء',
            uploadFileTooltip: 'تحميل الملف',
            cancelFileTooltip: 'الغاء التحميل'
        }});
        $('#finishing_scholarship_url_upload').on('uploadEnd', function (event) {
            var args = event.args;
            var fileName = args.file;
            var serverResponce = args.response;
            var finishing_scholarship_url;
            $.ajax({
                url: 'ajax/get_file_url.php?q=' + projectId + "&type=finishing_scholarship", success: function (data) {
                    finishing_scholarship_url = data;
                }
            });
            $.ajax({url: 'ajax/checkPDFA.php?q=' + projectId + "&type=finishing_scholarship", success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#finishing_scholarship_url_log').html('');
                    $('#finishing_scholarship_url').html('<a id="finishing_scholarship_url" target="_blank" href = "' + '../' + finishing_scholarship_url + '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>');
                }
                else {
                    $('#finishing_scholarship_url').html('');
                    $.ajax({
                        url: 'ajax/Delete_File.php?q=' + projectId + "&type=finishing_scholarship", success: function (data) {
                            if (data == 1) {
                                $('#finishing_scholarship_url_log').html('');
                                $('#finishing_scholarship_url_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + 'خطأ في تشفير الملف' + '</span>');
                            }
                            else {
                                $('#finishing_scholarship_url_log').html('');
                                $('#finishing_scholarship_url_log').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 14px;">' + data + '</span>');
                            }
                        }
                    });
                }
            }});
        });
        //--------------------------------------------------------------------------------------------------------------

    });</script>
    <script type="text/javascript">
        function wizard_step(current_step) {
            var cs = current_step;
            for (var i = 1; i < cs; i++) {
                $("#img_" + i).attr("src", "images/" + i + "_finished.png");
            }
            $("#img_" + cs).attr("src", "images/" + cs + "_current.png");
            for (var i = cs + 1; i <= 9; i++) {
                $("#img_" + i).attr("src", "images/" + i + "_unfinish.png");
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
        wizard_step(2);
    </script>

    <fieldset style="width: 97%;text-align: right;">
    <legend>
        <label>
            تحميل الملفات
        </label>
    </legend>

    <table style="direction: rtl;border: 1px;width: 100%;">
    <tr style="margin-top: 25px;">
        <td>
            الملخص بالعربي / Arabic Summary
            <span class="required">*</span>
        </td>
        <td>
            <a href="forms/Arabic_Summary.docx" target="_blank">
                النموذج / Template
            </a>
        </td>
        <td>
            <div id='arAbsUpload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="arabic_summary_url">
                <?
                if (strlen($arabicAbs) > 0) {
                    echo '<a id="arabic_summary_url" target="_blank" href = "' . '../' . $arabicAbs . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>
        </td>
        <td>
            <div id="arAbsUpload_log" style="width: 100%;height: auto;"></div>
        </td>

    </tr>
    <tr>
        <td>
            الملخص بالانجليزي / English Summary
            <span class="required">*</span>
        </td>
        <td>
            <a href="forms/English_Summary.docx" target="_blank">
                النموذج / Template
            </a>
        </td>
        <td>
            <div id='enAbsUpload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="english_summary_url">
                <?
                if (strlen($engAbs) > 0) {

                    echo '<a  href = "' . '../' . $engAbs . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>
        </td>
        <td>
            <div id="enAbsUpload_log" style="width: 100%;height: auto;"></div>
        </td>

    </tr>
    <tr>
        <td>
            مقدمة المشروع / Introduction
            <span class="required">*</span>
        </td>
        <td>
            <a href="forms/Introduction.docx" target="_blank">
                النموذج / Template
            </a>
        </td>
        <td>
            <div id='introUpload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="introduction_url">
                <?
                if (strlen($intro) > 0) {

                    echo '<a id="introduction_url" target="_blank" href = "' . '../' . $intro . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>

        </td>
        <td>
            <div id="introUpload_log" style="width: 100%;height: auto;"></div>
        </td>
    </tr>
    <tr>
        <td>
            المسح الأدبي / Literature Review
            <span class="required">*</span>
        </td>
        <td>
            <a href="forms/Literature_Review.docx" target="_blank">
                النموذج / Template
            </a>
        </td>
        <td>
            <div id='reviewUpload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="review_url">
                <?
                if (strlen($review) > 0) {
                    echo '<a id="review_url" target="_blank" href = "' . '../' . $review . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>

        </td>
        <td>
            <div id="reviewUpload_log" style="width: 100%;height: auto;"></div>
        </td>
    </tr>
    <tr>
        <td>
            منهجية البحث / Research Methodology
            <span class="required">*</span>
        </td>
        <td>
            <a href="forms/Research_Methodology.docx" target="_blank">
                النموذج / Template
            </a>
        </td>
        <td>
            <div id='research_method_upload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="research_method_url">
                <?
                if (strlen($research_method) > 0) {
                    echo '<a id="research_method_url" target="_blank" href = "' . '../' . $research_method . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>
        </td>
        <td>
            <div id="research_method_upload_log" style="width: 100%;height: auto;"></div>
        </td>
    </tr>

    <tr>
        <td>
            قيمة المشروع للدولة / Value To Kingdom
            <span class="required">*</span>
        </td>
        <td>
            <a href="forms/Value_to_Kingdom.docx" target="_blank">
                النموذج / Template
            </a>
        </td>
        <td>
            <div id='value_to_kingdom_upload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="value_to_kingdom_url">
                <?
                if (strlen($value_to_kingdom) > 0) {
                    echo '<a id="value_to_kingdom_url" target="_blank" href = "' . '../' . $value_to_kingdom . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>

        </td>
        <td>
            <div id="value_to_kingdom_upload_log" style="width: 100%;height: auto;"></div>
        </td>
    </tr>


    <tr>
        <td>
            المراجع العلمية/ References
            <span class="required">*</span>
        </td>
        <td>
            <a href="forms/References.docx" target="_blank">
                النموذج / Template
            </a>
        </td>
        <td>
            <div id='ref_upload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="ref_url">
                <?
                if (strlen($refs_url) > 0) {
                    echo '<a id="ref_url" target="_blank" href = "' . '../' . $refs_url . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>

        </td>
        <td>
            <div id="ref_upload_log" style="width: 100%;height: auto;"></div>
        </td>
    </tr>

    <tr>
        <td>
            السيرة الذاتية / Resume
            <span class="required">*</span>
        </td>
        <td>
            <a href="forms/CV.docx" target="_blank">
                النموذج / Template
            </a>
        </td>
        <td>
            <div id='ResumeUpload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="resume_url">
                <?
                if (strlen($ResumeUrl) > 0) {
                    echo '<a id="resume_url" target="_blank" href = "' . '../' . $ResumeUrl . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>

        </td>
        <td>
            <div id="ResumeUpload_log" style="width: 100%;height: auto;"></div>
        </td>
    </tr>

    <tr>
        <td>
            اقرار انهاء البعثة

        </td>
        <td></td>
        <td>
            <div id='finishing_scholarship_url_upload'></div>
            <div class="classic" style="color: #ff0000">
                يسمح بملفات pdf فقط
            </div>
        </td>
        <td>
            <div id="finishing_scholarship_url">
                <?
                if (strlen($finishing_scholarship_url) > 0) {
                    echo '<a id="finishing_scholarship_url" target="_blank" href = "' . '../' . $finishing_scholarship_url . '"><img src = "images/acroread-2.png" style = "border: none;" alt = ""/></a>';
                }
                ?>
            </div>

        </td>
        <td>
            <div id="finishing_scholarship_url_log" style="width: 100%;height: auto;"></div>
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
                <a href="research_submit.php" style="float: right;margin-top: 20px;">
                    <img src="images/back.png" style="border: none;" alt="back"/>
                </a>
            </td>
            <td>
                <a id="submit_button" onclick="CheckFiles('<? echo $projectId; ?>')
                    ;" href="#" style="float: left;margin-top: 20px;">
                    <img src="images/next.png" style="border: none;" alt="next"/>
                </a>

            </td>
        </tr>
    </table>
    </body>
    </html>
<?
$smarty->display('../templates/footer.tpl');
