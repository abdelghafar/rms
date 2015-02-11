<?php
session_start();
require_once '../lib/Reseaches.php';
$rcode = $_GET['rcode'];
$r = new Reseaches();
$Rid = $r->GetResearchId($rcode);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/reigster-layout.css"/> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
        <style type="text/css">
            .demo-iframe {
                border: none;
                width: 600px;
                height: 50px; 
                clear: both;
                float: right; 
                margin:0px;
                padding: 0px;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = "energyblue";
                $("#sendButton").jqxButton({width: '100', height: '30', theme: theme});
                $("#Title").jqxInput({width: '300', height: '30', theme: theme, rtl: true});
                $("#Desc").jqxInput({width: '300', height: '100', theme: theme, rtl: true});
                $("#startDate").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
                $("#endDate").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
                $("#start_date").val($('#startDate').jqxDateTimeInput('getText'));
                $('#startDate').on('change', function (event)
                {
                    $("#start_date").val($('#startDate').jqxDateTimeInput('getText'));
                });
                $("#end_date").val($('#endDate').jqxDateTimeInput('getText'));
                $('#endDate').on('change', function (event)
                {
                    $("#end_date").val($('#endDate').jqxDateTimeInput('getText'));
                });
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'seq_id'},
                                {name: 'phase_title'}
                            ],
                            url: '../Data/ProjectPhases.php?pid=' +<? echo $Rid; ?>,
                            async: false
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $('#phases').jqxDropDownList({source: dataAdapter,
                    displayMember: 'phase_title',
                    valueMember: 'seq_id',
                    width: '300px',
                    height: '30px',
                    theme: theme,
                    selectedIndex: 0,
                    rtl: true});
                var item = $("#phases").jqxDropDownList('getSelectedItem');
                $('#PhaseId').val(item.value);
                $('#phases').on('select', function (event)
                {
                    var args = event.args;
                    if (args) {
                        // index represents the item's index.                      
                        var index = args.index;
                        var item = args.item;
                        // get item's label and value.
                        var label = item.label;
                        var value = item.value;
                        $('#PhaseId').val(value);
                    }
                });
            });</script>
        <script type="text/javascript">
            $(document).ready(function () {

            });

        </script>

    </head>
    <body style="background-color: #ededed;">
        <form id="AddEdit_Research_docs" enctype="multipart/form-data" method="POST" action="inc/AddSchedule.inc.php" target="form-iframe">
            <input type="hidden" id="rcode" name="rcode" value="<? echo $rcode; ?>"/>
            <fieldset style="width: 600px;text-align: right;">
                <legend>
                    <label>
                        اضافة المهام
                    </label>
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            عنوان المهمة
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="Title" name="Title"/>
                    </div>
                </div> 
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            المرحلة
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div id="phases"></div>
                        <input type="hidden" id="PhaseId" name="PhaseId"/>
                    </div>
                </div> 

                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            تاريخ البدء
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div id="startDate"></div>
                        <input type="hidden" id="start_date" name="start_date"/>
                    </div>
                </div> 

                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            تاريخ الانتهاء
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div id="endDate"></div>
                        <input type="hidden" id="end_date" name="end_date"/>
                    </div>
                </div> 


                <div class="panel_row">
                    <div class="panel-cell" style="width: 128px;text-align: left;padding-left: 10px;"> 
                        <p>
                            التفاصيل
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <textarea id="Desc" name="Desc" rows="4" cols="20">
                        </textarea>
                    </div>
                </div> 

                <input type="submit" value="حفظ" id="sendButton" style="margin-top: 10px;"/>
            </fieldset>
        </form>
        <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0" >
    </body>
</html>
