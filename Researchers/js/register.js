/**
 * Created by ahmed on 28/04/15.
 */
var RecaptchaOptions = {
    theme: 'white'
};
$(document).ready(function () {

    $('#uploadFile').jqxFileUpload({width: 200, uploadUrl: '#', fileInputName: 'fileToUpload', theme: 'energyblue', uploadTemplate: 'warning', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', localization: {
        browseButton: 'استعراض',
        uploadButton: 'تحميل الملف',
        cancelButton: 'الغاء',
        uploadFileTooltip: 'تحميل الملف',
        cancelFileTooltip: 'الغاء التحميل'
    }});

    $('#uploadFile').on('uploadEnd', function (event) {
        var arabic_summary_url;
        var args = event.args;
        var fileName = args.file;
        var serverResponce = args.response;
    });

    $("#gender").jqxSwitchButton({rtl: true, height: 25, theme: 'energyblue', width: 70, onLabel: "أنثي", offLabel: "ذكر"});

    $("#BirthDate").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});

    $('#BirthDate').on('change', function (event) {
        $('#BirthDateVal').val($('#BirthDate').jqxDateTimeInput('getText'));
    });
    $(".textbox").jqxInput({rtl: true, height: 25, width: 150, minLength: 1, theme: 'energyblue'});
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
    $("#registerFrom").on('validationSuccess', function () {
        $("#form-iframe").fadeIn('fast');
    });
});
/**
 * Validation
 */
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
        {input: '#email', message: 'من فضلك ادخل البريد الالكتروني', action: 'keyup, blur', rule: 'required', rtl: true, position: 'topcenter'},
        {input: '#email', message: 'من فضلك ادخل البريد الاكتروني بصورة صحيحة', action: 'keyup', rule: 'email', position: 'topcenter'},
        {input: '#mobile', message: 'من فضلك ادخل رقم الجوال', action: 'keyup,blur', rule: 'required', rtl: true, position: 'topcenter'}
    ], theme: 'energyblue', animation: 'fade'
    });
});
