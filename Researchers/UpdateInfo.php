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
<?
require_once '../lib/persons.php';
require_once '../lib/users.php';

$UserId = $_SESSION['User_Id'];
$users = new Users();
$person_Id = $users->GetPerosnId($UserId, 'Researcher');
$obj = new Persons();
$rs = $obj->GetPerson($person_Id);
while ($row = mysql_fetch_array($rs)) {
    $FirstName_ar = $row['FirstName_ar'];
    $FirstName_en = $row['FirstName_en'];
    $FatherName_ar = $row['FatherName_ar'];
    $FatherName_en = $row['FatherName_en'];
    $GrandName_ar = $row['GrandName_ar'];
    $GrandName_en = $row['GrandName_en'];
    $FamilyName_ar = $row['FamilyName_ar'];
    $FamilyName_en = $row['FamilyName_en'];
    $Nationality = $row['Nationality'];
    $DateOfBirth = $row['DateOfBirth'];
    $CountryOfBirth = $row['CountryOfBirth'];
    $Position = $row['Position'];
    $Major_Field = $row['Major_Field'];
    $Speical_Field = $row['Speical_Field'];
    $College = $row['College'];
    $Dept = $row['Dept'];
    $empCode = $row['empCode'];
    $EqamaCode = $row['EqamaCode'];
    $Email = $row['Email'];
    $Mobile = $row['Mobile'];
    $Fax = $row['Fax'];
    $city = $row['city'];
    $country = $row['country'];
    $POX = $row['POX'];
    $Postal_Code = $row['Postal_Code'];
    $IBAN = $row['IBAN'];
    $ResumeUrl = $row['ResumeUrl'];
}
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

    <style type="text/css">
        .demo-iframe {
            border: none;
            width: 600px;
            height: 100px;
            clear: both;
            display: none;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var theme = 'energyblue';

            $(".Calander").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
            $(".textbox").jqxInput({rtl: true, height: 25, width: 150, minLength: 1, theme: 'energyblue'});
            $(".Calander").jqxDateTimeInput('val', '<? echo $DateOfBirth; ?>');


            $("#POX").jqxInput({rtl: true, height: 25, width: 150, minLength: 1, theme: 'energyblue'});
            $("#postal_code").jqxInput({rtl: true, height: 25, width: 150, minLength: 1, theme: 'energyblue'});
            $("#university").jqxInput({disabled: true});
            $("#email").jqxInput({disabled: true, width: 160});
            $("#empCode").jqxInput({rtl: true, width: '150px', height: '25px', disabled: true, theme: 'energyblue', value: '<? echo $empCode; ?>'});
            var comboSrc = ["أستاذ مساعد", "أستاذ مشارك", "أستاذ"];
            $("#jqxdropdownlist").jqxDropDownList({rtl: true, source: comboSrc, selectedIndex: 0, width: '150px', height: '25px', theme: 'energyblue'});
            $("#jqxdropdownlist").jqxDropDownList('val', '<? echo $Position; ?>');
            $("#eqamaCode").jqxInput({rtl: true, width: '150px', height: '25px', disabled: true, value: '<? echo $EqamaCode; ?>', theme: 'energyblue'});


            $("#form").on('validationSuccess', function () {
                $("#form-iframe").fadeIn('fast');
            });

            $('#sendButton').on('click', function () {
                $('#form').jqxValidator('validate');
            });

            $('#BirthDateVal').val($('#BirthDate').jqxDateTimeInput('getText'));
            $('#BirthDate').on('change', function (event) {
                $('#BirthDateVal').val($('#BirthDate').jqxDateTimeInput('getText'));
            });

            $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});
        });</script>
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
                $("#gender").val('checked');
                var item = "أستاذ مساعد";
                $("#Position").val(item);

                $('#jqxdropdownlist').bind('select', function (event) {
                    var args = event.args;
                    item = $('#jqxdropdownlist').jqxDropDownList('getItem', args.index);
                    $("#Position").val(item.label);
                });

            });</script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#form').jqxValidator({rules: [
                {input: '#FirstName-ar', message: 'من فضلك ادخل الاسم الاول بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FatherName-ar', message: 'من فضلك ادخل اسم الاب بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#GrandName-ar', message: 'من فضلك ادخل اسم الجد بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FamilyName-ar', message: 'من فضلك ادخل اسم العائلة بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FirstName-en', message: 'من فضلك ادخل الاسم الاول بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FatherName-en', message: 'من فضلك ادخل اسم الاب بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#GrandName-en', message: 'من فضلك ادخل اسم الجد بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#FamilyName-en', message: 'من فضلك ادخل اسم العائلة بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                {input: '#major-field', message: 'من فضلك ادخل التخصص العام بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=2,required', rtl: true, position: 'topcenter'},
                {input: '#special-field', message: 'من فضلك ادخل التخصص الدقيق بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=2,required', rtl: true, position: 'topcenter'},
                {input: '#mobile', message: 'من فضلك ادخل رقم الجوال', action: 'keyup,blur', rule: 'required', rtl: true, position: 'topcenter'}
            ], theme: 'energyblue'
            });
        });</script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#form").submit(function () {
                $.ajax({
                    type: 'post',
                    url: 'inc/UpdateInfo.inc.php',
                    datatype: "html",
                    data: $("#form").serialize(),
                    beforeSend: function () {
                        $("#result").html("<img src='../images/ajax-loader.gif'/>loading...");
                    },
                    success: function (data) {
                        $("#result").html(data);
                    }
                });
                return  false;
            });
        });
    </script>
    <title>تسجيل باحث</title>
