<?php
session_start();
require_once '../lib/persons.php';
if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
}
?>
<script type="text/javascript">
    var project_id = '<?echo $project_id; ?>';
</script>

<script type="text/javascript">
$(document).ready(function () {
    var Curr_theme = 'energyblue';
    var tmpPersonData = null;
    var tmpPerson_id = null;
    var tmpName = null;
    var tmpGender = null;
    var tmpEmpCode = null;
    var tmpSpeicalField = null;
    var tmpMajor_Field = null;
    var tmpEmail = null;
    var tmpDept = null;
    var tmpCollege = null;
    var rowindex = null;
    var dataRecord = null;
    var person_id = null;
    var uploaded_file_name = null;
    var resume_file_name = null;
    $("#SearchByName").jqxInput({width: 300, height: 25, rtl: true, theme: Curr_theme});
    $("#searchButton_OtherPersonal").jqxButton({width: 100, height: 25, theme: Curr_theme});
    var roles_lst_dataSource = {
        datatype: "json",
        datafields: [
            {name: 'seq_id'},
            {name: 'role_name'}
        ],
        url: '../Data/GetConsultantRole.php',
        async: false
    };
    var dataAdapter = new $.jqx.dataAdapter(roles_lst_dataSource);
    $("#role_list_others").jqxDropDownList({displayMember: "role_name", valueMember: "seq_id", width: 300, height: 25, rtl: true, theme: Curr_theme, source: dataAdapter, selectedIndex: 0, disabled: true});
    $('#searchButton_OtherPersonal').on('click', function () {
        $('#gridOtherStuff').jqxGrid('clear');
        var SearchByName = $('#SearchByName').jqxInput('val');
        $.ajax({
            url: "../Data/searchPersonByEmail.php?q=" + SearchByName,
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                $('#coAuthorName').html("<img src='common/images/ajax-loader.gif' alt='Loading...' />");
            },
            success: function (data) {
                if (data === null) {
                    tmpPerson_id = null;
                    tmpName = null;
                    tmpGender = null;
                    tmpEmpCode = null;
                    tmpSpeicalField = null;
                    tmpMajor_Field = null;
                    tmpEmail = null;
                    tmpDept = null;
                    tmpCollege = null;
                    $('#error').html('هذا الرقم غير مسجل برجاء تسجيل الباحث أولا');
                    alert('no data ');
                } else {
                    tmpPersonData = data;
                    tmpPerson_id = data[0]['person_id'];
                    tmpName = data[0]['name'];
                    tmpGender = data[0]['gender'];
                    tmpEmpCode = data[0]['empCode'];
                    tmpSpeicalField = data[0]['Speical_Field'];
                    tmpMajor_Field = data[0]['Major_Field'];
                    tmpEmail = data[0]['Email'];
                    tmpDept = data[0]['Dept'];
                    tmpCollege = data[0]['College'];
                    //$('#coAuthorName').html(tmpName);
                    $("#gridOtherStuff").jqxGrid('addrow', null, tmpPersonData);
                }
            }
        });

        $('#showUploadfile').hide();
        $('#showUploadCV').hide();
    });
    var CoAuthorsSource = {
        datafields: [
            {
                name: 'name_ar',
                type: 'string'
            },
            {
                name: 'name_en',
                type: 'string'
            },
            {
                name: 'person_id',
                type: 'int'
            },
            {
                name: 'Major_Field',
                type: 'string'
            },
            {
                name: 'College',
                type: 'string'
            },
            {
                name: 'Dept',
                type: 'string'
            },
            {
                name: 'Speical_Field',
                type: 'string'
            },
            {
                name: 'Position',
                type: 'string'
            }
        ],
        datatype: "json"
    };
    var CoAuthorsSourceAdapter = new $.jqx.dataAdapter(CoAuthorsSource);
    $("#gridOtherStuff").jqxGrid(
        {
            width: '100%',
            height: 400,
            autoheight: true,
            sortable: true,
            pagesize: 10,
            filterable: true,
            pageable: true,
            rtl: true,
            theme: Curr_theme,
            source: CoAuthorsSourceAdapter,
            columns: [
                {text: 'Name / الاسم', datafield: 'name_ar', cellsalign: 'right', align: 'right'},
                {text: 'College / الكلية', datafield: 'College', align: 'right', cellsalign: 'right'},
                {text: 'Title / الدرجة', datafield: 'Position', align: 'right', cellsalign: 'right'},
                {text: 'Email / البريد الالكتروني', datafield: 'Email', align: 'right', cellsalign: 'right'}
            ]
        });

    $('#agreeLetterOther').jqxFileUpload({width: 250, fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', uploadTemplate: 'warning', localization: {
        browseButton: 'استعراض',
        uploadButton: 'تحميل الملف',
        cancelButton: 'الغاء',
        uploadFileTooltip: 'تحميل الملف',
        cancelFileTooltip: 'الغاء التحميل'
    }});
    $('#agreeLetterOther').on('uploadEnd', function (event) {
        var args = event.args;
        var fileName = args.file;
        var serverResponce = args.response;
        uploaded_file_name = fileName;
        $('#log').html(serverResponce);
    });

    $('#CVUpload').jqxFileUpload({width: 250, fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', uploadTemplate: 'warning', localization: {
        browseButton: 'استعراض',
        uploadButton: 'تحميل الملف',
        cancelButton: 'الغاء',
        uploadFileTooltip: 'تحميل الملف',
        cancelFileTooltip: 'الغاء التحميل'
    }});
    $('#CVUpload').on('uploadEnd', function (event) {
        var args = event.args;
        var fileName = args.file;
        var serverResponce = args.response;
        resume_file_name = fileName;
        $('#CVUpload_log').html(serverResponce);
    });

    $("#btnOtherPersonalSave").jqxButton({width: '150', height: '25', theme: Curr_theme});
    $('#btnOtherPersonalSave').on('click', function () {
        var r = $('#role_list_others').jqxDropDownList('val');

        var rowindex = $('#gridOtherStuff').jqxGrid('getselectedrowindex');
        var dataRecord = $("#gridOtherStuff").jqxGrid('getrowdata', rowindex);
        var person_id = dataRecord['person_id'];
        //alert(person_id);
        $.ajax({
            url: "../Data/saveOtherPersonal.php?q=" + <? echo $project_id ?> +"&person_id=" + person_id + "&role_id=" + $('#role_list_others').jqxDropDownList('val') + "&file_name=" + uploaded_file_name + "&resume_url=" + resume_file_name,
            success: function (data) {
                if (data == 200) {
                    $('#searchOtherPersonal_log').html('');
                    window.location.reload();
                }
                else {
                    $('#searchOtherPersonal_log').html(data);
                }
            }

        });
    });
    $("#btnOtherPersonalClose").jqxButton({width: '150', height: '25', theme: Curr_theme});
    $('#btnOtherPersonalClose').on('click', function () {
        $('#SearchPersonalFrm').html('');
    });
    $('#gridOtherStuff').on('rowdoubleclick', function (event) {
        var args = event.args;
        // row's bound index.
        var boundIndex = args.rowindex;
        // row's visible index.
        var visibleIndex = args.visibleindex;
        // right click.
        var rightclick = args.rightclick;
        // original event.
        var ev = args.originalEvent;
        rowindex = $('#gridOtherStuff').jqxGrid('getselectedrowindex');
        dataRecord = $("#gridOtherStuff").jqxGrid('getrowdata', rowindex);
        person_id = dataRecord['person_id'];
        //alert(person_id);
        $('#agreeLetterOther').jqxFileUpload({uploadUrl: 'inc/fileUpload.php?type=consultant_agreement&q=' + '<? echo $project_id; ?>' + '&person_id=' + person_id});
        $('#CVUpload').jqxFileUpload({uploadUrl: 'inc/fileUpload.php?type=consultant_resume&q=' + '<? echo $project_id; ?>' + '&person_id=' + person_id});

        $('#showUploadfileOthers').show();
        $('#showUploadCV').show();
    });
});
</script>
<fieldset style="width: 90%;text-align: right;margin-bottom: 25px;">
    <legend style="text-align: center">
        <h3> اضافة عضو جديد/ Add a new member</h3>
    </legend>
    <table style="width: 800px;">
        <tr>
            <td><span class="classic">
                البريد الالكتروني / Email 
                </span>
                <span class="error">*</span>
            </td>
            <td colspan="2">
                <input type="text" id="SearchByName"/>
                <input id="searchButton_OtherPersonal" type="button" value="Search / بحث "/>
                <a href="register.php" target="_blank">
                    اضافة جديد / New Consultant
                </a>
            </td>

        </tr>

        <tr>
            <td><span class="classic">
                نوع المشاركة / Role
                </span>
                <span class="error">*</span>
            </td>
            <td>
                <div id="role_list_others"></div>
            </td>

            <td></td>
        </tr>
    </table>

    <table style="width: 800px;">
        <tr id="showUploadfileOthers" style="display: none; ">
            <td><span class="classic">
                    الموافقة الخطية/ Acceptance letter
                </span>
            </td>
            <td>
                <div id="agreeLetterOther"></div>
                <div id="log"></div>
            </td>
            <td style="padding-top: 10px; vertical-align: middle;">
                <a href="../forms/Consultant_Consent_Letter.docx" target="_blank"
                   style="padding-top: 10px; vertical-align: middle;">
                    تحميل النموذج / Template
                </a>
            </td>
        </tr>
        <tr id="showUploadCV" style="display: none; ">
            <td><span class="classic">
                    السيرة الذاتية/ CV
                </span></td>
            <td>
                <div id="CVUpload"></div>
                <div id="CVUpload_log"></div>
            </td>
            <td style="padding-top: 10px; vertical-align: middle;">
                <a href="../forms/CV.docx" target="_blank">
                    تحميل النموذج / Template
                </a>
            </td>
        </tr>
        <td colspan="4">
            <p class="error">
            لاضافة الموافقة الخطيةو السيرة الذاتية قم بالنقر المذدوج علي الباحث
                <br>
                Double click on researcher record to add acceptance letter and cv
            </p>
        </td>
        <tr>
            <td colspan="4">
                <div id='gridOtherStuff' style="direction: rtl;float: left;margin-top: 20px;float: right;"></div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <div id="searchOtherPersonal_log" class="error"></div>
            </td>
        </tr>

        <tr>
            <td colspan="4" style="text-align: center">
                <input type="button" value="Save / حفظ " id='btnOtherPersonalSave'
                       style="direction: rtl;margin-top: 20px;margin-right: 0px;"/>
                <input type="button" value="Close / إغلاق " id='btnOtherPersonalClose'
                       style="direction: rtl;margin-top: 20px;margin-right: 10px;"/>
            </td>
        </tr>
    </table>
</fieldset>