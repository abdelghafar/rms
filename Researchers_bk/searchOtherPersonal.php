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
        var tmpGender = null;
        var tmpEmpCode = null;
        var tmpSpeicalField = null;
        var tmpMajor_Field = null;
        var tmpEmail = null;
        var tmpDept = null;
        var tmpCollege = null;
        $("#SearchByName").jqxInput({width: '250px', height: '25px', rtl: true, theme: Curr_theme});
        $("#searchButton").jqxButton({width: 50, height: 20, theme: Curr_theme});
        var roles_lst_dataSource = {
            datatype: "json",
            datafields: [
                {name: 'seq_id'},
                {name: 'role_name'}
            ],
            url: '../Data/GetStuff_Roles.php',
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(roles_lst_dataSource);
        $("#role_list").jqxDropDownList({displayMember: "role_name", valueMember: "seq_id", width: 250, height: 25, rtl: true, theme: Curr_theme, source: dataAdapter, promptText: "من فضلك اختر الوظيفة"});




        $('#searchButton').on('click', function () {
            $('#gridOtherStuff').jqxGrid('clear');
            var SearchByName = $('#SearchByName').jqxInput('val');
            $.ajax({
                url: "../Data/searchPersonByName.php?q=" + SearchByName,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    $('#coAuthorName').html("<img src='common/images/ajax-loader.gif' />");
                },
                success: function (data) {
                    if (data === null)
                    {
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
        });
        var CoAuthorsSource = {
            datafields: [{
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
                }, {
                    name: 'College',
                    type: 'string'
                }, {
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
                }],
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
                        {text: 'اسم الباحث-ع', datafield: 'name_ar', cellsalign: 'right', align: 'right', width: 200},
                        {text: 'اسم الباحث -E', datafield: 'name_en', align: 'right', cellsalign: 'right', width: 200},
                        {text: 'التخصص العام', datafield: 'Major_Field', align: 'right', cellsalign: 'right', width: 200},
                        {text: 'التخصص الدقيق', datafield: 'Speical_Field', align: 'right', cellsalign: 'right', width: 150},
                        {text: 'الكلية/الادارة', datafield: 'College', align: 'right', cellsalign: 'right', width: 150},
                        {text: 'القسم', datafield: 'Dept', align: 'right', cellsalign: 'right', width: 150},
                        {text: 'الدرجة', datafield: 'Position', align: 'right', cellsalign: 'right', width: 150},
                        {text: 'البريد الالكتروني', datafield: 'Email', align: 'right', cellsalign: 'right', width: 150}
                    ]
                });
        $("#btnSave").jqxButton({width: '150', height: '25', theme: Curr_theme});
        $('#btnSave').on('click', function () {
            var r = $('#role_list').jqxDropDownList('val');

            var rowindex = $('#gridOtherStuff').jqxGrid('getselectedrowindex');
            var dataRecord = $("#gridOtherStuff").jqxGrid('getrowdata', rowindex);
            var person_id = dataRecord['person_id'];

            $.ajax({
                url: "../Data/saveOtherPersonal.php?q=" + <? echo $project_id ?> + "&person_id=" + person_id + "&role_id=" + $('#role_list').jqxDropDownList('val'),
                success: function (data) {
                    if (data === "")
                    {
                        //$('#SearchPersonalFrm').html('');
                    }
                    else
                    {
                        $('#SearchPersonalFrm').html(data);
                    }
                    //ReloadCoIs();
                }
            });
        });
        $("#btnClose").jqxButton({width: '150', height: '25', theme: Curr_theme});
        $('#btnClose').on('click', function () {
            $('#SearchPersonalFrm').html('');
        });
    });
</script>
<fieldset style="width: 98%;text-align: right;margin-bottom: 25px;">
    <legend>
        اضافة باحث مشارك
    </legend>
    <table style="width: 800px;">
        <tr>
            <td>
                الاسم
            </td>
            <td>
                <input type="text" id="SearchByName"/>
                <input id="searchButton" value="بحث"/>
            </td>
        </tr>
        <tr>
            <td>
                الوظيفة
            </td>
            <td>
                <div id="role_list"></div>
            </td>
        </tr>
        <tr>
            <td>
                الموافقة الخطية
            </td>
            <td>
                <input type="file" name="approve" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id='gridOtherStuff' style="direction: rtl;float: left;margin-top: 20px;float: right;"></div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id='error' style="height: 20px;">

                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" value="حفظ" id='btnSave' style="direction: rtl;float: right;margin-top: 20px;float: right;margin-right: 0px;"  />
                <input type="button" value="اغلاق" id='btnClose' style="direction: rtl;float: right;margin-top: 20px;float: right;margin-right: 10px;"  />
            </td>
        </tr>
    </table>
</fieldset>