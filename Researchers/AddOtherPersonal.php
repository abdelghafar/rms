<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 07/04/15
 * Time: 11:59 ص
 */
session_start();
require_once '../lib/persons.php';
if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        var roles_lst_dataSource = {
            datatype: "json",
            datafields: [
                {name: 'seq_id'},
                {name: 'role_name'}
            ],
            url: '../Data/GetOtherStuffRoles.php',
            async: false
        };
        var Curr_theme = 'energyblue';
        var dataAdapter = new $.jqx.dataAdapter(roles_lst_dataSource);
        $("#role_list").jqxDropDownList({displayMember: "role_name", valueMember: "seq_id", width: 300, height: 25, rtl: true, theme: Curr_theme, source: dataAdapter, promptText: 'من فضلك اختر الفئة'});
        $('#OtherPersonalCount').jqxNumberInput({width: 300, height: 25, theme: Curr_theme, max: 5, digits: 1, decimalDigits: 0, min: 1, spinMode: 'simple', decimal: 1});
        $("#AddOtherPersonal_btnSave").jqxButton({width: '150', height: '25', theme: Curr_theme});
        var OtherPersonalCount = 0;
        var selected_list_item = $('#role_list').jqxDropDownList('getSelectedItem');
        var parent_role_id = 0;
        $('#role_list').on('change', function (event) {
            var args = event.args;
            if (args) {
                // index represents the item's index.
                var index = args.index;
                var item = args.item;
                // get item's label and value.
                var label = item.label;
                var value = item.value;
                parent_role_id = value;
            }
        });


        $('#AddOtherPersonal_btnSave').click(function () {
            $.ajax({url: 'inc/AddOtherPersonalSave.inc.php?q=' + parent_role_id + '&p=' + $('#OtherPersonalCount').jqxNumberInput('getDecimal'), type: 'post', success: function (data) {
                $('#AddOtherPersonalLog').html(data);
                var OtherPersonalDataSource =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'role_name'},
                        {name: 'parent_role'},
                        {name: 'seq_no'}
                    ],
                    id: 'seq_no',
                    url: 'ajax/project_stuff_other_personal.php?q=<? echo $_SESSION['q']; ?>'
                };
                var dataAdapter = new $.jqx.dataAdapter(OtherPersonalDataSource);
                $("#gridOthers").jqxGrid({source: dataAdapter});
            }});
        });
        $("#AddOtherPersonal_btnClose").jqxButton({width: '150', height: '25', theme: Curr_theme});
        $('#AddOtherPersonal_btnClose').on('click', function () {
            $('#AddOtherPersonal').html('');
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
                نوع المشاركة / Role
                </span>
                <span class="error">*</span>
            </td>
            <td>
                <div id="role_list"></div>
            </td>
        </tr>

        <tr>
            <td><span class="classic">
العدد / Count
                </span>
                <span class="error">*</span>
            </td>
            <td>
                <div id="OtherPersonalCount"></div>
            </td>
        </tr>


        <tr>
            <td colspan="2">
                <div id='AddOtherPersonalLog' style="height: 20px;">

                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">
                <input type="button" value="Save / حفظ " id='AddOtherPersonal_btnSave'
                       style="direction: rtl;margin-top: 20px;margin-right: 0px;"/>
                <input type="button" value="Close / إغلاق " id='AddOtherPersonal_btnClose'
                       style="direction: rtl;margin-top: 20px;margin-right: 10px;"/>
            </td>
        </tr>
    </table>
</fieldset>