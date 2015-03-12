<?php
session_start();
$project_id = $_REQUEST['project_id'];
$seq_id = $_REQUEST['seq_id'];

require_once '../lib/projectPhases.php';
if ($seq_id != 0) {
    $phase = new projectPhase();
    $phase_rs = $phase->GetPhaseData($seq_id);
} else {
    
}
?>
<!DOCTYPE html>

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
                $("#phase_name").jqxInput({width: '400', height: '30', theme: theme, rtl: true});
                $("#phase_desc").jqxInput({width: '400', height: '130', theme: theme, rtl: true});


                $('#phasedataForm').jqxValidator({rules: [
                        {input: '#phase_name', message: 'من فضلك ادخل عنوان المرحلة/ Please Enter Phase Title', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'}], theme: 'energyblue', animation: 'fade'
                });

                $('#saveButton').on('click', function() {
                    var valid = $('#phasedataForm').jqxValidator('validate');
                    if (valid)
                    {
                        //$("#phasedataForm").submit();
                        //$("#poet_id").val($("#poet_id_val").val());
                        project_id = $("#project_id").val();
                        $.ajax({
                            type: 'post',
                            url: 'inc/savePhase.php',
                            datatype: "html",
                            data: $("#phasedataForm").serialize(),
                            beforeSend: function() {
                                $("#phaseresult").html("<img src='images/load.gif'/>loading...");
                            },
                            success: function(data) {
                                $("#phaseresult").html(data);
                                if ($("#phase_operation_flag").val() === 'true')
                                    {
                                        window.location.assign('phases.php?q=' + project_id);
                                    //$("#phase_form_div").html("");
                                    
                                    }
                            }
                        });
                    }
                    else
                        alert("من فضلك أكمل باقي البيانات/ Please Complete Data");
                });
            });</script>

    
        <form id="phasedataForm" enctype="multipart/form-data" method="POST">
            <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>"/>
            <input type="hidden" id="seq_id" name="seq_id" <?php if ($seq_id != 0) echo "value=" . $phase_rs["seq_id"]; else echo "value=0";  ?> >

            <fieldset style="width: 600px;text-align: right">
                <legend>
                    <label>
                        اضافة -تعديل مرحلة عمل  / Add-Update Project Phase
                    </label>
                    
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 160px;text-align: left;padding-left: 10px;"> 

                        <p>
                           عنوان المرحلة 
                           <br>
                           Phase Title 
                           <span class="required" style="color: red">*</span>
                        </p>
                        
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="phase_name" name="phase_name" <?php if ($seq_id != 0) echo "value='" . $phase_rs["phase_name"]."'"; ?>/>
                    </div>
                </div> 

                <div class="panel_row">
                    <div class="panel-cell" style="width: 160px;text-align: left;padding-left: 10px;"> 
                        <p>
                            التفاصيل
                            <br>
                            Description
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <textarea name="phase_desc" rows="4" cols="20" id="phase_desc"><?php if ($seq_id != 0) echo $phase_rs["phase_desc"]; ?></textarea>
                    </div>
                </div> 

                <div style="text-align:center; padding-top: 10px">
                    <input type="button" value="Save / حفظ " id='saveButton' style="margin-top: 20px;width: 50px"  />
                </div>
            </fieldset>
        </form>
       
   