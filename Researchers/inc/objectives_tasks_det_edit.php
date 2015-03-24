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
$cur_obj_id = $_POST['objective_id'];
?>
<script type="text/javascript">

    $(document).ready(function() {
        var theme = "energyblue";
        $("#closeTasksEditButton").jqxButton({width: '100', height: '30', theme: theme});

        var post_data = 'project_id=' + $('#project_id').val() + '&objective_id=' + $('#cur_obj_id').val();

        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'project_id'},
                        {name: 'phase_id'},
                        {name: 'task_id'},
                        {name: 'task_name'},
                        {name: 'old_obj_id'},
                        {name: 'phase_name'},
                        {name: 'obj_check'}
                    ],
                    updaterow: function(rowid, rowdata, commit) {
                        if (rowdata.obj_check == true) // add objective by update task table 
                            new_obj_id = $('#cur_obj_id').val();
                        else
                            new_obj_id = 0;

                        if (rowdata.obj_check !== null)
                        {
                            //alert(rowdata.task_id);
                            var post_data = 'task_id=' + rowdata.task_id + '&objective_id=' + new_obj_id;
                            $.ajax({
                                type: 'post',
                                url: 'inc/editObjectiveTasks.php',
                                datatype: "html",
                                data: post_data,
                                beforeSend: function() {
                                    //$("#taskresult").html("<img src='images/load.gif'/>loading...");
                                },
                                success: function(data) {
                                    commit(true);
                                    load_tasks_grd(); 
                                    /*$("#taskresult").html(data);
                                     if ($("#task_operation_flag").val() === 'true')
                                     {
                                     $("#form_div").html("");
                                     
                                     
                                     }
                                     else
                                     alert('حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى');*/
                                },
                                error: function() {
                                    commit(false);
                                }
                            });
                        }

                    },
                    url: 'inc/objective_tasks_grid_data_edit.php?' + post_data,
                    cache: false
                };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#obj_tasks_grd").jqxGrid(
                {
                    source: source,
                    theme: 'energyblue',
                    editable: true,
                    pageable: true,
                    filterable: true,
                    width: 600,
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
                        {text: 'Phase / المرحلة', datafield: 'phase_name', type: 'string', width: 275, align: 'center', cellsalign: 'right', editable: false},
                        {text: 'Task / المهمة', datafield: 'task_name', type: 'string', width: 275, align: 'center', cellsalign: 'right', editable: false},
                        {text: 'old_obj_id', datafield: 'old_obj_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: ' ', datafield: 'obj_check', align: 'center', cellsalign: 'center', width: 50, columntype: 'checkbox'}/*,
                         {text: 'تعديل', datafield: '..', align: 'center', width: 50, columntype: 'button', cellsrenderer: function() {
                         return "..";
                         }, buttonclick: function(row) {
                         var dataRecord = $("#tasks_grd").jqxGrid('getrowdata', row);
                         var post_data = 'task_id=' + dataRecord.task_id + '&project_id=' + dataRecord.project_id + '&phase_id=' + dataRecord.phase_id;
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

        $('#closeTasksEditButton').on('click', function() {
            $("#form_div").html("");
            //load_tasks_grd();

        });


    });
</script>



<fieldset style="width:620px;text-align: right;"> 
    <legend>
        <label>
            <?
            echo 'تخصيص أهداف ومهمات المشروع / Objective and Task Assignment';
            ?>
        </label>
    </legend>

    <input type="hidden" id="cur_obj_id" name="cur_obj_id" value="<? echo $cur_obj_id; ?>" />
    <div id="taskresult" dir="rtl" style="padding-top: 10px">    </div>

    <div id="obj_tasks_grd">

    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width: 100 ;text-align: center;padding-right: 250">
            <input type="button" value="Close / إغلاق " id='closeTasksEditButton' style="margin: 10px 10px;"  />
        </div>
    </div>
</fieldset>