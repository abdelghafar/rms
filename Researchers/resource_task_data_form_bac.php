<?php
session_start();
//$project_id = $_REQUEST['project_id'];
$phase_id = $_REQUEST['phase_id'];
$seq_id = $_REQUEST['seq_id'];

require_once '../lib/projectTasks.php';
/* if ($seq_id != 0) {
  $task = new projectTask();
  $task_resources_rs = $task->GetTasksData($task_id);
  } else {

  } */
?>
<!DOCTYPE html>

<script type="text/javascript">
    $(document).ready(function () {
        var theme = "energyblue";
        $("#duration_val").jqxNumberInput({width: '50px', height: '22px', groupSize: 5, promptChar: ' ', digits: 3, min: 1, max: 999, decimalDigits: 0, textAlign: 'center', theme: theme});
        $("#saveButton").jqxButton({width: '100', height: '30', theme: theme})
        $("#closeButton").jqxButton({width: '100', height: '30', theme: theme});


        // ================= Tasks Dropdown List =======================

        var post_data = 'phase_id=' + $('#global_phase_id').val();
        var source =
        {
            datatype: "json",
            datafields: [
                {name: 'task_id'},
                {name: 'task_name'},
            ],
            url: '../Data/tasks.php?' + post_data,
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#task_id_val").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'task_name', valueMember: 'task_id', theme: 'energyblue', rtl: true, promptText: "Choose Task / إختر المهمة"});


        //-------------------------- persons _dropdown list
        var post_data = 'project_id=' + $('#project_id').val();
        var source =
        {
            datatype: "json",
            datafields: [
                {name: 'person_id'},
                {name: 'person_name'},
            ],
            url: '../Data/research_stuff.php?' + post_data,
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#person_id_val").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'person_name', valueMember: 'person_id', theme: 'energyblue', rtl: true, promptText: "Choose Research Stuff /إختر عضو الفريق البحثي "});

        //-------------------------- Monthes_dropdown list
        var post_data = 'project_id=' + $('#project_id').val();
        var source =
        {
            datatype: "json",
            datafields: [
                {name: 'month_id'},
                {name: 'month_name'},
            ],
            url: '../Data/monthes.php?' + post_data,
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#start_month_val").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '250px', height: '30px', displayMember: 'month_name', valueMember: 'month_id', theme: 'energyblue', rtl: true, promptText: "Choose Start Month/ إختر بداية المهمة "});

        //-------------------------- Duration Unit dropdown list
        var post_data = 'project_id=' + $('#project_id').val();
        var source =
        {
            datatype: "json",
            datafields: [
                {name: 'seq_id'},
                {name: 'unit_name'},
            ],
            url: '../Data/durationunits.php?' + post_data,
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#unit_id_val").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '250px', height: '30px', displayMember: 'unit_name', valueMember: 'seq_id', theme: 'energyblue', rtl: true, promptText: "Choose Time Unit/  اختر الوحدة الزمنية"});


        $('#taskresourcesdataForm').jqxValidator({rules: [
            {
                input: "#task_id_val", message: "Choose Task / إختر المهمة", position: 'left', action: 'blur', rule: function (input, commit) {
                var index = $("#task_id_val").jqxDropDownList('getSelectedIndex');
                return index != -1;
            }
            },
            {
                input: "#person_id_val", message: "Choose Research Stuff /إختر عضو الفريق البحثي ", position: 'left', action: 'blur', rule: function (input, commit) {
                var index = $("#person_id_val").jqxDropDownList('getSelectedIndex');
                return index != -1;
            }
            },
            {
                input: "#start_month_val", message: "Choose Start Month/ إختر بداية المهمة ", position: 'left', action: 'blur', rule: function (input, commit) {
                var index = $("#start_month_val").jqxDropDownList('getSelectedIndex');
                return index != -1;
            }
            },
            {
                input: "#unit_id_val", message: "Choose Time Unit/  اختر الوحدة الزمنية", position: 'left', action: 'blur', rule: function (input, commit) {
                var index = $("#unit_id_val").jqxDropDownList('getSelectedIndex');
                return index != -1;
            }
            },
            //{input: '#task_id', message: 'من فضلك ادخل عنوان المهمة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'}], theme: 'energyblue', animation: 'fade'}
        ]
        });


        $('#saveButton').on('click', function () {

            var valid = $('#taskresourcesdataForm').jqxValidator('validate');

            if (valid) {
                //$("#taskresourcesdataForm").submit();
                $("#task_id").val($("#task_id_val").val());
                $("#person_id").val($("#person_id_val").val());
                $("#start_month").val($("#start_month_val").val());
                $("#duration").val($("#duration_val").val());
                $("#unit_id").val($("#unit_id_val").val());


                //project_id = $("#project_id").val();
                //phase_id = $("#phase_id").val();
                $.ajax({
                    type: 'post',
                    url: 'inc/saveResourceTask.php',
                    datatype: "html",
                    data: $("#taskresourcesdataForm").serialize(),
                    beforeSend: function () {
                        $("#taskresult").html("<img src='images/load.gif'/>loading...");
                    },
                    success: function (data) {
                        $("#taskresult").html(data);
                        if ($("#task_operation_flag").val() === 'true') {
                            load_tasks_grd();

                            // $("#divan_no_val").val(0);
                            $("#task_id_val").jqxDropDownList('clearSelection', true);
                            $("#person_id_val").jqxDropDownList('clearSelection', true);
                            $("#start_month_val").jqxDropDownList('clearSelection', true);
                            $("#duration_val").val(0);
                            $("#unit_id_val").jqxDropDownList('clearSelection', true);
                        }
                        else
                            alert('حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى');
                    }
                });
            }
            else
                alert("من فضلك أكمل باقي البيانات");
        });

        $('#closeButton').on('click', function () {
            $("#form_div").html("");
        });
    });</script>


<form id="taskresourcesdataForm" enctype="multipart/form-data" method="POST">

    <input type="hidden" id="seq_id" name="seq_id" <?php
    if ($seq_id != 0)
        echo "value=" . $task_resources_rs["task_id"];
    else
        echo "value=0";
    ?> >


    <fieldset style="width: 700px;text-align: right">
        <legend>
            <label>
                تخصيص عنصر بشري لمهمة / Assign Human Resource To Task
            </label>
        </legend>
        <div class="panel_row">

            <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;">

                <p>
                    عنوان المهمة
                    <br>
                    Task Title
                    <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float: right;" id="task_id_val"></div>
                <input type="hidden" id="task_id"
                       name="task_id" <?php if ($seq_id != 0) echo "value=" . $task_resources_rs["task_id"]; ?> />
            </div>
        </div>


        <div class="panel_row">

            <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;">

                <p>
                    إسم الباحث/المتخصص
                    <br>
                    Researcher Name
                    <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float: right;" id="person_id_val"></div>
                <input type="hidden" id="person_id"
                       name="person_id" <?php if ($seq_id != 0) echo "value=" . $task_resources_rs["task_id"]; ?> />
            </div>
        </div>

        <div class="panel_row">

            <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;">

                <p>
                    شهر البدء
                    <br>
                    Start Month
                    <span class="required" style="color: red">*</span>

                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div id='start_month_val' style='margin-top: 3px;'></div>
                <input type="hidden" id="start_month"
                       name="start_month" <?php if ($divan_id != 0) echo "value=" . $divan_rs["start_month"]; ?> />

            </div>
        </div>

        <div class="panel_row">

            <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;">

                <p>
                    المدة
                    <br>
                    Duration
                    <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float: right;" id="duration_val"></div>
                <input type="hidden" id="duration"
                       name="duration" <?php if ($seq_id != 0) echo "value=" . $task_resources_rs["duration"]; ?> />
            </div>
        </div>

        <div class="panel_row">

            <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;">

                <p>
                    الوحدة الزمنية
                    <br>
                    Duration Unit
                    <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float: right;" id="unit_id_val"></div>
                <input type="hidden" id="unit_id"
                       name="unit_id" <?php if ($seq_id != 0) echo "value=" . $task_resources_rs["unit_id"]; ?> />
            </div>
        </div>


        <div style="text-align:center; padding-top: 10px">
            <input type="button" value="Save / حفظ " id='saveButton' style="margin-top: 20px;width: 50px"/>
            <input type="button" value="Close / غلق " id='closeButton' style="margin-top: 20px;width: 50px"/>
        </div>


    </fieldset>
</form>
