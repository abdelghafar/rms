<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />

        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxchart.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxwindow.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxfileupload.js"></script>

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#arAbsUpload').jqxFileUpload({width: 300, uploadUrl: 'fileUpload.php', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});
                $('#arAbsUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });

                $('#enAbsUpload').jqxFileUpload({width: 300, uploadUrl: 'fileUpload.php', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});
                $('#enAbsUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });

                $('#introUpload').jqxFileUpload({width: 300, uploadUrl: 'fileUpload.php', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});
                $('#introUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });
                $('#reviewUpload').jqxFileUpload({width: 300, uploadUrl: 'fileUpload.php', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: false, accept: 'application/pdf'});
                $('#reviewUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });
            });
        </script>
    </head>
    <body>     
        <table style="direction: rtl;">
            <tr>
                <td>
                    الملخص-اللغة العربية
                </td>
                <td>
                    <div id='arAbsUpload'></div>
                </td>
            </tr>
            <tr>
                <td>
                    الملخص - اللغة الانجليزية
                </td>
                <td>
                    <div id='enAbsUpload'></div>
                </td>
            </tr>
            <tr>
                <td>
                    مقدمة المشروع
                </td>
                <td>
                    <div id='introUpload'></div>
                </td>
            </tr>
            <tr>
                <td>
                    المسح الأدبي
                </td>
                <td>
                    <div id='reviewUpload'></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="log" style="height: 90px;"></div>
                </td>
            </tr>
        </table>
    <br />
</body>
</html>
