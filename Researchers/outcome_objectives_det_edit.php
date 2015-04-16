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
$cur_outcome_id = $_POST['outcome_id'];
?>
<script type="text/javascript">

    $(document).ready(function () {
        var theme = "energyblue";
        $("#closeObjectivesEditButton").jqxButton({width: '100', height: '30', theme: theme});
        Goal_list();

        // ================= STPGoals Dropdown List =======================

        var post_data = 'project_id=' + $('#project_id').val();

        function Goal_list() {
            var post_data = 'project_id=' + $('#project_id').val();
            var source =
            {
                datatype: "json",
                datafields: [
                    {name: 'id'},
                    {name: 'goal_title'}
                ],
                url: 'inc/goals_list_grid_data.php?' + post_data,
                cache: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#goals_grd").jqxGrid(
                {
                    source: source,
                    theme: 'energyblue',
                    editable: false,
                    pageable: true,
                    filterable: true,
                    width: 800,
                    pagesize: 20,
                    autorowheight: true,
                    autoheight: true,
                    columnsresize: true,
                    sortable: true,
                    rtl: true,
                    columns: [
                        {text: 'id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'STP Goals / الأهداف الإستراتيجية', datafield: 'goal_title', type: 'string', width: 800, align: 'center', cellsalign: 'right'}
                    ]
                });
        }

        $("#goals_grd").on('rowclick', function (event) {
            var goal_id = $('#goals_grd').jqxGrid('getcellvalue', event.args.rowindex, 'id');
            $('#goal_id').val(goal_id);

            loadGoalObjectives();

        });
        /*var source =
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
         $("#goal_id_val").jqxDropDownList({source: dataAdapter, selectedIndex: -1, width: '550px', height: '30px', displayMember: 'goal_title', valueMember: 'id', theme: 'energyblue', rtl: true, promptText: "Select a Goal / اختر الهدف الاستراتيجى "});

         $('#goal_id_val').on('select', function(event) {
         var args = event.args;
         var item = $('#goal_id_val').jqxDropDownList('getItem', args.index);
         if (item != null) {
         $("#goal_id").val($("#goal_id_val").val());
         loadGoalObjectives();
         }
         });*/
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
                    width: 800,
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
                        {text: 'Objective / الهدف', datafield: 'objective_name', type: 'string', width: 750, align: 'center', cellsalign: 'right', editable: false},
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


<fieldset style="width:820px;text-align: right;">
    <legend style="text-align: center">
        <h3>
            ربط أهداف المشروع بالأهداف الإستراتيجية / Assign Objective and Goals

        </h3>
    </legend>

    <div class="panel_row">
        <span style="color: red;font-weight: bold">
            النقر على الهدف الإستراتيجي  لعرض أهداف المشروع المتوافقة مع هذا الهدف
            <br>
            click a STP Goal to see its Project Objectives mapping
        </span>
    </div>

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
    </div>


    <div class="panel_row">
        <div class="panel-cell" style="vertical-align: middle">
            <div style="float: right;" id="goals_grd"></div>
            <div style="float: right;" id="goal_id_val"></div>
            <input type="hidden" id="goal_id" name="goal_id" value=-1/>
        </div>
    </div>
    <div class="panel_row">
        <p></p>

        <div class="panel-cell" style="text-align: right;padding-left: 10">
            <span class="classic">
                أهداف المشروع 
                /
               Project Objectives
            </span>
        </div>
    </div>

    <div class="panel_row">
        <div class="panel-cell" style="vertical-align: middle">
            <div id="objectiveresult" dir="rtl"></div>

            <div id="outcome_objs_grd">

            </div>
        </div>
    </div>
    <div class="panel_row">
        <div class="panel-cell" style="width: 100 ;text-align: center;padding-right: 350">
            <input type="button" value="Close / غلق " id='closeObjectivesEditButton' style="margin: 10px 10px;"/>
        </div>
    </div>
</fieldset>