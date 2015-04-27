<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jqwidgets/scripts/jquery-1.10.2.min.js" type="text/javascript"></script>

        <script src="../js/jquery-ui/js/jquery-1.9.0.js" type="text/javascript"></script>
        <link href="../js/bootstrap/themes/bootstrap_cerulean.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.summer.css" type="text/css" />
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/scripts/demos.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <link href="css/test.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            function CreateWindow()
            {
                $('#window').css('visibility', 'visible');
                $('#window').jqxWindow({showCollapseButton: false, rtl: true, height: 500, width: 800, autoOpen: false, isModal: true, animationType: 'slide'});
                $('#windowContent').load('inc/IntinalReview.inc.php?id=' + 'MQ==');
                $('#window').jqxWindow('setTitle', 'اضافة - تعديل المحكمين');
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#showWindowButton').click(function () {
                    CreateWindow();
                    $('#window').jqxWindow('open');
                });
                $('#hideWindowButton').click(function () {
                    $('#window').jqxWindow('close');
                });
            });
        </script>
        <style>
            .a{
                text-decoration: none;
                color:#ff4f95;
            }
        </style>
        <title></title>
    </head>
    <body>
        <div id="window" style="visibility: hidden;">
            <div id="windowHeader">
            </div>
            <div style="overflow: auto;" id="windowContent"></div>
        </div>
        <a href="#" id="showWindowButton">
            Show Window
        </a>
    </body>
</html>
