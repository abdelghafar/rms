<?
session_start();

require_once('../lib/Reseaches.php');
require_once '../js/fckeditor/fckeditor.php';

$research_id = $_GET['research_id'];
$research = new Reseaches();
$rs = $research->GetResearch($research_id);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/> 
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
        <script type="text/javascript" src="../js/fckeditor/fckeditor.js"></script> 

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
        <style type="text/css">
            .demo-iframe {
                border: none;
                width: 900px;
                height: 90px;
                display:none; 
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".textbox").jqxInput({rtl: true, height: 25, width: 605, minLength: 1, theme: 'energyblue'});
                $(".textArea").jqxInput({rtl: true, height: 125, width: 600, minLength: 1, theme: 'energyblue'});
                $("#proposed_duration").jqxMaskedInput({rtl: true, width: '100px', height: '25px', mask: '##', theme: 'energyblue', value:<? echo $rs['proposed_duration']; ?>});
                $("#major_field").jqxInput({rtl: true, height: 25, width: 120, minLength: 2, theme: 'energyblue'});
                $("#special_field").jqxInput({rtl: true, height: 25, width: 110, minLength: 2, theme: 'energyblue'});
                $(".small_textbox").jqxInput({rtl: true, height: 25, width: 110, minLength: 2, theme: 'energyblue'});
                $("#currencyInput").jqxNumberInput({rtl: true, width: '100px', height: '25px', min: 0, max: 300000, theme: 'energyblue', inputMode: 'simple', decimalDigits: 0, digits: 6, value:<? echo $rs['budget']; ?>});

                $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});

                $("#proposed_duration").val(function() {
                    return $("#proposed_duration").jqxMaskedInput('value');
                });

                $("#proposed_reports_count").val(function() {
                    return $("#proposed_reports_count").jqxMaskedInput('value');
                });

                $("#sendButton").click(function() {
                    var validationResult = function(isValid) {
                        if (isValid) {
                            $("#ResearchEditForm").submit();
                        }
                    };
                    $('#ResearchEditForm').jqxValidator('validate', validationResult);
                });

                $("#ResearchEditForm").on('validationSuccess', function() {
                    $("#form-iframe").fadeIn('fast');
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#ResearchEditForm').jqxValidator({rules: [
                        {input: '#title_ar', message: 'من فضلك ادخل عنوان  البحث باللغة العربية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                        {input: '#title_en', message: 'من فضلك ادخل عنوان البحث باللغة الانجليزية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                        {input: '#major_field', message: 'من فضلك ادخل التخصص العام', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                        {input: '#special_field', message: 'من فضلك ادخل التخصص الدقيق', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                        {input: '#proposed_duration', message: 'من فضلك ادخل رقم صحيح', action: 'keyup,blur', rtl: true, position: 'topcenter', rule: 'minLength=2,required'}
                    ], theme: 'energyblue', animation: 'fade'});
            });

        </script>
        <title></title>
    </head>
    <body style="background-color: #ededed;">
        <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe>
        <form method="POST" target="form-iframe" id="ResearchEditForm" enctype="multipart/form-data" action="inc/ResearchEdit.inc.php" style=" font-size: 17px;font-weight: bold;color:#2191c0;"> 
            <input type="hidden" name ="Research_Id" value="<? echo $rs['seq_id']; ?>"/>
            <fieldset style="width: 95%;text-align: right;"> 
                <legend>
                    <label>
                        بيانات البحث
                    </label>
                </legend>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;" > 
                        <p>
                            عنوان البحث-اللغة العربية
                        </p>
                    </div>
                    <div class="panel-cell">
                        <input id="title_ar" class="textbox" type="text" placeholder="عنوان البحث باللغة العربية" name="title_ar" value="<? echo $rs['title_ar']; ?>"/>  
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p>
                            عنوان البحث - اللغة الانجليزية
                        </p>
                    </div>
                    <div class="panel-cell">
                        <input id="title_en" class="textbox" type="text" placeholder="عنوان البحث - اللغة الانجليزية" value="<? echo $rs['title_en']; ?>" name="title_en"/>  
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;vertical-align: middle"> 
                        <p>
                            المدة المقترحة بالشهر
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle">
                        <div id="proposed_duration" >

                        </div> 
                    </div>
                    <div class="panel-cell" style="width:394px;text-align: left;padding-left:10px;vertical-align: middle"> 
                        <p>
                            الميزانية المقترحة
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle">
                        <div id='currencyInput' style="vertical-align: middle"></div>
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p>
                            مجال البحث
                        </p>
                    </div>
                    <div class="panel-cell">
                        <input id="major_field" class="textbox" type="text" placeholder="التخصص العام" value="<? echo $rs['major_field']; ?>" name="major_field"/>  
                    </div>
                    <div class="panel-cell" style="width: 363px;text-align: left;padding-left: 10px;"> 
                        <p>
                            المجال الدقيق
                        </p>
                    </div>
                    <div class="panel-cell">
                        <input id="special_field" class="small_textbox" type="text" placeholder="التخصص الدقيق" value="<? echo $rs['special_field']; ?>" name="special_field"/>  
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
                        $oFCKeditor->Height = "150px";
                        $oFCKeditor->Width = "605px";
                        $oFCKeditor->BasePath = '../js/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Basic';
                        $oFCKeditor->Value = $rs['abstract_ar'];
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
                        $oFCKeditor->Height = "150px";
                        $oFCKeditor->Width = "605px";
                        $oFCKeditor->BasePath = '../js/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Basic';
                        $oFCKeditor->Value = $rs['abstract_en'];
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
                        <p class="error">
                            ملاحطة: في حالة عدم تحميل ملف جديد سوف يتم الاحتفاظ بالنسخة القديمة
                        </p>
                    </div>
                </div>

            </fieldset>
            <div class="panel_row">
                <div class="panel-cell">
                    <input type="submit" value="ارسال" id='sendButton' style="margin-top: 20px;"/>
                </div>
            </div>


        </form>
    </body>
</html>
