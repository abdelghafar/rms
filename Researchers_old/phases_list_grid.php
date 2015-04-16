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
$project_id = $_REQUEST["project_id"];
?>
<html>
    <head>
        <script type="text/javascript">
            $(document).ready(function() {
                //var theme = "";

                phases_list();

                function phases_list() {
                    var post_data = 'project_id=' + $('#project_id').val();
                    var source =
                            {
                                datatype: "json",
                                datafields: [
                                    {name: 'seq_id'},
                                    {name: 'project_id'},
                                    {name: 'phase_name'},
                                    {name: 'phase_desc'}
                                ],
                                url: 'inc/phases_list_grid_data.php?' + post_data,
                                cache: false
                            };

                    var dataAdapter = new $.jqx.dataAdapter(source);

                    $("#phases_grd").jqxGrid(
                            {
                                source: source,
                                theme: 'energyblue',
                                editable: false,
                                pageable: true,
                                filterable: true,
                                width: 900,
                                pagesize: 20,
                                autoheight: true,
                                columnsresize: true,
                                sortable: true,
                                rtl: true,
                                columns: [
                                    {text: 'seq_id', datafield: 'seq_id', width: 3, align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'project_id', datafield: 'project_id', width: 30, align: 'center', cellsalign: 'center', hidden: true},
                                    {text: 'إسم المرحلة', datafield: 'phase_name', type: 'string', width: 350, align: 'center', cellsalign: 'right'},
                                    {text: 'الوصف', datafield: 'phase_desc', type: 'string', width: 350, align: 'center', cellsalign: 'right'},
                                    {text: 'تعديل', datafield: '..', align: 'center', width: 50, columntype: 'button', cellsrenderer: function() {
                                            return "..";
                                        }, buttonclick: function(row) {
                                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
                                            var post_data = 'divan_id=' + $('#divanlistbox').val() + '&poem_id=' + dataRecord.id + '&poet_id=' + dataRecord.poet_id + '&part_no=' + dataRecord.part_no;
                                            $.ajax({
                                                url: "dpoem_data_form.php",
                                                dataType: "html",
                                                data: post_data,
                                                type: 'POST',
                                                beforeSend: function() {
                                                    $("#poem_form_div").html("<img src='images/load.gif'/>loading...");
                                                },
                                                success: function(data) {
                                                    $("#poem_form_div").html(data);
                                                    $("#verse_from_div").html("");
                                                    $("#verse_div").html("");
                                                }
                                            });

                                        }
                                    },
                                    {text: 'إضافة مهام', width: 100, datafield: '', align: 'center', columntype: 'button', cellsrenderer: function() {
                                            return "إضافة مهام";
                                        }, buttonclick: function(row) {
                                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);

                                            var post_data = 'divan_id=' + $('#divanlistbox').val() + '&poem_id=' + dataRecord.id + '&verse_id=' + 0 + '&poetrytype_id=' + dataRecord.poetrytype_id + '&poet_id=' + dataRecord.poet_id + '&part_no=' + dataRecord.part_no;

                                            $.ajax({
                                                url: "verse_data_form.php",
                                                dataType: "html",
                                                data: post_data,
                                                type: 'POST',
                                                beforeSend: function() {
                                                    $("#verse_from_div").html("<img src='images/load.gif'/>loading...");
                                                },
                                                success: function(data) {
                                                    $("#poem_form_div").html("");
                                                    $("#verse_from_div").html(data);
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
                                                var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
                                                var post_data = '&poem_id=' + dataRecord.id;
                                                $.ajax({
                                                    type: 'post',
                                                    url: 'bll/deletePoem.php',
                                                    datatype: "html",
                                                    data: post_data,
                                                    beforeSend: function() {
                                                        $("#poemresult").html("<img src='images/load.gif'/>loading...");
                                                    },
                                                    success: function(data) {
                                                        $("#poemresult").html(data);
                                                        if ($("#poem_operation_flag").val() === 'true')
                                                        {
                                                            var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                                                            var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                                                            if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                                                                var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                                                                var commit = $("#jqxgrid").jqxGrid('deleterow', id);
                                                            }
                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    }
                                ]
                            });
                }
                $("#jqxgrid").on('rowdoubleclick', function(event) {
                    var poem_id = $('#jqxgrid').jqxGrid('getcellvalue', event.args.rowindex, 'id');
                    var post_data = 'poem_id=' + poem_id;
                    $('#poetrytype').val($('#jqxgrid').jqxGrid('getcellvalue', event.args.rowindex, 'poetrytype_id'));
                    $.ajax({
                        url: "dverse_list.php",
                        dataType: "html",
                        data: post_data,
                        type: 'POST',
                        beforeSend: function() {
                            $("#verse_div").html("<img src='images/load.gif'/>loading...");
                        },
                        success: function(data) {
                            $("#poemresult").html("");
                            $("#poem_form_div").html("");
                            $("#verse_from_div").html("");
                            $("#verse_div").html(data);
                        }
                    });
                });

                $('#poemsearchButton').on('click', function() {
                    poem_list();
                });

                $('#PoemNewButton').on('click', function() {
                    var post_data = 'divan_id=' + $('#divanlistbox').val() + '&poem_id=' + 0;
                    $.ajax({
                        url: "dpoem_data_form.php",
                        dataType: "html",
                        data: post_data,
                        type: 'POST',
                        beforeSend: function() {
                            $("#poem_form_div").html("<img src='images/load.gif'/>loading...");
                        },
                        success: function(data) {
                            $("#poem_form_div").html(data);
                        }
                    });
                });

            });
        </script>

        <script type="text/javascript">

            function WithDraw(ResearchId)
            {
                if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
                {
                    $.ajax({
                        type: 'post',
                        url: 'inc/WithDraw.inc.php?ResearchId=' + ResearchId,
                        datatype: "html",
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            }

            function update_research(research_id)
            {
//                window.showModalDialog("ResearchEdit.php?research_id=" + research_id + "&research_code=" + research_code, 'PopupPage', 'dialogHeight:450px; dialogWidth:900px; resizable:0');

                $(document).ready(function() {

                    window.location.assign('phases.php?research_id=' + research_id);
                });
            }


        </script>
    </head>
    <body>
    <input type="hidden" id="project_id" name="project_id" value="<? echo $project_id; ?>" />
    <div class="panel_row">
        <div class="panel-cell" style="width: 100 ;text-align: left;padding-right: 60">
            <input type="button" value="إضافة مرحلة" id='PhaseNewButton' class="ptr-button" style="margin-top: 10px;"  />
        </div>
    </div>


    <div id="phases_grd" style="margin-right: 0px !important; padding-right: 0px !important">

    </div>
</body>
</html>