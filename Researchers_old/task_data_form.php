<?php
session_start();
$project_id = $_REQUEST['project_id'];
$phase_id = $_REQUEST['phase_id'];
$task_id = $_REQUEST['task_id'];

require_once '../lib/projectTasks.php';
if ($task_id != 0) {
    $task = new projectTask();
    $task_rs = $task->GetTasksData($task_id);
} else {
    
}
?>
<!DOCTYPE html>

<script type="text/javascript">
    $(document).ready(function() {
        var theme = "energyblue";
        $("#saveButton").jqxButton({width: '100', height: '30', theme: theme});
        $("#task_name").jqxInput({width: '500', height: '30', theme: theme, rtl: true});
        $("#task_desc").jqxInput({width: '500', height: '130', theme: theme, rtl: true});
        /*$("#startDate").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
        $("#endDate").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
        $('#startDate ').jqxDateTimeInput('setDate', ",,");
       $('#endDate ').jqxDateTimeInput('setDate', ",,");

        $("#start_date").val($('#startDate').jqxDateTimeInput('getText'));
        $('#startDate').on('change', function(event)
        {
            $("#start_date").val($('#startDate').jqxDateTimeInput('getText'));
        });
        $("#end_date").val($('#endDate').jqxDateTimeInput('getText'));
        $('#endDate').on('change', function(event)
        {
            $("#end_date").val($('#endDate').jqxDateTimeInput('getText'));
        });
*/
        $('#taskdataForm').jqxValidator({rules: [
                {input: '#task_name', message: 'من فضلك ادخل عنوان المهمة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'}], theme: 'energyblue', animation: 'fade'
        });

        $('#saveButton').on('click', function() {
            var valid = $('#taskdataForm').jqxValidator('validate');
            if (valid)
            {
                //$("#taskdataForm").submit();
                //$("#poet_id").val($("#poet_id_val").val());
                //project_id = $("#project_id").val();
                //phase_id = $("#phase_id").val();
                $.ajax({
                    type: 'post',
                    url: 'inc/saveTask.php',
                    datatype: "html",
                    data: $("#taskdataForm").serialize(),
                    beforeSend: function() {
                        $("#taskresult").html("<img src='images/load.gif'/>loading...");
                    },
                    success: function(data) {
                        $("#taskresult").html(data);
                        if ($("#task_operation_flag").val() === 'true')
                        {
                            $("#form_div").html("");
                            load_tasks_grd();

                        }
                        else
                            alert('حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى');
                    }
                });
            }
            else
                alert("من فضلك أكمل باقي البيانات");
        });
    });</script>


<form id="taskdataForm" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>"/>
    <input type="hidden" id="phase_id" name="phase_id" value="<? echo $phase_id; ?>"/>
    <input type="hidden" id="seq_id" name="task_id" <?php if ($task_id != 0) echo "value=" . $task_rs["task_id"]; else echo "value=0";  ?> >
    

    <fieldset style="width: 700px;text-align: right">
        <legend>
            <label>
                اضافة مهمة
            </label>
        </legend>
        <div class="panel_row">

            <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 

                <p>
                    عنوان المهمة
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle"> 
                <input type="text" id="task_name" name="task_name" <?php if ($task_id != 0) echo "value='" . $task_rs["task_name"] . "'"; ?>/>
            </div>
        </div> 

       
        <div class="panel_row">
            <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                <p>
                    التفاصيل
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle"> 
                <textarea name="task_desc" rows="4" cols="20" id="task_desc"><?php if ($task_id != 0) echo $task_rs["task_desc"]; ?></textarea>
            </div>
        </div> 

        <div style="text-align:center; padding-top: 10px">
            <input type="button" value="حفظ" id='saveButton' style="margin-top: 20px;width: 50px"  />
        </div>
    </fieldset>
</form>