</head>
<body>
<form id="form" method="POST" enctype="multipart/form-data">
<fieldset style="width: 95%;text-align: right;">
    <legend>
        <label>
            بيانات شخصية
        </label>
    </legend>
    <div class="panel_row">
        <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;">
            <p style="font-weight: bold">اسم الباحث باللغة العربية</p>
        </div>
        <div class="panel-cell" style="width: 700px;">
            <input id="FirstName-ar" class="textbox" type="text" placeholder="الاسم الاول" name="FirstName_ar"
                   value="<? echo $FirstName_ar; ?>"/>
            <input id="FatherName-ar" class="textbox" type="text" placeholder="اسم الأب" name="FatherName_ar"
                   value="<? echo $FatherName_ar; ?>"/>
            <input id="GrandName-ar" class="textbox" type="text" placeholder="اسم الجد" name="GrandName_ar"
                   value="<? echo $GrandName_ar; ?>"/>
            <input id="FamilyName-ar" class="textbox" type="text" placeholder="لقب العائلة" name="FamilyName_ar"
                   value="<? echo $FamilyName_ar; ?>"/>

        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width: 190px;text-align: left;padding-left: 10px;">
                <p style="font-weight: bold">اسم الباحث باللغة الانجليزية</p>
            </div>
            <div class="panel-cell" style="width: 700px;">
                <input id="FamilyName-en" class="textbox" type="text" placeholder="FamilyName" name="FamilyName_en"
                       value="<? echo $FamilyName_en ?>"/>
                <input id="GrandName-en" class="textbox" type="text" placeholder="GrandName" name="GrandName_en"
                       value="<? echo $GrandName_en; ?>"/>
                <input id="FatherName-en" class="textbox" type="text" placeholder="FatherName" name="FatherName_en"
                       value="<? echo $FatherName_en ?>"/>
                <input id="FirstName-en" class="textbox" type="text" placeholder="FirstName" name="FirstName_en"
                       value="<? echo $FirstName_en ?>"/>
            </div>
        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width:190px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold">الجنسية</p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input class="textbox" type="text" placeholder="Nationality" name="Nationality"
                       value="<? echo $Nationality; ?>"/>
            </div>
        </div>

        <div class="panel_row">
            <div class="panel-cell" style="width:190px;text-align: left;padding-left: 9px;vertical-align: middle;">
                <p style="font-weight: bold">
                    تاريخ الميلاد
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float:right;" id="BirthDate" class="Calander">

                </div>
                <input type="hidden" id="BirthDateVal" name="BirthDateVal"/>
            </div>

            <div class="panel-cell" style="width:165px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold">
                    بلد الميلاد </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input class="textbox" type="text" placeholder="بلد الميلاد" name="CountryOfBirth"
                       value="<? echo $CountryOfBirth ?>"/>
            </div>
        </div>
    </div>
