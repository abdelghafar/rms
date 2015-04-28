<?
require_once '../js/fckeditor/fckeditor.php';
require_once '../lib/Smarty/libs/Smarty.class.php';

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
$smarty->display('../templates/header.tpl');
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../common/css/reigster-layout.css"/>

    <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script>
    <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxpasswordinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
    <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>

    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>

    <script type="text/javascript">
        var RecaptchaOptions = {
            theme: 'white'
        };
    </script>
    <style type="text/css">
        #recaptcha_area {
            width: 318px !important;
            direction: ltr;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {

            $("#gender").jqxSwitchButton({rtl: true, height: 25, theme: 'energyblue', width: 70, onLabel: "أنثي", offLabel: "ذكر"});

            $("#BirthDate").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});

            $('#BirthDate').on('change', function (event) {
                $('#BirthDateVal').val($('#BirthDate').jqxDateTimeInput('getText'));
            });
            $(".textbox").jqxInput({rtl: true, height: 25, width: 150, minLength: 1, theme: 'energyblue'});
            $("#empCode").jqxMaskedInput({rtl: true, width: '150px', height: '25px', mask: '#######', theme: 'energyblue'});
            var comboSrc = ["أستاذ مساعد", "أستاذ مشارك", "أستاذ"];
            $("#jqxdropdownlist").jqxDropDownList({rtl: true, source: comboSrc, selectedIndex: 0, width: '150px', height: '25px', theme: 'energyblue'});
            $("#email").on('change', function () {
                var emailTxt = $("#email").val();

            });

            $('#sendButton').on('click', function () {
                $('#registerFrom').jqxValidator('validate');
            });
            $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});

            $("#sendButton").click(function () {
                var validationResult = function (isValid) {
                    if (isValid) {
                        $("#registerFrom").submit();

                    }
                };
                $('#registerFrom').jqxValidator('validate', validationResult);
            });

            $("#registerFrom").on('validationSuccess', function () {
                $("#form-iframe").fadeIn('fast');
            });
        });

    </script>

    <script type="text/javascript">
        $(document).ready(
            function () {
                checked = false;
                genderText = "ذكر";
                $('#genderType').val(genderText);
                $("#gender").bind('change', function (event) {
                    checked = event.args.check;
                    if (checked === true) {
                        genderText = "أنثي";
                    }
                    else {
                        genderText = "ذكر";
                    }
                    $('#genderType').val(genderText);
                });
                var item = "أستاذ مساعد";
                $("#Position").val(item);
                $('#jqxdropdownlist').bind('select', function (event) {
                    var args = event.args;
                    item = $('#jqxdropdownlist').jqxDropDownList('getItem', args.index);
                    $("#Position").val(item.label);
                });
            });

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#registerFrom').jqxValidator({rules: [
                {input: '#FirstName-ar', message: 'من فضلك ادخل الاسم الاول بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FatherName-ar', message: 'من فضلك ادخل اسم الاب بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#GrandName-ar', message: 'من فضلك ادخل اسم الجد بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FamilyName-ar', message: 'من فضلك ادخل اسم العائلة بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FirstName-en', message: 'من فضلك ادخل الاسم الاول بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FatherName-en', message: 'من فضلك ادخل اسم الاب بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#GrandName-en', message: 'من فضلك ادخل اسم الجد بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FamilyName-en', message: 'من فضلك ادخل اسم العائلة بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#major-field', message: 'من فضلك ادخل التخصص العام بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#special-field', message: 'من فضلك ادخل التخصص الدقيق بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#university', message: 'من فضلك ادخل جهة العمل بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#empCode', message: 'من فضلك ادخل رقم منسوب الجامعة', action: 'valuechanged, blur', rtl: true, position: 'topcenter', rule: function (input, commit) {
                    if (input === "")
                        return true;
                    var c = /\d{7}/;

                    $("#empCodeVal").val(function () {
                        return $("#empCode").jqxMaskedInput('value');
                    });
                    return c.test(($("#empCode").jqxMaskedInput('value')));
                }},
                {input: '#email', message: 'من فضلك ادخل البريد الالكتروني', action: 'keyup, blur', rule: 'required', rtl: true, position: 'topcenter'},
                {input: '#email', message: 'من فضلك ادخل البريد الاكتروني بصورة صحيحة', action: 'keyup', rule: 'email', position: 'topcenter'},
                {input: '#mobile', message: 'من فضلك ادخل رقم الجوال', action: 'keyup,blur', rule: 'required', rtl: true, position: 'topcenter'},
                {input: "#password", message: "من فضلك ادخل كلمة المرور", action: 'keyup, blur', rule: 'required', position: 'left'},
                {input: "#passwordConfirm", message: "من فضلك ادخل كلمة المرور", action: 'keyup, blur', rule: 'required', position: 'left'},
                {input: "#password", message: "كلمة المرور تترواح من  8 الي 20 حرف", action: 'keyup, blur', rule: 'length=8,20', position: 'left'},
                {
                    input: "#passwordConfirm", message: "من فضلك تأكد من تطابق كلمة المرور", action: 'keyup, blur', position: 'left', rule: function (input, commit) {
                    var firstPassword = $("#password").jqxPasswordInput('val');
                    var secondPassword = $("#passwordConfirm").jqxPasswordInput('val');
                    return firstPassword === secondPassword;
                }
                }

            ], theme: 'energyblue', animation: 'fade'
            });
        });
    </script>
    <style type="text/css">
        .demo-iframe {
            border: none;
            width: 900px;
            height: 150px;
            display: none;
        }
    </style>
    <script type="text/javascript">
        function Clear() {

        }
    </script>
    <title>تسجيل باحث</title>
