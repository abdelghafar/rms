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
    <link rel="stylesheet" href="css/reigster-layout.css"/> 
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
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/globalization/jquery.global.js"></script>
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
            $(".textbox").jqxInput({rtl: true, height: 25, width: 605, minLength: 1, theme: 'energyblue'});

            $("#proposed_duration").jqxMaskedInput({rtl: true, width: '100px', height: '25px', mask: '##', theme: 'energyblue'});

            $("#major_field").jqxInput({rtl: true, height: 25, width: 120, minLength: 2, theme: 'energyblue'});
            $("#special_field").jqxInput({rtl: true, height: 25, width: 110, minLength: 2, theme: 'energyblue'});
            $(".small_textbox").jqxInput({rtl: true, height: 25, width: 110, minLength: 2, theme: 'energyblue'});
            $("#currencyInput").jqxNumberInput({rtl: true, width: '100px', height: '25px', min: 0, max: 300000, theme: 'energyblue', inputMode: 'simple', decimalDigits: 0, digits: 6, spinButtons: true});
            $('#budgetValue').val($("#currencyInput").jqxNumberInput('getDecimal'));
            //alert('Currencey Value is:' + $("#currencyInput").jqxNumberInput('getDecimal'));
            $('#currencyInput').on('change', function (event) {
                var value = event.args.value;
                $('#budgetValue').val(value);
                //alert('Currencey Value is:' + $("#currencyInput").jqxNumberInput('getDecimal'));

            });

            $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});

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
                    {name: 'id'},
                    {name: 'center_name'}
                ],
                url: '../Data/ResearchCenters.php'
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
            $("#centers").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '200px', height: '30px', displayMember: 'center_name', valueMember: 'id', theme: 'energyblue', rtl: true, promptText: "من فضلك اختر التخصص"});

            $('#centers').on('change', function (event)
            {
                var args = event.args;
                if (args) {
                    // index represents the item's index.                      
                    var index = args.index;
                    var item = args.item;
                    // get item's label and value.
                    var label = item.label;
                    var value = item.value;
                    $('#research_center').val(value);
                    //alert('centers is:' + $("#durationList").val());
                }
            });


        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#researchSubmitForm').jqxValidator({rules: [
                    {input: '#title_ar', message: 'من فضلك ادخل عنوان  البحث باللغة العربية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                    {input: '#title_en', message: 'من فضلك ادخل عنوان البحث باللغة الانجليزية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                    {input: '#major_field', message: 'من فضلك ادخل التخصص العام', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                    {input: '#special_field', message: 'من فضلك ادخل التخصص الدقيق', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                    {
                        input: "#centers", message: "من فضلك اختر المركز البحثي", action: 'blur', rule: function (input, commit) {
                            var index = $("#centers").jqxDropDownList('getSelectedIndex');
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
    <form method="POST" id="researchSubmitForm"  target="form-iframe" enctype="multipart/form-data" action="inc/research_submit.inc.php"> 

        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    بيانات البحث
                </label>
            </legend>
            <div class="panel_row">
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                    <p>
                        عنوان البحث-اللغة العربية
                    </p>
                </div>
                <div class="panel-cell">
                    <input id="title_ar" class="textbox" type="text" placeholder="عنوان البحث باللغة العربية" name="title_ar"/>  
                </div>
            </div>
            <div class="panel_row">
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                    <p>
                        عنوان البحث - اللغة الانجليزية
                    </p>
                </div>
                <div class="panel-cell">
                    <input id="title_en" class="textbox" type="text" placeholder="عنوان البحث - اللغة الانجليزية" name="title_en"/>  
                </div>
            </div>
            <div class="panel_row">
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;vertical-align: middle"> 
                    <p>
                        المدة المقترحة بالشهر
                    </p>
                </div>
                <div class="panel-cell" style="vertical-align: middle">
                    <div id='durationList' style="vertical-align: middle"></div>
                    <input type="hidden" id="proposed_duration" name="proposed_duration"/>
                </div>
                <div class="panel-cell" style="width:394px;text-align: left;padding-left:10px;vertical-align: middle"> 
                    <p>
                        الميزانية المقترحة
                    </p>
                </div>
                <div class="panel-cell" style="vertical-align: middle">
                    <div id='currencyInput' style="vertical-align: middle">
                        <input type='hidden' id='budgetValue' name="budgetValue"/>
                    </div>
                </div>
            </div>
            <div class="panel_row">
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;vertical-align: middle"> 
                    <p>
                        التخصص العام
                    </p>
                </div>
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;">
                    <div id='centers'></div>
                    <input type="hidden" id='research_center' name="research_center"/>
                </div>
            </div>
            <div class="panel_row">
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                    <p>
                        مجال البحث
                    </p>
                </div>
                <div class="panel-cell">
                    <input id="major_field" class="textbox" type="text" placeholder="مجال البحث" name="major_field"/>  
                </div>
                <div class="panel-cell" style="width: 363px;text-align: left;padding-left: 10px;"> 
                    <p>
                        المجال الدقيق
                    </p>
                </div>
                <div class="panel-cell">
                    <input id="special_field" class="small_textbox" type="text" placeholder="التخصص الدقيق" name="special_field"/>  
                </div>
            </div>
            <div class="panel_row">
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px; vertical-align:top;"> 
                    <p>
                        الملخص باللغة العربية
                    </p>
                </div>
                <div class="panel-cell">
                    <?
                    $oFCKeditor = new FCKeditor('abstract_ar');
                    $oFCKeditor->Height = "250px";
                    $oFCKeditor->Width = "605px";
                    $oFCKeditor->BasePath = '../js/fckeditor/';
                    $oFCKeditor->ToolbarSet = 'Basic';
                    $oFCKeditor->Create();
                    ?>

                </div>

            </div>
            <div class="panel_row">
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px; vertical-align:top;"> 
                    <p>
                        الملخص باللغة الانجليزية
                    </p>
                </div>
                <div class="panel-cell">
                    <?
                    $oFCKeditor = new FCKeditor('abstract_en');
                    $oFCKeditor->Height = "250px";
                    $oFCKeditor->Width = "605px";
                    $oFCKeditor->BasePath = '../js/fckeditor/';
                    $oFCKeditor->ToolbarSet = 'Basic';
                    $oFCKeditor->Create();
                    ?>
                </div>

            </div>
            <div class="panel_row">
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                    <p>
                        رفع نموذج-2
                    </p>
                </div>
                <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;">
                    <input type="file" name="file" id="file" style="width:300px;" accept="application/pdf"/>
                </div>
            </div>

        </fieldset>
        <div class="panel_row">
            <div class="panel-cell">
                <input type="submit" value="ارسال" id='sendButton' style="margin-top: 20px;"/>
            </div>
        </div>
        <div class="panel_row">
            <div class="panel-cell" style="float: left ; ">
                <label>
                    <a href="index.php?program=<? echo $_SESSION['program'] ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
                        رجوع
                    </a></label>
            </div>
        </div>
    </form>
    <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe>

</center>
<?
$smarty->display('../templates/footer.tpl');
