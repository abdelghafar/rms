<?php
session_start();
require_once '../lib/persons.php';
if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        var Curr_theme = 'energyblue';
        var tmpPersonData = null;
        var tmpPerson_id = null;
        var tmpName = null;
        var tmpEmpCode = null;
        var tmpEmail = null;
        var tmpDept = null;
        var tmpCollege = null;
        var rowindex = null;
        var dataRecord = null;
        var person_id = null;
        var uploaded_file_name = null;
        var resume_url = null;
        $("#Search").jqxInput({width: 500, height: 30 rtl: true, theme: Curr_theme});
        $("#searchButton_CoAuthor").jqxButton({width: 100, height: 30, theme: Curr_theme});
        $('#searchButton_CoAuthor').on('click', function () {
            $('#gridCoAuthors').jqxGrid('clear');
            var SearchVal = $('#Search').jqxInput('val');
            $.ajax({
                url: "../Data/GetPersonByEmail.php?q=" + SearchVal,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    $('#coAuthorName').html("<img src='common/images/ajax-loader.gif' />");
                },
                success: function (data) {
                    if (data === null) {
                        tmpPerson_id = null;
                        tmpName = null;
                        tmpEmpCode = null;
                        tmpEmail = null;
                        tmpDept = null;
                        tmpCollege = null;
                        //$('#coAuthorName').html('هذا الرقم غير مسجل برجاء تسجيل الباحث أولا');
                    } else {
                        tmpPersonData = data;
                        tmpPerson_id = data[0]['person_id'];
                        tmpName = data[0]['name'];
                        tmpEmpCode = data[0]['empCode'];
                        tmpEmail = data[0]['Email'];
                        tmpDept = data[0]['Dept'];
                        tmpCollege = data[0]['College'];
                        //$('#coAuthorName').html(tmpName);
                        $("#gridCoAuthors").jqxGrid('addrow', null, tmpPersonData);
                    }
                }
            });
            $('#showUploadfile').hide();
            $('#showUploadCV').hide();
        });
        var CoAuthorsSource = {
            datafields: [
                {
                    name: 'name',
                    type: 'string'
                },
                {
                    name: 'empCode',
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
                    name: 'Email',
                    type: 'string'
                },
                {
                    name: 'Position',
                    type: 'string'
                },
                {
                    name: 'person_id',
                    type: 'string'
                }
            ],
            datatype: "json"
        };
        var CoAuthorsSourceAdapter = new $.jqx.dataAdapter(CoAuthorsSource);
        $("#gridCoAuthors").jqxGrid(
            {
                width: '100%',
                height: 400,
                pageable: true,
                autoheight: true,
                sortable: true,
                pagesize: 10,
                rtl: true,
                theme: Curr_theme,
                source: CoAuthorsSourceAdapter,
                columns: [
                    {text: 'person_id', datafield: 'person_id', hidden: true},
                    {text: 'Employee Id / رقم المنسوب', datafield: 'empCode', align: 'right', cellsalign: 'right', width: 200},
                    {text: 'Name / الاسم', datafield: 'name', cellsalign: 'right', align: 'right', width: 200},
                    {text: 'College/ الكلية', datafield: 'College', align: 'right', cellsalign: 'right', width: 200},
                    {text: 'Title/ الدرجة العلمية', datafield: 'Position', align: 'right', cellsalign: 'right', width: 200},
                    {text: 'Email / البريد الالكتروني', datafield: 'Email', align: 'right', cellsalign: 'right'}
                ]
            });

        $('#agreeLetter').jqxFileUpload({width: 250, fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf', uploadTemplate: 'warning', localization: {
            browseButton: 'استعراض',
            uploadButton: 'تحميل الملف',
            cancelButton: 'الغاء',
            uploadFileTooltip: 'تحميل الملف',
            cancelFileTooltip: 'الغاء التحميل'
        }});
        $('#agreeLetter').on('uploadEnd', function (event) {
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
            resume_url = fileName;
            $('#CVUpload_log').html(serverResponce);
        });

        $("#btnSave").jqxButton({width: '150', height: '25', theme: Curr_theme});
        $('#btnSave').on('click', function () {
            $.ajax({
                url: "../Data/saveCoAuthor.php?q=" + <? echo $project_id ?> +"&person_id=" + person_id + "&file_name=" + uploaded_file_name + "&resume_url=" + resume_url,
                success: function (data) {
                    if (data == 200) {
                        $('#searchCoAuthor_log').html('');
                        window.location.reload();
                    }
                    else {
                        //$('#SearchFrm').html('');
                        $('#searchCoAuthor_log').html(data);
                    }

                }
            });

        });
        $("#btnClose").jqxButton({width: '150', height: '25', theme: Curr_theme});
        $('#btnClose').on('click', function () {
            $('#SearchFrm').html('');
        });

        $('#gridCoAuthors').on('rowdoubleclick', function (event) {
            var args = event.args;
            // row's bound index.
            var boundIndex = args.rowindex;
            // row's visible index.
            var visibleIndex = args.visibleindex;
            // right click.
            var rightclick = args.rightclick;
            // original event.
            var ev = args.originalEvent;
            rowindex = $('#gridCoAuthors').jqxGrid('getselectedrowindex');
            dataRecord = $("#gridCoAuthors").jqxGrid('getrowdata', rowindex);
            person_id = dataRecord['person_id'];
//            alert('person_id::' + person_id);
            $('#agreeLetter').jqxFileUpload({uploadUrl: 'inc/fileUpload.php?type=coAuthor_agreement&q=' + '<? echo $project_id; ?>' + '&person_id=' + person_id});
            $('#CVUpload').jqxFileUpload({uploadUrl: 'inc/fileUpload.php?type=coAuthor_resume&q=' + '<? echo $project_id; ?>' + '&person_id=' + person_id});
            $('#showUploadfile').show();
            $('#showUploadCV').show();

        });
    });
