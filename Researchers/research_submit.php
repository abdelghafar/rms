<?
session_start();
clearstatcache();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Researcher') {
        header('Location:../login.php');
    }
}
require_once '../js/fckeditor/fckeditor.php';
require_once '../lib/CenterResearch.php';
require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/Reseaches.php';
require_once '../lib/users.php';


if (isset($_SESSION['q'])) {
    $projectId = $_SESSION['q'];
    $obj = new Reseaches();
    $UserId = $_SESSION['User_Id'];
    $u = new Users();
    $personId = $_SESSION['person_id'];
    $isAuthorized = $obj->IsAuthorized($projectId, $personId);
    $CanEdit = $obj->CanEdit($projectId);
    if ($isAuthorized == 1 && $CanEdit == 1 && $projectId != 0) {
        $project = $obj->GetResearch($projectId);
        $title_ar = $project['title_ar'];
        $title_en = $project['title_en'];
        $duration = $project['proposed_duration'];
        $techId = $project['center_id'];
        $major_field_id = $project['major_field'];
        $speical_field_id = $project['special_field'];
        $type_id = $project['type_id'];
        $keywords = $project['keywords'];
    } else {
//        echo '<div class="errormsgbox" style="width: 850px;height: 30px;"><h4>This project is locked from the admin</h4></div>';
//        exit();
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
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');
$smarty->display('../templates/Loggedin.tpl');
?>

    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <META HTTP-EQUIV="expires" CONTENT="0">
    <link rel="stylesheet" href="../common/css/reigster-layout.css"/>
    <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script>
    <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>

    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnumberinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
    <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/fckeditor/fckeditor.js"></script>
    <link href="../common/css/MessageBox.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#submit_button').click(function () {
                $.ajax({
                    url: "inc/research_submit.inc.php" + '<? if (isset($projectId)) echo '?q=' . $projectId; ?>',
                    type: "post",
                    datatype: "html",
                    data: $("#researchSubmitForm").serialize(),
                    success: function (data) {
                        $('#Result').html(data);
                    }
                });
            });
            $(".textbox").jqxInput({rtl: true, height: 25, width: 605, minLength: 1, theme: 'energyblue'});

            $("#proposed_reports_count").val(function () {
                return $("#proposed_reports_count").jqxMaskedInput('value');
            });
            $('#sendButton').on('click', function () {
                $('#researchSubmitForm').jqxValidator('validate');
            });
            $('#sendButton').on('click', function () {
                $('#researchSubmitForm').submit();
            });
            var durationDS = {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'duration_title'},
                    {name: 'duration_month'}
                ],
                url: '../Data/durations.php'
            };
            var ResearchCenterDataSource = {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'title'}
                ],
                url: '../Data/technologies.php'
            };
            var TracksDataSource = {
                datatype: "json",
                datafields: [
                    {name: 'track_id'},
                    {name: 'track_name'}
                ],
                url: '../Data/tracks.php?tech_id=' + $("#technologies").val()
            };
            var SubtrackracksDataSource = {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'subTrack_name'}
                ],
                url: '../Data/tracks.php?track_id=' + $("#track").val()
            };
            var ProjectTypesDataSource = {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'title'}
                ],
                url: '../Data/projecttypes.php'
            };
            var dataAdapter = new $.jqx.dataAdapter(durationDS);
            $("#durationList").jqxDropDownList({source: dataAdapter, selectedIndex: 0, width: '200px', height: '25px', displayMember: 'duration_title', valueMember: 'duration_month', theme: 'energyblue', rtl: true});
            $('#durationList').on('change', function (event) {
                var args = event.args;
                if (args) {
                    // index represents the item's index.
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    $('#proposed_duration').val(value);
                    //alert('proposed_duration is :' + $("#durationList").val());
                }
            });

            $("#durationList").on('bindingComplete', function (event) {
                $('#durationList').val('<?
if (isset($projectId)) {
    echo $duration;
}
?>');
            });

            dataAdapter = new $.jqx.dataAdapter(ResearchCenterDataSource);
            $("#technologies").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'title', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر الاولوية"});
            $('#technologies').on('change', function (event) {
                var args = event.args;
                if (args) {
                    // index represents the item's index.
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    //var label = item.label;
                    var value = item.value;
                    $('#technologiesVal').val(value);
                    //alert('centers is:' + $("#technologies").val());
                    TracksDataSource = {
                        datatype: "json",
                        datafields: [
                            {name: 'track_id'},
                            {name: 'track_name'}
                        ],
                        url: '../Data/tracks.php?tech_id=' + $("#technologies").val()
                    };

                    dataAdapter = new $.jqx.dataAdapter(TracksDataSource);
                    $("#track").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'track_name', valueMember: 'track_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص العام"});
                }
            });
            $("#technologies").on('bindingComplete', function (event) {
                $('#technologies').val('<?
if (isset($projectId)) {
    echo $techId;
}
?>');
            });
            //-----------------------------------------------------------------
            dataAdapter = new $.jqx.dataAdapter(TracksDataSource);
            $("#track").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'track_name', valueMember: 'track_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص العام"});
            $('#track').on('change', function (event) {
                var args = event.args;
                if (args) {
                    // index represents the item's index.
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    $('#trackVal').val(value);
                    SubtrackracksDataSource = {
                        datatype: "json",
                        datafields: [
                            {name: 'seq_id'},
                            {name: 'subTrack_name'}
                        ],
                        url: '../Data/subtracks.php?track_id=' + $("#track").val()
                    };
                    dataAdapter = new $.jqx.dataAdapter(SubtrackracksDataSource);
                    $("#subtrack").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'subTrack_name', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص الدقيق"});
                }
            });
            $("#track").on('bindingComplete', function (event) {
                $('#track').val('<?
if (isset($projectId)) {
    echo $major_field_id;
}
?>');
            });
            dataAdapter = new $.jqx.dataAdapter(SubtrackracksDataSource);
            $("#subtrack").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'subTrack_name', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص الدقيق"});
            $('#subtrack').on('change', function (event) {
                var args = event.args;
                if (args) {
                    // index represents the item's index.
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    $('#subtrackVal').val(value);
                    //alert('subtrackVal is :' + $("#subtrackVal").val());
                }
            });
            $("#subtrack").on('bindingComplete', function (event) {
                $('#subtrack').val('<?
if (isset($projectId)) {
    echo $speical_field_id;
}
?>');
            });

            dataAdapter = new $.jqx.dataAdapter(ProjectTypesDataSource);
            $("#projecttype").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'title', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر نوع المشروع"});
            $('#projecttype').on('change', function (event) {
                var args = event.args;
                if (args) {
                    // index represents the item's index.
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    $('#projecttypeVal').val(value);
                    //alert('subtrackVal is :' + $("#subtrackVal").val());
                }
            });
            $("#projecttype").on('bindingComplete', function (event) {
                $('#projecttype').val('<?
if (isset($projectId)) {
    echo $type_id;
}
?>');
            });

        });</script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#researchSubmitForm').jqxValidator({rules: [
                {input: '#title_ar', message: 'من فضلك ادخل عنوان  البحث باللغة العربية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#title_en', message: 'من فضلك ادخل عنوان البحث باللغة الانجليزية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {
                    input: "#technologies", message: "من فضلك اختر مجال البحث", action: 'blur', rule: function (input, commit) {
                    var index = $("#technologies").jqxDropDownList('getSelectedIndex');
                    return index !== -1;
                }
                },
                {
                    input: "#track", message: "من فضلك اختر التخصص العام", action: 'blur', rule: function (input, commit) {
                    var index = $("#track").jqxDropDownList('getSelectedIndex');
                    return index !== -1;
                }
                },
                {
                    input: "#subtrack", message: "من فضلك اختر التخصص الدقيق", action: 'blur', rule: function (input, commit) {
                    var index = $("#subtrack").jqxDropDownList('getSelectedIndex');
                    return index !== -1;
                }
                },
                {
                    input: "#projecttype", message: "من فضلك اختر نوع المشروع", action: 'blur', rule: function (input, commit) {
                    var index = $("#projecttype").jqxDropDownList('getSelectedIndex');
                    return index !== -1;
                }
                }

            ], theme: 'energyblue', animation: 'fade'
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
    <title>
        بحث جديد
    </title>
    <style type="text/css">
        .demo-iframe {
            border: none;
            width: 900px;
            height: 150px;
        }
    </style>
    </head>

    <center>

        <form method="POST" id="researchSubmitForm" enctype="multipart/form-data">

            <div>
                <?
                require_once 'wizard_steps.php';
                ?>
            </div>
            <script type="text/javascript">
                wizard_step(1);
            </script>

            <fieldset style="width: 97%;text-align: right;">
                <legend>
                    <label>
                        معلومات عامة / General information
                    </label>
                </legend>


                <table style="width: 100%;">
                    <tr>
                        <td>
                            العنوان بالعربي/Arabic title
                            <span class="required">*</span>
                        </td>
                        <td>
                            <input id="title_ar" class="textbox" type="text" placeholder="عنوان البحث باللغة العربية"
                                   name="title_ar" value="<?
                            if (isset($projectId)) {
                                echo $title_ar;
                            }
                            ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            العنوان بالإنجليزي /English title
                            <span class="required">*</span>
                        </td>
                        <td>
                            <input id="title_en" class="textbox" type="text"
                                   placeholder="عنوان البحث - اللغة الانجليزية" name="title_en" value="<?
                            if (isset($projectId)) {
                                echo $title_en;
                            }
                            ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            المدة/ Duration
                            <span class="required">*</span>
                        </td>
                        <td>
                            <div id='durationList' style="vertical-align: middle"></div>
                            <input type="hidden" id="proposed_duration" name="proposed_duration"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            مجال البحث/Priority
                            <span class="required">*</span>
                        </td>
                        <td>
                            <div id='technologies'></div>
                            <input type="hidden" id='technologiesVal' name="technologiesVal"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            التخصص العام/Track
                            <span class="required">*</span>
                        </td>
                        <td>
                            <div id="track"></div>
                            <input type="hidden" name="trackVal" id="trackVal"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            التخصص الدقيق/Sub-track
                            <span class="required">*</span>
                        </td>
                        <td>
                            <div id="subtrack"></div>
                            <input type="hidden" name="subtrackVal" id="subtrackVal"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            نوع المشروع/Project Type
                            <span class="required">*</span>
                        </td>
                        <td>
                            <div id='projecttype'></div>
                            <input type="hidden" id='projecttypeVal' name="projecttypesVal"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            الكلمات الرئيسية/Keywords
                            <span class="required">*</span>
                        </td>
                        <td>
                            <input id="keywords" class="textbox" type="text" placeholder="الكلمات الرئيسية/Keywords"
                                   name="keywords" value="<?
                            if (isset($projectId)) {
                                echo $keywords;
                            }
                            ?>"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <div id="Result" style="width: 800px; height: 50px;">

            </div>
            <table style="width: 100%;">
                <tr>
                    <td valign="middle">
                        <a id="submit_button" href="#" style="float: left;margin-top: 20px;">
                            <img src="images/next.png" style="border: none;" alt="next"/>
                        </a>
                    </td>
                </tr>
            </table>
        </form>
    </center>
<?
$smarty->display('../templates/footer.tpl');