</fieldset>
<br/>
<fieldset style="width: 95%;text-align: right;">
    <legend>
        <label>
            بيانات أكاديمية
        </label>

    </legend>
    <div class="panel_row">
        <div class="panel-cell" style="width:190px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                الدرجة العلمية
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input type="hidden" name="Position" id="Position"/>

            <div id='jqxdropdownlist' style="height: 20px;">
            </div>
        </div>

    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:190px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                التخصص العام </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="major-field" name="major_field" class="textbox" type="text" placeholder="التخصص العام"
                   value="<? echo $Major_Field; ?>"/>
        </div>
        <div class="panel-cell" style="width:170px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                التخصص الدقيق
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="special-field" name="special_field" class="textbox" type="text" placeholder="التخصص الدقيق"
                   value="<? echo $Speical_Field; ?>"/>
        </div>

    </div>

</fieldset>

<br/>
<fieldset style="width: 95%;text-align: right;">
    <legend>

        <label>
            بيانات العمل
        </label>
    </legend>

    <div class="panel_row">
        <div class="panel-cell" style="width:190px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                جهة العمل
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="university" name="university" class="textbox" type="text" value="جامعة أم القري"/>
        </div>
    </div>
    <div class="panel_row">

        <div class="panel-cell" style="width:190px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                الكلية / الادارة
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="college" class="textbox" type="text" placeholder="الكلية / الادارة"
                   value="<? echo $College; ?>"/>
        </div>
        <div class="panel-cell" style="width:170px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                القسم
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="dept" class="textbox" type="text" placeholder="القسم" value="<? echo $Dept; ?>"/>
        </div>
    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:190px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                رقم المنسوب </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="empCode" id="empCode" placeholder="القسم" value="<? echo $empCode; ?>"/>
        </div>
        <div class="panel-cell" style="width:170px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                رقم الهوية/الاقامة
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="eqamaCode" id="eqamaCode" placeholder="القسم" value="<? echo $EqamaCode; ?>"/>
        </div>
    </div>

</fieldset>
<br/>
<fieldset style="width: 95%;text-align: right;">
    <legend>

        <label>
            للإتصـــال
        </label>
    </legend>
    <div class="panel_row">
        <div class="panel-cell" style="width:200px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                البريدالالكتروني
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="email" name="email" class="textbox" type="text" value="<? echo $Email; ?>"/>
        </div>
    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:200px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                جوال
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="mobile" name="mobile" class="textbox" type="text" value="<? echo $Mobile; ?>"/>966+
        </div>

        <div class="panel-cell" style="width:137px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                فاكس
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="fax" class="textbox" type="text" placeholder="فاكس" value="<? echo $Fax; ?>"/>
        </div>
    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:200px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                المدينة </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input class="textbox" type="text" placeholder="المدينة" name="city" value="<? echo $city; ?>"/>
        </div>
        <div class="panel-cell" style="width:165px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                الدولة </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input class="textbox" type="text" placeholder="الدولة" name="country" value="<? echo $country; ?>"/>
        </div>

    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width:200px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                ص.ب
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input name="POX" id="POX" class="textbox" type="text" placeholder="صندوق بريد" value="<? echo $POX; ?>"/>
        </div>
        <div class="panel-cell" style="width:165px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                الرمز البريدي </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input id="postal_code" class="textbox" type="text" placeholder="الرمز البريدي" name="postal_code"
                   value="<? echo $Postal_Code; ?>"/>
        </div>
    </div>
</fieldset>
<br/>
<fieldset style="width: 95%;text-align: right;display: none;">
    <legend>
        <label>
            ملحقات
        </label>
    </legend>
    <div class="panel_row">
        <div class="panel-cell" style="width:200px;text-align: left;padding-left: 10px;vertical-align: middle;">
            <p style="font-weight: bold">
                السيرة الذاتية
            </p>
        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <input type="file" name="file" id="file" style="width:300px;" accept="application/pdf"/>
        </div>
    </div>

</fieldset>

<div class="panel_row">
    <div class="panel-cell" style="float: right;">
        <input type="submit" value="حفظ" id='sendButton' style="margin-top: 15px;"/>
    </div>
    <div class="panel-cell" style="float: left;">
        <label>
            <a href="index.php?program=<? echo $_SESSION['program'] ?>"
               style="float: left;margin-left: 25px;margin-top: 20px;">
                رجوع
            </a>
        </label>
    </div>
</div>
</form>
<div id="result" dir="rtl"></div>
</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>
