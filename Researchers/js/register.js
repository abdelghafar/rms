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

    $(".textbox").jqxInput({rtl: true, height: 25, width: 300, minLength: 1, theme: 'energyblue'});
    $("#name_ar").jqxInput({rtl: true, height: 25, width: 600, minLength: 1, theme: 'energyblue'});
    $("#name_en").jqxInput({rtl: true, height: 25, width: 600, minLength: 1, theme: 'energyblue'});

    var comboSrc = ["أستاذ مساعد", "أستاذ مشارك", "أستاذ"];
    $("#jqxdropdownlist").jqxDropDownList({rtl: true, source: comboSrc, selectedIndex: 0, width: 300, height: 25, theme: 'energyblue'});
    $("#email").on('change', function () {
        var emailTxt = $("#email").val();
    });

    var url = "../Data/getAll_countries.php";

    // prepare the data
    var source =
    {
        datatype: "json",
        datafields: [
            { name: 'seq_id' },
            { name: 'title_ar' }
        ],
        url: url,
        async: false
    };
    var dataAdapter = new $.jqx.dataAdapter(source);

    $("#countriesList").jqxDropDownList({rtl:true,source: dataAdapter, displayMember: 'title_ar', valueMember: 'title_ar', selectedIndex: 0, width: 200, height: 25, theme: 'energyblue'});
    //selectedCountry
    var item = $("#countriesList").jqxDropDownList('getSelectedItem');
    $('#selectedCountry').val(item.value);
    $('#countriesList').on('select', function (event) {
        var args = event.args;
        var item = $('#countriesList').jqxDropDownList('getItem', args.index);
        if (item != null) {
            $('#selectedCountry').val(item.value);
        }
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
        {input:'#name_ar', message: 'من فضلك ادخل الاسم باللغة العربية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
        {input: '#name_en', message: 'من فضلك ادخل الاسم باللغة الانجليزية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
        {input: '#university', message: 'من فضلك ادخل جهة العمل بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
		 {input: '#college', message: 'من فضلك ادخل الكلية بصورة صحيحة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
		 	 {input: '#dept', message: 'من فضلك ادخل القسم بصورة صحيحية', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'},
        {input: '#email', message: 'من فضلك ادخل البريد الالكتروني', action: 'keyup, blur', rule: 'required', rtl: true, position: 'topcenter'},
        {input: '#email', message: 'من فضلك ادخل البريد الاكتروني بصورة صحيحة', action: 'keyup,blur', rule: 'email', position: 'topcenter'},
        {input: '#mobile', message: 'من فضلك ادخل رقم الجوال', action: 'keyup,blur', rule: 'required', rtl: true, position: 'topcenter'}
    ], theme: 'energyblue', animation: 'fade'
    });
});
