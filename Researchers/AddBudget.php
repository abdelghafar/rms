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
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnumberinput.js"></script>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>

    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
    <style type="text/css">
        .demo-iframe {
            border: none;
            width: 600px;
            height: 60px;
            clear: both;
            float: right;
            margin: 0px;
            padding: 0px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var theme = "energyblue";
            $("#sendButton").jqxButton({width: '100', height: '30', theme: theme});
            $("#budgetTitle").jqxInput({width: '200', height: '30', theme: theme, rtl: true});
            $("#Amount").jqxNumberInput({rtl: true, width: '200px', height: '30px', min: 0, max: 300000, theme: 'energyblue', inputMode: 'simple', decimalDigits: 0, digits: 6, spinButtons: true});
            $('#Amount').on('change', function (event) {
                var value = event.args.value;
                $('#budget_amount').val(value);
                //alert('Currencey Value is:' + $("#currencyInput").jqxNumberInput('getDecimal'));

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

        });

    </script>

</head>
<body style="background-color: #ededed;">
<form id="AddEdit_Research_docs" enctype="multipart/form-data" method="POST" action="inc/AddBudget.inc.php"
      target="form-iframe">
    <input type="hidden" id="rcode" name="rcode" value="<? echo $rcode; ?>"/>
    <input type="hidden" id="budget_amount" name="budget_amount"/>
    <fieldset style="width: 600px;text-align: right;">
        <legend>
            <label>
                اضافة الميزانية
            </label>
        </legend>
        <div class="panel_row">

            <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;">

                <p>
                    عنوان البند
                </p>

            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input type="text" id="budgetTitle" name="budgetTitle"/>
            </div>
        </div>

        <div class="panel_row">
            <div class="panel-cell" style="width: 128px;text-align: left;padding-left: 10px;">
                <p>
                    المبلغ
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <div id="Amount"></div>
            </div>
        </div>

        <input type="submit" value="حفظ" id="sendButton" style="margin-top: 10px;"/>
    </fieldset>
</form>
<iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0">
</body>
</html>