</script>
<fieldset style="width: 95%;text-align: right;margin-bottom: 25px;">
    <legend style="text-align: center">
        <h3>
            اضافة باحث مشارك / Add a new Co-I
        </h3>
    </legend>
    <table style="width: 800px;">
        <tr>
            <td><span class="classic">
                البريد الالكتروني
                </span>
                <span class="error">*</span>
            </td>
            <td colspan="2">
                <input id="Search" type="text" name="txtSearch"/>
                <input id="searchButton_CoAuthor" value="Search / بحث " type="button"/>
            </td>
        </tr>
    </table>

    <table style="width: 800px;">
        <tr id="showUploadfile" style="display: none; ">
            <td style="width: 177px; ">
                <span class="classic">
                    الموافقة الخطية/ Acceptance letter
                </span>
                <span class="error">*</span>
            </td>

            <td>
                <div id="agreeLetter"></div>
                <div id="log"></div>
            </td>
            <td style="padding-top: 10px; vertical-align: middle;">
                <a href="../forms/CO-Is_Consent_Letter.docx" target="_blank">
                تحميل النموذج / Template
                </a>
            </td>
            <td></td>
        </tr>
        <tr id="showUploadCV" style="display: none; ">
            <td>
                <span class="classic">
                    السيرة الذاتية/ CV
                </span>
                <span class="error">*</span>
            </td>
            <td>
                <div id="CVUpload"></div>
                <div id="CVUpload_log"></div>
            </td>
            <td style="padding-top: 10px; vertical-align: middle;">
                <a href="../forms/CV.docx" target="_blank">
                تحميل النموذج / Template
                </a>
            </td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">
            <p class="error">
                    لاضافة الموافقة الخطيةو السيرة الذاتية قم بالنقر المذدوج علي الباحث
                    <br>
                    Double click on researcher record to add acceptance letter and cv
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
            <div id='gridCoAuthors' style="direction: rtl;float: left;margin-top: 20px;float: right;"></div>
            </td>
        </tr>

        <tr>
            <td colspan="4">
            <div id="searchCoAuthor_log" class="error"></div>
            </td>
        </tr>

        <tr>
            <td colspan="4" style="text-align: center">
            <input type="button" value="Save / حفظ " id='btnSave'
                       style="direction: rtl;margin-top: 20px;margin-right: 0px;"/>
                <input type="button" value="Close / إغلاق " id='btnClose'
                       style="direction: rtl;margin-top: 20px;margin-right: 10px;"/>
            </td>
        </tr>
    </table>
</fieldset>