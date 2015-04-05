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
?>
<script type="text/javascript">

    $(document).ready(function() {
        //var theme = "";

        var post_data = 'project_id=' + $('#project_id').val() + '&objective_id=' + $('#global_objective_id').val();
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'project_id'},
                        {name: 'objective_id'},
                        {name: 'task_id'},
                        {name: 'phase_id'},
                        {name: 'objective_name'},
                        {name: 'task_name'},
                        {name: 'phase_name'}
                    ],
                    url: 'inc/objective_tasks_list_grid_data.php?' + post_data,
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
                    width: 930,
                    pagesize: 20,
                    autorowheight: true,
                    autoheight: true,
                    columnsresize: true,
                    sortable: true,
                    rtl: true,
                    columns: [
                        {text: 'project_id', datafield: 'project_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'objective_id', datafield: 'objective_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'task_id', datafield: 'task_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'phase_id', datafield: 'phase_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'Objective / الهدف', datafield: 'objective_name', type: 'string', width: 310, align: 'center', cellsalign: 'right'},
                        {text: 'Task / المهمة', datafield: 'task_name', type: 'string', width: 310, align: 'center', cellsalign: 'right'},
                        {text: 'Phase / المرحلة', datafield: 'phase_name', type: 'string', width: 310, align: 'center', cellsalign: 'right'}/*,
                        {text: 'تعديل', datafield: '..', align: 'center', width: 50, columntype: 'button', cellsrenderer: function() {
                                return "..";
                            }, buttonclick: function(row) {
                                var dataRecord = $("#tasks_grd").jqxGrid('getrowdata', row);
                                var post_data = 'task_id=' + dataRecord.task_id + '&project_id=' + dataRecord.project_id + '&objective_id=' + dataRecord.objective_id;
                                $.ajax({
                                    url: "task_data_form.php",
                                    dataType: "html",
                                    data: post_data,
                                    type: 'POST',
                                    beforeSend: function() {
                                        $("#form_div").html("<img src='images/load.gif'/>loading...");
                                    },
                                    success: function(data) {
                                        $("#form_div").html(data);
                                    }
                                });

                            }
                        },
                        {text: 'حذف', datafield: 'حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function() {
                                return "..";
                            }, buttonclick: function(row) {
                                //window.confirm("هل انت متأكد من حذف هذا البيان");
                                var r = confirm("هل انت متأكد من حذف هذا البيان");
                                if (r == true)
                                {
                                    var dataRecord = $("#tasks_grd").jqxGrid('getrowdata', row);
                                    var post_data = '&task_id=' + dataRecord.task_id;
                                    $.ajax({
                                        type: 'post',
                                        url: 'inc/deleteTask.php',
                                        datatype: "html",
                                        data: post_data,
                                        beforeSend: function() {
                                            $("#taskresult").html("<img src='images/load.gif'/>loading...");
                                        },
                                        success: function(data) {
                                            $("#taskresult").html(data);
                                            if ($("#task_operation_flag").val() === 'true')
                                            {
                                                alert("تم الحذف بنجاح");
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
                        }*/
                    ]
                });


    });
</script>



<h2 style="font-size: 14px">
    أهداف ومهام المشروع / Objectives and Tasks Mapping
</h2>
<hr/>
           
        
    <div id="taskresult" dir="rtl" style="padding-top: 10px">    </div>

    <div id="tasks_grd">

    </div>
</fieldset>