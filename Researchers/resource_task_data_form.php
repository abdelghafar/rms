<?php
session_start();
$project_id = $_REQUEST['project_id'];
$phase_id = $_REQUEST['phase_id'];
$seq_id = $_REQUEST['seq_id'];

require_once '../lib/Reseaches.php';
require_once '../lib/projectTasks.php';

$project = new Reseaches();
$project_duration = $project->GetResearchDuration($project_id);


/* if ($seq_id != 0) {
  $project = new projectTask();
  $task_resources_rs = $task->GetTasksData($task_id);
  } else {

  } */
?>
<!DOCTYPE html>

<script type="text/javascript">
    $(document).ready(function () {
        var theme = "energyblue";
        $("#duration_val").jqxNumberInput({width: '50px', height: '22px', groupSize: 5, promptChar: ' ', digits: 3, min: 1, max: 30, validationMessage: 'القيمة الصحيحة بين 1 و30', decimalDigits: 0, textAlign: 'center', theme: theme});
        $("#saveButton").jqxButton({width: '100', height: '30', theme: theme});
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


        //-------------------------- research_stuff_dropdown list
        var post_data = 'project_id=' + $('#project_id').val();
        var source =
        {
            datatype: "json",
            datafields: [
                {name: 'research_stuff_id'},
                {name: 'role_person'},
            ],
            url: '../Data/research_stuff.php?' + post_data,
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#research_stuff_id_val").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'role_person', valueMember: 'research_stuff_id', theme: 'energyblue', rtl: true, promptText: "Choose Research Stuff /إختر عضو الفريق البحثي "});

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
        $("#start_month_val").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '300px', height: '30px', displayMember: 'month_name', valueMember: 'month_id', theme: 'energyblue', rtl: true, promptText: "Choose Start Month/ إختر بداية المهمة "});

        //-------------------------- Duration Unit dropdown list
        /*var post_data = 'project_id=' + $('#project_id').val();
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

         */
        $('#taskresourcesdataForm').jqxValidator({rules: [
            {
                input: "#task_id_val", message: "Choose Task / إختر المهمة", position: 'left', action: 'blur', rule: function (input, commit) {
                var index = $("#task_id_val").jqxDropDownList('getSelectedIndex');
                return index != -1;
            }
            },
            {
                input: "#research_stuff_id_val", message: "Choose Research Stuff /إختر عضو الفريق البحثي ", position: 'left', action: 'blur', rule: function (input, commit) {
                var index = $("#research_stuff_id_val").jqxDropDownList('getSelectedIndex');
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
            }
        ]
        });

        $('#research_stuff_id_val').on('close', function (event) {
            //alert($("#research_stuff_id_val").val());
            //var args = event.args;
            var item = $('#research_stuff_id_val').val();
            if (item != -1) {
                var post_data = 'research_stuff_id=' + $("#research_stuff_id_val").val();
                $.ajax({
                    type: 'post',
                    url: '../Data/GetStuff_Roles_ByID.php?' + post_data,
                    datatype: "html",
                    beforeSend: function () {

                    },
                    success: function (data) {
                        //alert(data);
                        if (data == 3) {
                            $("#unit_id").val(1);
                            $("#unit_id_val").val('يوم');
                        }
                        else {
                            $("#unit_id").val(2);
                            $("#unit_id_val").val('شهر');
                        }
                    }
                });
                //$('#Events').jqxPanel('prepend', '<div style="margin-top: 5px;">Unselected: ' + item.label + '</div>');
            }
        });


        $('#saveButton').on('click', function () {

            var valid = $('#taskresourcesdataForm').jqxValidator('validate');


            if (valid) {
                var end_month = parseInt($("#start_month_val").val()) + parseInt($("#duration_val").val()) - 1;
                var project_duration = parseInt($("#project_duration").val());

                if (($("#unit_id").val() === '2') && (project_duration < end_month))
                    alert("مدة تنفيذ المهمة يجب ألا تتجاوزة نهاية المشروع");
                else {
                    //$("#taskresourcesdataForm").submit();
                    $("#task_id").val($("#task_id_val").val());
                    $("#research_stuff_id").val($("#research_stuff_id_val").val());
                    $("#start_month").val($("#start_month_val").val());
                    $("#duration").val($("#duration_val").val());


                    //phase_id = $("#phase_id").val();
                    $.ajax({
                        type: 'post',
                        url: 'inc/saveResourceTask.php?project_id=' + $("#project_id").val(),
                        datatype: "html",
                        data: $("#taskresourcesdataForm").serialize(),
                        beforeSend: function () {
                            $("#taskresult").html("<img src='images/load.gif'/>loading...");
                        },
                        success: function (data) {
                            $("#taskresult").html(data);
                            if ($("#task_operation_flag").val() === 'true') {
                                load_tasks_grd();

                                // Reset Form
                                /*
                                 $("#task_id_val").jqxDropDownList('clearSelection', true);
                                 $("#research_stuff_id_val").jqxDropDownList('clearSelection', true);
                                 $("#start_month_val").jqxDropDownList('clearSelection', true);
                                 $("#duration_val").val(0);
                                 $("#unit_id").val(0);
                                 $("#unit_id_val").val('');*/
                            }
                            else
                                alert('حدث خطأ فى تنفيذ العملية أعد المحاولة مرة أخرى');
                        }
                    });
                }
            }
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
        <legend style="text-align: center">
            <h3>
                تخصيص عنصر بشري لمهمة / Assign Human Resource To Task
            </h3>
        </legend>
        <br>

        <div class="panel_row">

            <div class="panel-cell" style="width: 160px;text-align: right;"> 

                <span class="classic">
                    عنوان المهمة
                    /
                    Task Title
                </span>
                <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float: right;" id="task_id_val"></div>
                <div style="float: right;" id="aa"></div>

                <input type="hidden" id="project_duration"
                       name="project_duration" <?php echo "value=" . $project_duration; ?> />
                <input type="hidden" id="task_id"
                       name="task_id" <?php if ($seq_id != 0) echo "value=" . $task_resources_rs["task_id"]; ?> />
            </div>
        </div>


        <div class="panel_row">

            <div class="panel-cell" style="width: 160px;text-align: right;"> 

                <span class="classic"> 
                    إسم الباحث/المتخصص 
                    <br>
                    Researcher Name
                </span>
                <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float: right;" id="research_stuff_id_val"></div>
                <input type="hidden" id="research_stuff_id"
                       name="research_stuff_id" <?php if ($seq_id != 0) echo "value=" . $task_resources_rs["task_id"]; ?> />
            </div>
        </div>

        <div class="panel_row">

            <div class="panel-cell" style="width: 160px;text-align: right;"> 

                <span class="classic">
                    شهر البدء
                    /
                    Start Month
                </span>
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

            <div class="panel-cell" style="width: 160px;text-align: right;"> 

                <span class="classic">
                    المدة
                    /
                    Duration
                </span>
                <span class="required" style="color: red">*</span>
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div style="float: right;" id="duration_val"></div>
                <input type="hidden" id="duration" name="duration" <?php echo "value=" . $project_duration; ?> />
                <input type="text" id="unit_id_val" name="unit_id_val"
                       style="font-size: 16;font-weight: bold;margin-right: 10; color: #0000cc ;text-align: right; border: none; background: none" <?php if ($seq_id != 0) echo "value=" . $task_resources_rs["unit_id"]; ?>
                       disabled="true"/>
                <input type="hidden" id="unit_id"
                       name="unit_id" <?php if ($seq_id != 0) echo "value=" . $task_resources_rs["unit_id"]; ?> />
            </div>
        </div>


        </div>
        </div>


        <div style="text-align:center; padding-top: 10px">
            <input type="button" value="Save / حفظ " id='saveButton' style="margin-top: 20px;width: 50px"/>
            <input type="button" value="Close / غلق " id='closeButton' style="margin-top: 20px;width: 50px"/>
        </div>


    </fieldset>
</form>
