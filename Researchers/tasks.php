<?
session_start();
if (isset($_SESSION['Authorized'])) {
    if ($_SESSION['Authorized'] != 1) {
        header('Location:../login.php');
    }
}
require_once '../lib/Reseaches.php';
require_once '../lib/users.php';

if (isset($_SESSION['q'])) {
    $project_id = $_SESSION['q'];
    $obj = new Reseaches();
    $personId = $_SESSION['person_id'];
    $isAuthorized = $obj->IsAuthorized($project_id, $personId);
    $CanEdit = $obj->CanEdit($project_id);
    if ($isAuthorized == 1 && $CanEdit == 1) {

    } else {
        echo '<div class="errormsgbox" style="width: 850px;height: 30px;"><h4>This project is locked from the admin</h4></div>';
        exit();
    }
}
?>
<html>
<head>


    <script type="text/javascript">

        $(document).ready(function () {
            //var theme = "";

            var post_data = 'project_id=' + $('#project_id').val() + '&phase_id=' + $('#global_phase_id').val();
            var source =
            {
                datatype: "json",
                datafields: [
                    {name: 'project_id'},
                    {name: 'phase_id'},
                    {name: 'task_id'},
                    {name: 'task_name'},
//                                {name: 'start_date'},
//                                {name: 'end_date'},
                    {name: 'task_desc'},
                    {name: 'objective_id'},
                    {name: 'phase_name'}
                ],
                url: 'inc/tasks_list_grid_data.php?' + post_data,
                cache: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#tasks_grd").jqxGrid(
                {
                    source: source,
                    theme: 'energyblue',
                    editable: false,
                    pageable: true,
                    filterable: true,
                    width: 940,
                    pagesize: 20,
                    autorowheight: true,
                    autoheight: true,
                    columnsresize: true,
                    sortable: true,
                    rtl: true,
                    columns: [
                        {text: 'project_id', datafield: 'project_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'phase_id', datafield: 'phase_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'task_id', datafield: 'task_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'Phase / المرحلة', datafield: 'phase_name', type: 'string', width: 230, align: 'center', cellsalign: 'right'},
                        {text: 'Task / المهمة', datafield: 'task_name', type: 'string', width: 230, align: 'center', cellsalign: 'right'},
//                                {text: 'بداية المهمة', datafield: 'start_date', type: 'string', width: 80, align: 'center', cellsalign: 'right'},
//                                {text: 'نهاية المهمة', datafield: 'end_date', type: 'string', width: 80, align: 'center', cellsalign: 'right'},
                        {text: 'Description /الوصف ', datafield: 'task_desc', type: 'string', width: 300, align: 'center', cellsalign: 'right'},
                        {text: 'objective_id', datafield: 'objective_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'Edit/تعديل', datafield: '..', align: 'center', width: 90, columntype: 'button', cellsrenderer: function () {
                            return "..";
                        }, buttonclick: function (row) {
                            var dataRecord = $("#tasks_grd").jqxGrid('getrowdata', row);
                            var post_data = 'task_id=' + dataRecord.task_id + '&project_id=' + dataRecord.project_id + '&phase_id=' + dataRecord.phase_id;
                            $.ajax({
                                url: "task_data_form.php",
                                dataType: "html",
                                data: post_data,
                                type: 'POST',
                                beforeSend: function () {
                                    $("#form_div").html("<img src='images/load.gif'/>loading...");
                                },
                                success: function (data) {
                                    $("#form_div").html(data);
                                }
                            });

                        }
                        },
                        {text: 'Delete/حذف', datafield: 'حذف', width: 90, align: 'center', columntype: 'button', cellsrenderer: function () {
                            return "..";
                        }, buttonclick: function (row) {
                            //window.confirm("هل انت متأكد من حذف هذا البيان");
                            var r = confirm("هل انت متأكد من حذف هذا البيان / Are you sure you want to Delete This item");
                            if (r == true) {
                                var dataRecord = $("#tasks_grd").jqxGrid('getrowdata', row);
                                var post_data = '&task_id=' + dataRecord.task_id;
                                $.ajax({
                                    type: 'post',
                                    url: 'inc/deleteTask.php',
                                    datatype: "html",
                                    data: post_data,
                                    beforeSend: function () {
                                        $("#taskresult").html("<img src='images/load.gif'/>loading...");
                                    },
                                    success: function (data) {
                                        $("#taskresult").html(data);
                                        if ($("#task_operation_flag").val() === 'true') {
                                            alert("تم الحذف بنجاح/ Item Deleted Successfully ");
                                            //$("#form_div").html("");
                                            load_tasks_grd();
//                                                        var selectedrowindex = $("#tasks_grd").jqxGrid('getselectedrowindex');
//                                                        var rowscount = $("#tasks_grd").jqxGrid('getdatainformation').rowscount;
//                                                        if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
//                                                            var id = $("#tasks_grd").jqxGrid('getrowid', selectedrowindex);
//                                                            var commit = $("#tasks_grd").jqxGrid('deleterow', id);
//                                                        }
                                        }
                                    }
                                });
                            }
                        }
                        }
                    ]
                });


        });
    </script>


<h2 style="font-size: 14px">
    المهام / Tasks
</h2>
<hr/>


<div id="taskresult" dir="rtl" style="padding-top: 10px"></div>

<div id="tasks_grd">

</div>
