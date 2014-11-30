<?
session_start();
require_once '../lib/persons.php';
$Action = $_GET['Action'];
if (isset($_GET['person_id'])) {
    $person_id = $_GET['person_id'];
    $obj = new Persons();
    $person = $obj->GetPerson($person_id);
    while ($row = mysql_fetch_array($person)) {
        $FirstName_ar = $row['FirstName_ar'];
        $FirstName_en = $row['FirstName_en'];
        $FatherName_ar = $row['FatherName_ar'];
        $FatherName_en = $row['FatherName_en'];
        $GrandName_ar = $row['GrandName_ar'];
        $GrandName_en = $row['GrandName_en'];
        $FamilyName_ar = $row['FamilyName_ar'];
        $FamilyName_en = $row['FamilyName_en'];
        $empCode = $row['empCode'];
        $EqamaCode = $row['EqamaCode'];
        $Major_Field = $row['Major_Field'];
        $Speical_Field = $row['Speical_Field'];
        $Email = $row['Email'];
        $Mobile = $row['Mobile'];
        $IBAN = $row['IBAN'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="../common/css/reigster-layout.css"/>
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".textbox").jqxInput({rtl: true, height: 25, width: 150, minLength: 1, theme: 'energyblue'});
                $('#sendButton').on('click', function () {
                    $('#form').jqxValidator('validate');
                });
                $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});
                // validate form.
                $("#sendButton").click(function () {
                    var validationResult = function (isValid) {
                        if (isValid) {
                            $("#form").submit();
                        }
                        ;
                    };
                    $('#form').jqxValidator('validate', validationResult);
                });
                $("#form").on('validationSuccess', function () {
                    $("#form-iframe").fadeIn('fast');
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
                        {input: '#major-field', message: 'من فضلك ادخل التخصص العام بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                        {input: '#special-field', message: 'من فضلك ادخل التخصص الدقيق بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
                        {input: '#email', message: 'من فضلك ادخل البريد الالكتروني', action: 'keyup, blur', rule: 'required', rtl: true, position: 'topcenter'},
                        {input: '#email', message: 'من فضلك ادخل البريد الاكتروني بصورة صحيحة', action: 'keyup', rule: 'email', position: 'topcenter'}
                    ], theme: 'energyblue', animation: 'fade'
                });
            });
        </script>
        <style type="text/css">
            .demo-iframe {
                border: none;
                width: 750px;
                height: 50px; 
                clear: both;
                float: right; 
                margin-right: 15px;
            }
        </style>

    </head>
    <body style="background-color: #ededed;">
        <form method="POST" id="form" target="form-iframe" action="inc/AddEdit_Reviwers.inc.php">
            <input type="hidden" name="Action" value="<? echo $Action; ?>"/>
            <input type="hidden" name="person_id" value="<? if (isset($person_id)) echo $person_id; ?>"/>
            <fieldset style="width: 95%;text-align: right;"> 
                <legend>
                    <label>
                        بيانات المحكم
                    </label>
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p style="font-weight: bold">اسم المحكم  باللغة العربية</p>
                    </div>
                    <div class="panel-cell" style="width: 700px;">
                        <input id="FirstName-ar" class="textbox" type="text" placeholder="الاسم الاول" name="FirstName_ar" value="<? echo $FirstName_ar; ?>"/>  
                        <input id="FatherName-ar" class="textbox" type="text" placeholder="اسم الأب" name="FatherName_ar" value="<? echo $FatherName_ar; ?>"/> 
                        <input id="GrandName-ar" class="textbox" type="text" placeholder="اسم الجد" name="GrandName_ar" value="<? echo $GrandName_ar; ?>"/>
                        <input id="FamilyName-ar" class="textbox" type="text" placeholder="لقب العائلة" name="FamilyName_ar" value="<? echo $FamilyName_ar; ?>"/> 
                    </div>
                    <div class="panel_row">
                        <div class="panel-cell" style="width: 185px;text-align: left;padding-left: 10px;"> 
                            <p style="font-weight: bold">اسم المحكم باللغة الانجليزية</p>
                        </div>
                        <div class="panel-cell" style="width: 700px;">
                            <input id="FamilyName-en" class="textbox" type="text" placeholder="FamilyName" name="FamilyName_en" value="<? echo $FamilyName_en; ?>"/>  
                            <input id="GrandName-en" class="textbox" type="text" placeholder="GrandName" name="GrandName_en" value="<? echo $GrandName_en; ?>"/> 
                            <input id="FatherName-en" class="textbox" type="text" placeholder="FatherName" name="FatherName_en" value="<? echo $FatherName_en; ?>"/>
                            <input id="FirstName-en" class="textbox" type="text" placeholder="FirstName" name="FirstName_en" value="<? echo $FirstName_en; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="panel_row">
                    <div class="panel-cell" style="width:181px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p style="font-weight: bold">
                            التخصص العام                    </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="major-field" name="major_field" class="textbox" type="text" placeholder="التخصص العام" value="<? echo $Major_Field; ?>"/> 
                    </div>
                    <div class="panel-cell" style="width:150px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p style="font-weight: bold">
                            التخصص الدقيق
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="special-field" name="special_field" class="textbox" type="text" placeholder="التخصص الدقيق" value="<? echo $Speical_Field; ?>"/> 
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width:181px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p style="font-weight: bold">
                            البريدالالكتروني                 </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="email" name="email" class="textbox" type="text" placeholder="البريد الالكتروني" value="<? echo $Email; ?>"/>
                    </div>
                    <div class="panel-cell" style="width:150px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p style="font-weight: bold">
                            جوال
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="mobile" name="mobile" class="textbox" type="text" placeholder="جوال" value="<? echo $Mobile; ?>"/>
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width:181px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p style="font-weight: bold">
                            رقم   IBAN
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="IBAN" name="IBAN" class="textbox" type="text" placeholder="" value="<? echo $IBAN; ?>"/>
                    </div>

                </div>
            </fieldset>
            <input type="submit" value="حفظ" id='sendButton' style="margin-top: 10px;"/>
            <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0" >

            </iframe>
        </form>

    </body>
</html>
