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
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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

    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
    <script type="text/javascript">
        $(document).ready(function () {
            $('#submit_button').click(function () {
                $.ajax({
                    url: "inc/research_submit.inc.php",
                    type: "post",
                    datatype: "html",
                    data: $("#researchSubmitForm").serialize(),
                    success: function (data) {
                        $('#Result').html(data);
                    }
                });
            });

            $(".textbox").jqxInput({rtl: true, height: 25, width: 605, minLength: 1, theme: 'energyblue'});

            $("#proposed_duration").jqxMaskedInput({rtl: true, width: '100px', height: '25px', mask: '##', theme: 'energyblue'});
            //$("#major_field").jqxInput({rtl: true, height: 25, width: 120, minLength: 2, theme: 'energyblue'});
            //$("#special_field").jqxInput({rtl: true, height: 25, width: 110, minLength: 2, theme: 'energyblue'});
            //$(".small_textbox").jqxInput({rtl: true, height: 25, width: 110, minLength: 2, theme: 'energyblue'});
            $("#currencyInput").jqxNumberInput({rtl: true, width: '100px', height: '25px', min: 0, max: 300000, theme: 'energyblue', inputMode: 'simple', decimalDigits: 0, digits: 6, spinButtons: true});
            $('#budgetValue').val($("#currencyInput").jqxNumberInput('getDecimal'));
            //alert('Currencey Value is:' + $("#currencyInput").jqxNumberInput('getDecimal'));
            $('#currencyInput').on('change', function (event) {
                var value = event.args.value;
                $('#budgetValue').val(value);
                //alert('Currencey Value is:' + $("#currencyInput").jqxNumberInput('getDecimal'));

            });

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


            var dataAdapter = new $.jqx.dataAdapter(durationDS);
            $("#durationList").jqxDropDownList({source: dataAdapter, selectedIndex: 0, width: '100px', height: '25px', displayMember: 'duration_title', valueMember: 'duration_month', theme: 'energyblue', rtl: true});

            $('#durationList').on('change', function (event)
            {
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

            dataAdapter = new $.jqx.dataAdapter(ResearchCenterDataSource);
            $("#technologies").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '200px', height: '30px', displayMember: 'title', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر الاولوية"});

            $('#technologies').on('change', function (event)
            {
                var args = event.args;
                if (args) {
                    // index represents the item's index.                      
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    $('#technologiesVal').val(value);
                    alert('centers is:' + $("#technologies").val());
                    TracksDataSource = {
                        datatype: "json",
                        datafields: [
                            {name: 'track_id'},
                            {name: 'track_name'}
                        ],
                        url: '../Data/tracks.php?tech_id=' + $("#technologies").val()
                    };
                    dataAdapter = new $.jqx.dataAdapter(TracksDataSource);
                    $("#track").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '200px', height: '30px', displayMember: 'track_name', valueMember: 'track_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص العام"});
                }
            });

            //-----------------------------------------------------------------
            dataAdapter = new $.jqx.dataAdapter(TracksDataSource);
            $("#track").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '200px', height: '30px', displayMember: 'track_name', valueMember: 'track_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص العام"});

            $('#track').on('change', function (event)
            {
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
                    $("#subtrack").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '200px', height: '30px', displayMember: 'subTrack_name', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص الدقيق"});
                }
            });
            dataAdapter = new $.jqx.dataAdapter(SubtrackracksDataSource);
            $("#subtrack").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '200px', height: '30px', displayMember: 'subTrack_name', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص الدقيق"});
            $('#subtrack').on('change', function (event)
            {
                var args = event.args;
                if (args) {
                    // index represents the item's index.                      
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    $('#subtrackVal').val(value);
                    alert('subtrackVal is :' + $("#subtrackVal").val());
                }
            });


        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#researchSubmitForm').jqxValidator({rules: [
                    {input: '#title_ar', message: 'من فضلك ادخل عنوان  البحث باللغة العربية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                    {input: '#title_en', message: 'من فضلك ادخل عنوان البحث باللغة الانجليزية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                    {
                        input: "#technologies", message: "من فضلك اختر أولوية البحث", action: 'blur', rule: function (input, commit) {
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
                    }

                ], theme: 'energyblue', animation: 'fade'
            });
        });


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
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    بيانات البحث
                </label>
            </legend>
            <table style="width: 100%;">
                <tr>
                    <td>
                        عنوان البحث-اللغة العربية
                        <span class="required">*</span>
                    </td>
                    <td>
                        <input id="title_ar" class="textbox" type="text" placeholder="عنوان البحث باللغة العربية" name="title_ar"/>  
                    </td>
                </tr>
                <tr>
                    <td>
                        عنوان البحث - اللغة الانجليزية
                        <span class="required">*</span>
                    </td>
                    <td>
                        <input id="title_en" class="textbox" type="text" placeholder="عنوان البحث - اللغة الانجليزية" name="title_en"/>  
                    </td>
                </tr>
                <tr>
                    <td>
                        المدة المقترحة بالشهر
                        <span class="required">*</span>
                    </td>
                    <td>
                        <div id='durationList' style="vertical-align: middle"></div>
                        <input type="hidden" id="proposed_duration" name="proposed_duration"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        الميزانية المقترحة
                        <span class="required">*</span>
                    </td>
                    <td>
                        <div id='currencyInput' style="vertical-align: middle">
                            <input type='hidden' id='budgetValue' name="budgetValue"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        اولوية البحث
                    </td>
                    <td>
                        <div id='technologies'></div>
                        <input type="hidden" id='technologiesVal' name="technologiesVal"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        التخصص العام
                    </td>
                    <td>
                        <div id="track"></div>
                        <input type="hidden" name="trackVal" id="trackVal"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        التخصص الدقيق
                    </td>
                    <td>
                        <div id="subtrack"></div>
                        <input type="hidden" name="subtrackVal" id="subtrackVal"/>
                    </td>
                </tr>
            </table>





        </fieldset>
        <div id="Result" style="width: 800px; height: 50px;">

        </div>
        <table style="width: 100%;">
            <tr>
                <td>
                    <a id="submit_button" href="#" style="float: right;margin-left: 25px;margin-top: 20px;">next</a>
                </td>
                <td>
                    <a href="index.php?program=<? echo $_SESSION['program'] ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
                        رجوع
                    </a>
                </td>
            </tr>
        </table>
    </form>
    <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe>

</center>
<?
$smarty->display('../templates/footer.tpl');
