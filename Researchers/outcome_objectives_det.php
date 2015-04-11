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
?>
<script type="text/javascript">

    $(document).ready(function () {
        //var theme = "";

        var post_data = 'project_id=' + $('#project_id').val() + '&outcome_id=' + $('#global_outcome_id').val();
        var source =
        {
            datatype: "json",
            datafields: [
                {name: 'project_id'},
                {name: 'outcome_id'},
                {name: 'objective_id'},
                {name: 'goal_id'},
                {name: 'outcome_name'},
                {name: 'goal_name'},
                {name: 'objective_name'}
            ],
            url: 'inc/outcome_objectives_list_grid_data.php?' + post_data,
            cache: false
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#objectives_grd").jqxGrid(
            {
                source: source,
                theme: 'energyblue',
                editable: false,
                pageable: true,
                filterable: true,
                width: 940,
                pagesize: 20,
                autorowheight: true,
                autoheight: true,
                columnsresize: true,
                sortable: true,
                rtl: true,
                columns: [
                    {text: 'project_id', datafield: 'project_id', align: 'center', cellsalign: 'center', hidden: true},
                    {text: 'outcome_id', datafield: 'outcome_id', align: 'center', cellsalign: 'center', hidden: true},
                    {text: 'objective_id', datafield: 'objective_id', align: 'center', cellsalign: 'center', hidden: true},
                    {text: 'goal_id', datafield: 'goal_id', align: 'center', cellsalign: 'center', hidden: true},
                    {text: 'Project outcome / مخرج المشروع', datafield: 'outcome_name', type: 'string', width: 310, align: 'center', cellsalign: 'right'},
                    {text: 'GTP Goals/ الأهداف الإستراتيجية للبرنامج', datafield: 'goal_name', type: 'string', width: 320, align: 'center', cellsalign: 'right'},
                    {text: 'Achieved Project Objectives/ أهداف المشروع المطلوب تحقيقها', datafield: 'objective_name', type: 'string', width: 310, align: 'center', cellsalign: 'right', autohieght: true}/*                        /*,
                     {text: 'تعديل', datafield: '..', align: 'center', width: 50, columntype: 'button', cellsrenderer: function() {
                     return "..";
                     }, buttonclick: function(row) {
                     var dataRecord = $("#objectives_grd").jqxGrid('getrowdata', row);
                     var post_data = 'objective_id=' + dataRecord.objective_id + '&project_id=' + dataRecord.project_id + '&outcome_id=' + dataRecord.outcome_id;
                     $.ajax({
                     url: "objective_data_form.php",
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
                     var dataRecord = $("#objectives_grd").jqxGrid('getrowdata', row);
                     var post_data = '&objective_id=' + dataRecord.objective_id;
                     $.ajax({
                     type: 'post',
                     url: 'inc/deleteTask.php',
                     datatype: "html",
                     data: post_data,
                     beforeSend: function() {
                     $("#objectiveresult").html("<img src='images/load.gif'/>loading...");
                     },
                     success: function(data) {
                     $("#objectiveresult").html(data);
                     if ($("#objective_operation_flag").val() === 'true')
                     {
                     alert("تم الحذف بنجاح");
                     //$("#form_div").html("");
                     load_objectives_grd();
                     //                                                        var selectedrowindex = $("#objectives_grd").jqxGrid('getselectedrowindex');
                     //                                                        var rowscount = $("#objectives_grd").jqxGrid('getdatainformation').rowscount;
                     //                                                        if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                     //                                                            var id = $("#objectives_grd").jqxGrid('getrowid', selectedrowindex);
                     //                                                            var commit = $("#objectives_grd").jqxGrid('deleterow', id);
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
    ربط المخرجات و الأهداف / Outcomes and Goals Map
</h2>
<hr/>


<div id="objectiveresult" dir="rtl" style="padding-top: 10px"></div>

<div id="objectives_grd">

</div>
</fieldset>