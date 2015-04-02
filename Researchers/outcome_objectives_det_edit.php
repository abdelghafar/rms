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
$cur_outcome_id = $_POST['outcome_id'];
?>
<script type="text/javascript">

    $(document).ready(function () {
        var theme = "energyblue";
        $("#closeObjectivesEditButton").jqxButton({width: '100', height: '30', theme: theme});

        // ================= STPGoals Dropdown List =======================

        var post_data = 'project_id=' + $('#project_id').val();
        var source =
        {
            datatype: "json",
            datafields: [
                {name: 'id'},
                {name: 'goal_title'},
            ],
            url: '../Data/goals.php?' + post_data,
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#goal_id_val").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '350px', height: '30px', displayMember: 'goal_title', valueMember: 'id', theme: 'energyblue', rtl: true, promptText: "Select a Goal / اختر الهدف الاستراتيجى "});

        $('#goal_id_val').on('select', function (event) {
            var args = event.args;
            var item = $('#goal_id_val').jqxDropDownList('getItem', args.index);
            if (item != null) {
                $("#goal_id").val($("#goal_id_val").val());
                loadGoalObjectives();
            }
        });
        //===========================================================

        function loadGoalObjectives() {
            var post_data = 'project_id=' + $('#project_id').val() + '&outcome_id=' + $('#cur_outcome_id').val() + '&goal_id=' + $("#goal_id").val();

            var source =
            {
                datatype: "json",
                datafields: [
                    {name: 'seq_id'},
                    {name: 'project_id'},
                    {name: 'outcome_id'},
                    {name: 'objective_id'},
                    {name: 'objective_name'},
                    {name: 'obj_check'}
                ],
                updaterow: function (rowid, rowdata, commit) {
                    if (rowdata.obj_check === true) // add record in goals_outcome table
                    {
                        var post_data = 'objective_id=' + rowdata.objective_id + '&outcome_id=' + $('#cur_outcome_id').val() + '&goal_id=' + $("#goal_id").val();
                        $.ajax({
                            type: 'post',
                            url: 'inc/addOutcomeObjectives.php',
                            datatype: "html",
                            data: post_data,
                            beforeSend: function () {
                                //$("#objectiveresult").html("<img src='images/load.gif'/>loading...");
                            },
                            success: function (data) {
                                commit(true);
                                load_objectives_grd();
                            },
                            error: function () {
                                commit(false);
                            }
                        });

                    }
                    else if (rowdata.obj_check === false) {
                        //alert(rowdata.objective_id);
                        var post_data = 'seq_id=' + rowdata.seq_id;
                        $.ajax({
                            type: 'post',
                            url: 'inc/deleteOutcomeObjectives.php',
                            datatype: "html",
                            data: post_data,
                            beforeSend: function () {
                                //$("#objectiveresult").html("<img src='images/load.gif'/>loading...");
                            },
                            success: function (data) {
                                commit(true);
                                load_objectives_grd();
                            },
                            error: function () {
                                commit(false);
                            }
                        });
                    }

                },
                url: 'inc/outcome_objective_grid_data_edit.php?' + post_data,
                cache: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#outcome_objs_grd").jqxGrid(
                {
                    source: dataAdapter,
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
                        {text: 'seq_id', datafield: 'seq_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'project_id', datafield: 'project_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'outcome_id', datafield: 'outcome_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'objective_id', datafield: 'objective_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'Objective / الهدف', datafield: 'objective_name', type: 'string', width: 550, align: 'center', cellsalign: 'right', editable: false},
                        {text: ' ', datafield: 'obj_check', align: 'center', cellsalign: 'center', width: 50, columntype: 'checkbox'}
                    ]
                });
        }

        $('#closeObjectivesEditButton').on('click', function () {
            $("#form_div").html("");
            //load_tasks_grd();

        });


    });
</script>


<fieldset style="width:620px;text-align: right;">
    <legend style="text-align: center">
        <h3>
            ربط أهداف المشروع بالأهداف الإستراتيجية / Assign Objective and Goals

        </h3>
    </legend>

    <input type="hidden" id="cur_outcome_id" name="cur_outcome_id" value="<? echo $cur_outcome_id; ?>"/>

    <div class="panel_row">

        <div class="panel-cell" style="width: 180px;text-align: right;padding-left: 10"> 

            <span class="classic">
                الهدف الاستراتيجى                
                /
                STP Goals
            </span>
            </p>

        </div>
        <div class="panel-cell" style="vertical-align: middle">
            <div style="float: right;" id="goal_id_val"></div>
            <input type="hidden" id="goal_id" name="goal_id" value=-1/>
        </div>
    </div>

    <div id="objectiveresult" dir="rtl" style="padding-top: 10px"></div>

    <div id="outcome_objs_grd">

    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width: 100 ;text-align: center;padding-right: 250">
            <input type="button" value="Close / غلق " id='closeObjectivesEditButton' style="margin: 10px 10px;"/>
        </div>
    </div>
</fieldset>