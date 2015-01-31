<?php
session_start();
$rcode = $_GET['rcode'];
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

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
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
            $(document).ready(function () {
                var theme = "energyblue";
                $("#sendButton").jqxButton({width: '100', height: '30', theme: theme});
                $("#Title").jqxInput({width: '200', height: '30', theme: theme, rtl: true});

                $("#sendButton").on('click', function () {

                });
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'seq_id'},
                                {name: 'cat_name'}
                            ],
                            url: '../Data/doc_categories_GetList.php',
                            async: false
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#doc_Cat_list").jqxDropDownList(
                        {
                            source: dataAdapter,
                            displayMember: 'cat_name',
                            valueMember: 'seq_id',
                            width: '200px',
                            height: '25px',
                            theme: theme,
                            selectedIndex: 0,
                            rtl: true
                        });

                var item = $("#doc_Cat_list").jqxDropDownList('getSelectedItem');
                $('#doc_cat_id').val(item.value);
                $('#doc_Cat_list').on('select', function (event)
                {
                    var args = event.args;
                    if (args) {
                        // index represents the item's index.                      
                        var index = args.index;
                        var item = args.item;
                        // get item's label and value.
                        var label = item.label;
                        var value = item.value;
                        $('#doc_cat_id').val(value);
                    }
                });

            });
        </script>

    </head>
    <body style="background-color: #ededed;">
        <form id="AddEdit_Research_docs" enctype="multipart/form-data" method="POST" action="inc/AddSchedule.inc.php" target="form-iframe">
            <input type="hidden" id="rcode" name="rcode" value="<? echo $rcode; ?>"/>
            <fieldset style="width: 600px;text-align: right;">
                <legend>
                    <label>
                        اضافة مستند
                    </label>
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 

                        <p>
                            عنوان المستند
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="Title" name="Title"/>
                    </div>
                </div> 
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 

                        <p>
                            نوع المستند
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div id="doc_Cat_list"></div>
                        <input type="hidden" id="doc_cat_id" name="doc_cat_id"/> 
                    </div>
                </div> 

                <div class="panel_row">
                    <div class="panel-cell" style="width: 128px;text-align: left;padding-left: 10px;"> 
                        <p>
                            المستند
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="file" name="file" id="file" style="width:300px;" dir="ltr"/>
                    </div>
                </div> 

                <input type="submit" value="حفظ" id="sendButton" style="margin-top: 10px;"/>
            </fieldset>
        </form>
        <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0" >
    </body>
</html>
