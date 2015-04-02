<?php
session_start();
$project_id = $_REQUEST['project_id'];
$seq_id = $_REQUEST['seq_id'];

require_once '../lib/outcomes.php';
if ($seq_id != 0) {
    $obj = new Outcomes();
    $obj_rs = $obj->GetOutcomeData($seq_id);
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
        margin: 0px;
        padding: 0px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        var theme = "energyblue";
        $("#saveButton").jqxButton({width: '100', height: '30', theme: theme});
        $("#outcome_name").jqxInput({width: '400', height: '30', theme: theme, rtl: true});
        $("#outcome_desc").jqxInput({width: '400', height: '130', theme: theme, rtl: true});
    });

    $(document).ready(function () {
        $('#objdataForm').jqxValidator({rules: [
            {input: '#outcome_name', message: 'من فضلك ادخل مخرج المشروع', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'left'}
        ], theme: 'energyblue', animation: 'fade'
        });


        $('#saveButton').on('click', function () {
            var valid = $('#objdataForm').jqxValidator('validate');
            if (valid) {
                //$("#objdataForm").submit();
                //$("#poet_id").val($("#poet_id_val").val());
                project_id = $("#project_id").val();
                $.ajax({
                    type: 'post',
                    url: 'inc/saveOutcome.php',
                    datatype: "html",
                    data: $("#objdataForm").serialize(),
                    beforeSend: function () {
                        $("#outcomeresult").html("<img src='images/load.gif'/>loading...");
                    },
                    success: function (data) {
                        $("#outcomeresult").html(data);
                        if ($("#outcome_operation_flag").val() === 'true') {
                            window.location.assign('outcomes_objectives.php?q=' + project_id);
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

    <fieldset style="width: 600px;text-align: right">
        <legend style="text-align: center">
            <h3>
                اضافة - تعديل مخرجات المشروع / Add - Update Project Outcomes
            </h3>
        </legend>
        <br>

        <div class="panel_row">

            <div class="panel-cell" style="width: 150px;text-align: right;padding-left: 10px;"> 

                <span class="classic">
                    المخرج
                    /
                   Outcome
                </span>
                <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input type="text" id="outcome_name"
                       name="outcome_name" <?php if ($seq_id != 0) echo "value='" . $obj_rs["outcome_title"] . "'"; ?>/>
            </div>
        </div>

        <div class="panel_row">
            <div class="panel-cell" style="width: 150px;text-align: right;padding-left: 10px;"> 
                <span class="classic">
                  الوصف
                   /
                   Description 
                </span>
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <textarea name="outcome_desc" rows="4" cols="20"
                          id="outcome_desc"><?php if ($seq_id != 0) echo $obj_rs["outcome_desc"]; ?></textarea>
            </div>
        </div>

        <div style="text-align:center; padding-top: 10px">
            <input type="button" value="Save / حفظ " id='saveButton' style="margin-top: 20px;width: 50px"/>
        </div>
    </fieldset>
</form>

