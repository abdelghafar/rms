<?php
session_start();
$project_id = $_REQUEST['project_id'];
$seq_id = $_REQUEST['seq_id'];

require_once '../lib/objectives.php';
if ($seq_id != 0) {
    $obj = new Objectives();
    $obj_rs = $obj->GetObjectiveData($seq_id);
} else {
    
}
?>

<style type="text/css">
    .demo-iframe {
        border: none;
        width: 600px;
        height: auto; 
        clear: both;
        float: right; 
        margin:0px;
        padding: 0px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        var theme = "energyblue";
        $("#saveButton").jqxButton({width: '100', height: '30', theme: theme});
        $("#obj_name").jqxInput({width: '400', height: '30', theme: theme, rtl: true});
        $("#obj_desc").jqxInput({width: '400', height: '130', theme: theme, rtl: true});
    });

    $(document).ready(function() {
        $('#objdataForm').jqxValidator({rules: [
                {input: '#obj_name', message: 'من فضلك ادخل الهدف', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'left'},
                {input: '#obj_desc', message: 'من فضلك ادخل طريقة تحقيق الهدف', action: 'keyup,blur', rule: 'minLength=15,required', rtl: true, position: 'left'}
            ], theme: 'energyblue', animation: 'fade'
        });


        $('#saveButton').on('click', function() {
            var valid = $('#objdataForm').jqxValidator('validate');
            if (valid)
            {
                //$("#objdataForm").submit();
                //$("#poet_id").val($("#poet_id_val").val());
                project_id = $("#project_id").val();
                $.ajax({
                    type: 'post',
                    url: 'inc/saveObjective.php',
                    datatype: "html",
                    data: $("#objdataForm").serialize(),
                    beforeSend: function() {
                        $("#objectiveresult").html("<img src='images/load.gif'/>loading...");
                    },
                    success: function(data) {
                        $("#objectiveresult").html(data);
                        if ($("#objective_operation_flag").val() === 'true')
                        {
                            window.location.assign('objectives_tasks.php?q=' + project_id);
                            //$("#obj_form_div").html("");

                        }
                    }
                });
            }

        });
    });</script>


<form id="objdataForm" enctype="multipart/form-data" method="POST">
    <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>"/>
    <input type="hidden" id="seq_id" name="seq_id" <?php
    if ($seq_id != 0)
        echo "value=" . $obj_rs["seq_id"];
    else
        echo "value=0";
    ?> >

    <fieldset style="width: 620px;text-align: center">
        <legend style="text-align: center">
            <h3>
                اضافة -تعديل أهداف المشروع  / Add-Update Project Objectives
            </h3>
        </legend>
        <br>
        <div class="panel_row">

            <div class="panel-cell" style="width: 190px;text-align: right;"> 

                <span class="classic">
                    عنوان الهدف  
                    /
                    Objective Title
                </span>
                <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle"> 
                <input type="text" id="obj_name" name="obj_name" <?php if ($seq_id != 0) echo "value='" . $obj_rs["obj_title"] . "'"; ?>/>
            </div>
        </div> 

        <div class="panel_row">
            <div class="panel-cell" style="width: 190px;text-align: right;"> 
                <span class="classic">
                    طريقة تحقيق الهدف 
                    <br>
                    Approach for Objective
                </span>
                    <span class="required" style="color: red">*</span>
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle"> 
                <textarea name="obj_desc" rows="4" cols="20" id="obj_desc"><?php if ($seq_id != 0) echo $obj_rs["obj_desc"]; ?></textarea>
            </div>
        </div> 

        <div style="text-align:center; padding-top: 10px">
            <input type="button" value="Save / حفظ " id='saveButton' style="margin-top: 20px;width: 50px"  />
        </div>
    </fieldset>
</form>

