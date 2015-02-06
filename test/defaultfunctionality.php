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
                $('#jqxFileUpload').jqxFileUpload({width: 300, uploadUrl: 'imageUpload.php', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: true, accept: 'application/pdf'});
                $('#jqxFileUpload1').jqxFileUpload({width: 300, uploadUrl: 'imageUpload.php', fileInputName: 'fileToUpload', theme: 'energyblue', multipleFilesUpload: false, rtl: true, accept: 'application/pdf'});

                $('#jqxFileUpload').on('uploadEnd', function (event) {
                    var args = event.args;
                    var fileName = args.file;
                    var serverResponce = args.response;
                    $('#log').html(serverResponce);
                });


            });
        </script>
    </head>
    <body>     
        <table>
            <tr>
                <td>
                    abs arabic 
                </td>
                <td>
                    <div id='jqxFileUpload'></div>
                </td>
            </tr>
            <tr>
                <td>
                    abs english 
                </td>
                <td>
                    <div id='jqxFileUpload1'></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="log" style="width: 200px;height: 50px;background-color: greenyellow;"></div>
                </td>
            </tr>
        </table>

    <br />
</body>
</html>
