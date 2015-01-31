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
                $("#title").jqxInput({width: '400', height: '30', theme: theme, rtl: true});
                $("#desc").jqxInput({width: '400', height: '130', theme: theme, rtl: true});
                $("#sendButton").on('click', function () {

                });
            });
        </script>
    </head>
    <body style="background-color: #ededed;">
        <form id="AddEdit_Research_docs" enctype="multipart/form-data" method="POST" action="inc/AddWorkingPlan.inc.php" target="form-iframe">
            <input type="hidden" id="rcode" name="rcode" value="<? echo $rcode; ?>"/>
            <fieldset style="width: 600px;text-align: right;">
                <legend>
                    <p>
                        اضافة مرحلة عمل
                    </p>
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 

                        <p>
                            عنوان المرحلة
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="title" name="title"/>
                    </div>
                </div> 

                <div class="panel_row">
                    <div class="panel-cell" style="width: 128px;text-align: left;padding-left: 10px;"> 
                        <p>
                            التفاصيل
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <textarea name="desc" rows="4" cols="20" id="desc">
                        </textarea>
                    </div>
                </div> 

                <input type="submit" value="حفظ" id="sendButton" style="margin-top: 10px;"/>
            </fieldset>
        </form>
        <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0" >
    </body>
</html>