</head>
<body>
<form method="POST" id="registerFrom" target="form-iframe" action="inc/register.inc.php">
<fieldset style="width: 95%;text-align: right;">
    <legend>
        <label>
            بيانات شخصية / Personal Data
        </label>

    </legend>
    <div class="panel_row">
        <div class="panel-cell" style="width: 270px;text-align: left;padding-left: 10px;">
            <p style="font-weight: bold" class="classic">
                الاسم بالغة العربية / Name in Ar
            </p>
        </div>
        <div class="panel-cell" style="width: 700px;">
            <input id="FirstName-ar" class="textbox" type="text" placeholder="الاسم الاول" name="FirstName_ar"/>
            <input id="FatherName-ar" class="textbox" type="text" placeholder="اسم الأب" name="FatherName_ar"/>
            <input id="GrandName-ar" class="textbox" type="text" placeholder="اسم الجد" name="GrandName_ar"/>
            <input id="FamilyName-ar" class="textbox" type="text" placeholder="لقب العائلة" name="FamilyName_ar"/>

        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width: 259px;text-align: left;padding-left: 10px;">
                <p style="font-weight: bold" class="classic">
                    الاسم باللغة الانجليزية / Name in Eng
                </p>
            </div>
            <div class="panel-cell" style="width: 700px;">
                <input id="FamilyName-en" class="textbox" type="text" placeholder="FamilyName" name="FamilyName_en"/>
                <input id="GrandName-en" class="textbox" type="text" placeholder="GrandName" name="GrandName_en"/>
                <input id="FatherName-en" class="textbox" type="text" placeholder="FatherName" name="FatherName_en"/>
                <input id="FirstName-en" class="textbox" type="text" placeholder="FirstName" name="FirstName_en"/>
            </div>
        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width: 240px;text-align: left;padding-left: 12px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    النوع / Gender
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div id="gender">
                    <input type="hidden" name="genderType" id="genderType"/>
                </div>
            </div>

            <div class="panel-cell" style="width:384px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    الجنسية / Nationality
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input class="textbox" type="text" placeholder="Nationality" name="Nationality"/>
            </div>
        </div>

        <div class="panel_row">
            <div class="panel-cell" style="width:240px;text-align: left;padding-left: 9px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    تاريخ الميلاد/ DoB
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float:right;" id="BirthDate">
                </div>
                <input type="hidden" id="BirthDateVal" name="BirthDateVal"/>

            </div>

            <div class="panel-cell" style="width:317px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    بلد الاقامة / Country of residence
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input class="textbox" type="text" placeholder="بلد الميلاد" name="CountryOfBirth"/>
            </div>
        </div>
    </div>
</fieldset>
<br/>
<fieldset style="width: 95%;text-align: right;">
    <legend>
        <label>
            بيانات أكاديمية / Acadmic data
        </label>

    </legend>
    <div class="panel_row">
        <div class="panel-cell" style="width:248px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                الدرجة العلمية / Scientific Degree
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input type="hidden" name="Position" id="Position"/>

            <div id='jqxdropdownlist' style="height: 20px;">
            </div>
        </div>

    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:250px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                التخصص العام / Major Field
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="major-field" name="major_field" class="textbox" type="text" placeholder="التخصص العام"/>
        </div>
        <div class="panel-cell" style="width:307px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                التخصص الدقيق / Special Field
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="special-field" name="special_field" class="textbox" type="text" placeholder="التخصص الدقيق"/>
        </div>

    </div>

</fieldset>

<br/>
<fieldset style="width: 95%;text-align: right;">
    <legend>

        <label>
            بيانات العمل/ Working Data
        </label>
    </legend>

    <div class="panel_row">
        <div class="panel-cell" style="width:250px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                جهة العمل/ University
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="university" name="university" class="textbox" type="text" value="" placeholder="الجامعة"/>
        </div>
    </div>
    <div class="panel_row">

        <div class="panel-cell" style="width:251px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                الكلية / College
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="college" class="textbox" type="text" placeholder="الكلية / الادارة"/>
        </div>
        <div class="panel-cell" style="width:307px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                القسم/ Dept
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="dept" class="textbox" type="text" placeholder="القسم"/>
        </div>
    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:252px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                صورة اثبات الهوية / NI Image
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <div id="empCode"></div>
            <input type="hidden" name="empCodeVal" id="empCodeVal"/>
        </div>
    </div>

</fieldset>
<br/>
<fieldset style="width: 95%;text-align: right;">
    <legend>
        <label>
            للإتصـــال / Contact
        </label>
    </legend>
    <div class="panel_row">
        <div class="panel-cell" style="width:252px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                البريد الالكتروني الرسمى / Offical Email
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="email" name="email" class="textbox" type="text" placeholder="@uqu.edu.sa"/>
        </div>
    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:252px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                جوال / Mobile
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="mobile" name="mobile" class="textbox" type="text" value=""/>966+
        </div>

        <div class="panel-cell" style="width:278px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                فاكس / Fax
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="fax" class="textbox" type="text" placeholder="فاكس"/>
        </div>
    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:252px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                المدينة / City
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input class="textbox" type="text" placeholder="المدينة" name="city"/>
        </div>
        <div class="panel-cell" style="width:307px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold" class="classic">
                الدولة / Country
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input class="textbox" type="text" placeholder="الدولة" name="country"/>
        </div>
    </div>
</fieldset>

<input type="submit" value="ارسال" id='sendButton' style="margin-top: 10px;"/>
</form>
<iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe>

</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>
