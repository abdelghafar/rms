<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/reigster-layout.css"/> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 

        <script type="text/javascript">
            $(document).ready(function () {
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'Phase_id'},
                                {name: 'Phase_Title'}
                            ],
                            url: '../lib/json/review_phase_GetALL.php',
                            async: false
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#jqxPhases").jqxDropDownList(
                        {
                            source: dataAdapter,
                            theme: 'energyblue',
                            width: 300,
                            height: 25,
                            selectedIndex: -1,
                            displayMember: 'Phase_Title',
                            valueMember: 'Phase_id',
                            rtl: true
                        });
                $("#jqxPhaseStatus").jqxDropDownList(
                        {
                            theme: 'energyblue',
                            width: 300,
                            height: 25,
                            selectedIndex: 0,
                            rtl: true
                        });
                $(".Calander").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
                $("#notes").jqxInput({rtl: true, height: 75, width: 450, minLength: 1, theme: 'energyblue'});

                $('#sendButton').on('click', function () {
                    $('#changeResearchStatusForm').jqxValidator('validate');
                });
                $('#changeResearchStatusForm').bind('validationError', function (event) {
                    alert('Error while validating!');
                });

                $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});
            });

        </script>

        <script type="text/javascript">
            $(document).ready(
                    function () {
                        var item = 0;
                        $("#jqxPhases").val(item);
                        $('#jqxPhases').bind('select', function (event) {
                            var args = event.args;
                            item = $('#jqxPhases').jqxDropDownList('getItem', args.index);
                            var Phase_Id = item.value;
                            $('#jqxPhasesVal').val(item.value);
                            var reviewStatusSrc =
                                    {
                                        datatype: "json",
                                        datafields: [
                                            {name: 'status_id'},
                                            {name: 'status_name'}
                                        ],
                                        url: '../lib/json/research_status_GetPhaseStatus.php?Phase_id=' + Phase_Id,
                                        async: false
                                    };
                            var dataAdapter1 = new $.jqx.dataAdapter(reviewStatusSrc);
                            $("#jqxPhaseStatus").jqxDropDownList(
                                    {
                                        theme: 'energyblue',
                                        width: 300,
                                        height: 25,
                                        selectedIndex: 0,
                                        source: dataAdapter1,
                                        displayMember: 'status_name',
                                        valueMember: 'status_id',
                                        rtl: true
                                    });
                        });

                        $('#jqxPhaseStatus').on('select', function (event)
                        {
                            var args = event.args;
                            if (args) {
                                // index represents the item's index.                
                                var index = args.index;
                                var item = args.item;
                                // get item's label and value.
                                var label = item.label;
                                var value = item.value;
                                $('#jqxPhaseStatusVal').val(item.value);
                            }
                        });
                        $('#trackDateVal').val($('#track_date').val());
                        $('#track_date').on('change', function (event)
                        {
                            var jsDate = event.args.date;
                            //alert($('#track_date').val());
                            $('#trackDateVal').val($('#track_date').val());
                        });
                    });

        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#changeResearchStatusForm').jqxValidator({rules: [
                        {input: '#jqxPhases', message: 'من فضلك إختار حالة البحث ', action: 'valuechanged, blur', rtl: true, position: 'topcenter', rule: function (input, commit) {
                                var index = $("#research_status").val();
                                if (index === '0')
                                    return false;
                            }}
                    ], theme: 'energyblue', animation: 'fade'
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#changeResearchStatusForm").submit(function () {

                    $.ajax({
                        type: 'post',
                        url: 'inc/change_research_status.inc.php',
                        datatype: "html",
                        data: $("#changeResearchStatusForm").serialize(),
                        beforeSend: function () {
                            $("#result").html("<img src='../imag/ajax-loader.gif'/>loading...");
                        },
                        success: function (data) {
                            $("#result").html(data);
                        }
                    });
                    return  false;
                });
            });
        </script>


        <title>تعديل حالة المشروع البحثى</title>
    </head>
    <body style="background-color: #ededed;">
        <form method="POST" id="changeResearchStatusForm" action="inc/change_research_status.inc.php"> 
            <fieldset>
                <legend>
                    <img src="images/personal.png"/>
                    <label>
                        تعديل حالة المشروع البحثى
                    </label>

                </legend>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p>
                            رقم المشروع
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 

                        <label>
                            <?php echo $_GET['research_code']; ?>
                        </label>
                        <input type="hidden" name="research_code" id="research_code" value="<?php echo $_GET['research_code']; ?>"/>
                    </div>
                </div> 

                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p>
                            اختر مرحلة التحكيم
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="hidden" name="jqxPhasesVal" id="jqxPhasesVal" />
                        <div id='jqxPhases' style="height: 20px;">
                        </div>
                    </div>
                </div> 
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p>
                            اختر حالة البحث
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle;"> 
                        <input type="hidden" name="jqxPhaseStatusVal" id="jqxPhaseStatusVal"/>
                        <div id='jqxPhaseStatus' style="height: 20px;text-align: right;direction: rtl;">
                        </div>
                    </div>
                </div> 
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;">
                        <p>
                            تاريخ التعديل
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="hidden" id="trackDateVal" name="trackDateVal"/>
                        <div style="float:right;" id="track_date" class="Calander">
                        </div>

                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p>ملاحظات </p>
                    </div>
                    <div class="panel-cell" >
                        <input id="notes" class="textArea" type="text" placeholder="ملاحظات" name="notes"/>  
                    </div>
                </div> 

            </fieldset>

            <input type="submit" value="ارسال" id='sendButton' style="margin-top: 10px;"/>

        </form>
        <div id="result" dir="rtl" style="text-align: center"></div>
    </body>
</html>
