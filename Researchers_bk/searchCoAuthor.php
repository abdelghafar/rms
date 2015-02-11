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
        $("#SearchByEmpCode").jqxMaskedInput({width: '250px', height: '25px', rtl: true, mask: '#######', theme: Curr_theme});
        $("#searchButton").jqxButton({width: 50, height: 20, theme: Curr_theme});
        $('#searchButton').on('click', function () {
            $('#gridCoAuthors').jqxGrid('clear');
            var SearchByEmpCodeVal = $('#SearchByEmpCode').jqxMaskedInput('inputValue');
            $.ajax({
                url: "../Data/GetPersonByEmpCode.php?empcode=" + SearchByEmpCodeVal,
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
                        //$('#coAuthorName').html('هذا الرقم غير مسجل برجاء تسجيل الباحث أولا');
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
                        $("#gridCoAuthors").jqxGrid('addrow', null, tmpPersonData);
                    }
                }
            });
        });
        var CoAuthorsSource = {
            datafields: [{
                    name: 'name',
                    type: 'string'
                }, {
                    name: 'empCode',
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
        $("#gridCoAuthors").jqxGrid(
                {
                    width: '100%',
                    height: 400,
                    autoheight: true,
                    sortable: true,
                    rtl: true,
                    theme: Curr_theme,
                    source: CoAuthorsSourceAdapter,
                    columns: [
                        {text: 'اسم الباحث', datafield: 'name', cellsalign: 'right', align: 'right', width: 200},
                        {text: 'رقم المنسوب', datafield: 'empCode', align: 'right', cellsalign: 'right', width: 100},
                        {text: 'الكلية/الادارة', datafield: 'College', align: 'right', cellsalign: 'right', width: 200},
                        {text: 'التخصص العام', datafield: 'Dept', align: 'right', cellsalign: 'right', width: 150},
                        {text: 'التخصص الدقيق', datafield: 'Speical_Field', align: 'right', cellsalign: 'right', width: 150},
                        {text: 'الدرجة العلمية', datafield: 'Position', align: 'right', cellsalign: 'right', width: 150}
                    ]
                });
        $("#btnSave").jqxButton({width: '150', height: '25', theme: Curr_theme});
        $('#btnSave').on('click', function () {
            $.ajax({
                url: "../Data/saveCoAuthor.php?q=" + <? echo $project_id ?> + "&person_id=" + tmpPerson_id,
                success: function (data) {
                    $('#SearchFrm').html('');
                    ReloadCoIs();
                }
            });
        });
        $("#btnClose").jqxButton({width: '150', height: '25', theme: Curr_theme});
        $('#btnClose').on('click', function () {
            $('#SearchFrm').html('');
        });
    });
</script>
<fieldset style="width: 95%;text-align: right;margin-bottom: 25px;">
    <legend>
        اضافة باحث مشارك
    </legend>
    <table style="width: 800px;">
        <tr>
            <td>
                رقم المنسوب
                <span class="error">*</span>
            </td>
            <td>
                <input id="SearchByEmpCode" type="text" placeholder="رقم المنسوب" name="txtSearch"/>
                <input id="searchButton" value="بحث"/>
            </td>

        </tr>
        <tr>
            <td colspan="2">
                <div id='gridCoAuthors' style="direction: rtl;float: left;margin-top: 20px;float: right;"></div>
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