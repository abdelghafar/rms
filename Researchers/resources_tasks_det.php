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
?>
<script type="text/javascript">

    $(document).ready(function() {
        var theme = "energyblue";
        $("#ResourceNewButton").jqxButton({width: '320', height: '30', theme: theme});


        var post_data = 'project_id=' + $('#project_id').val() + '&phase_id=' + $('#global_phase_id').val();
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'phase_id'},
                        {name: 'seq_id'},
                        {name: 'task_id'},
                        {name: 'person_id'},
                        {name: 'unit_id'},
                        {name: 'phase_name'},
                        {name: 'task_name'},
                        {name: 'name_ar'},
                        {name: 'start_month'},
                        {name: 'duration'},
                        {name: 'unit_name'}
                    ],
                    url: 'inc/resource_tasks_list_grid_data.php?' + post_data,
                    cache: false
                };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#tasks_grd").jqxGrid(
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
                        {text: 'phase_id', datafield: 'phase_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'seq_id', datafield: 'seq_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'task_id', datafield: 'task_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'person_id', datafield: 'person_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'unit_id', datafield: 'unit_id', align: 'center', cellsalign: 'center', hidden: true},
                        {text: 'Phase / المرحلة', datafield: 'phase_name', type: 'string', width: 190, align: 'center', cellsalign: 'right'},
                        {text: 'Task / المهمة', datafield: 'task_name', type: 'string', width: 220, align: 'center', cellsalign: 'right'},
                        {text: 'Name / الإسم', datafield: 'name_ar', type: 'string', width: 220, align: 'center', cellsalign: 'right'},
                        {text: 'Starting Month/شهر البدء ', datafield: 'start_month', type: 'string', width: 160, align: 'center', cellsalign: 'center'},
                        {text: '', columngroup: 'Duration', datafield: 'duration', type: 'string', width: 50, align: 'center', cellsalign: 'center'},
                        {text: '', columngroup: 'Duration', datafield: 'unit_name', type: 'string', width: 50, align: 'center', cellsalign: 'center'},
                        {text: 'Delete/ حذف', datafield: 'Delete/ حذف', width: 50, align: 'center', columntype: 'button', cellsrenderer: function() {
                                return "..";
                            }, buttonclick: function(row) {
                                //window.confirm("هل انت متأكد من حذف هذا البيان");
                                var r = confirm("هل انت متأكد من حذف هذا البيان");
                                if (r == true)
                                {
                                    var dataRecord = $("#tasks_grd").jqxGrid('getrowdata', row);
                                    var post_data = 'project_id=' + $('#project_id').val() + '&seq_id=' + dataRecord.seq_id + '&person_id=' + dataRecord.person_id;
                                    $.ajax({
                                        type: 'post',
                                        url: 'inc/deleteResource.php',
                                        datatype: "html",
                                        data: post_data,
                                        beforeSend: function() {
                                            $("#taskresult").html("<img src='images/load.gif'/>loading...");
                                        },
                                        success: function(data) {
                                            $("#taskresult").html(data);
                                            if ($("#task_operation_flag").val() === 'true')
                                            {
                                                //alert("تم الحذف بنجاح");
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
                        }
                    ],
                    columngroups:
                            [
                                {text: 'Duration /المدة ', align: 'center', name: 'Duration'}
                            ]
                });

        $('#ResourceNewButton').on('click', function() {
            var phase_id = $('#global_phase_id').val();
            if (phase_id != 0)
            {
                var post_data = 'project_id=' + $('#project_id').val() + '&seq_id=' + 0;
                $.ajax({
                    url: "resource_task_data_form.php",
                    dataType: "html",
                    data: post_data,
                    type: 'POST',
                    beforeSend: function() {
                        $("#form_div").html("<img src='images/load.gif'/>loading...");
                    },
                    success: function(data) {
                        $("#form_div").html(data);
                        $("#taskresult").html("");
                    }
                });
            }
            else
                alert("يجب إختيار مرحلة من جدول المراحل أولا ");
        });



    });
</script>

<h2 style="font-size: 14px">
    المهام وفريق العمل / HR and tasks mapping
</h2>
<hr/>




<input type="button" value="Assign task to a member / تخصص مهمة لعضو الفريق" id='ResourceNewButton' style="margin-bottom: 15px;float: left "  />



<div id="tasks_grd">

</div>
