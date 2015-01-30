<?php
session_start();

require_once '../lib/persons.php';
if (isset($_GET['q'])) {
    $q = $_GET['q'];

    $p = new Persons();
    $rs = $p->GetPersonByEmpCode($q);
    while ($row = mysql_fetch_array($rs)) {
        echo $row['Email'] . '<br/>';
        echo $row['Person_id'];
    }
    if (mysql_affected_rows() == 0) {
        echo 'Not registed EmpCode';
    }
}
if (isset($_GET['rcode'])) {
    $ResearchCode = $_GET['rcode'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="../common/css/reigster-layout.css"/> 
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
        <script src="../js/jqwidgets/jqwidgets/jqxgrid.js" type="text/javascript"></script>
        <script src="../js/jqwidgets/jqwidgets/jqxgrid.selection.js" type="text/javascript"></script>
        <script src="../js/jqwidgets/jqwidgets/jqxgrid.edit.js" type="text/javascript"></script>
        <script src="../js/jqwidgets/jqwidgets/jqxgrid.sort.js" type="text/javascript"></script>
        <script src="../js/jqwidgets/jqwidgets/jqxgrid.pager.js" type="text/javascript"></script>
        <script src="../js/jqwidgets/jqwidgets/jqxmenu.js" type="text/javascript"></script>
        <script src="../js/jqwidgets/jqwidgets/jqxcheckbox.js" type="text/javascript"></script>

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
        <script type="text/javascript">
            $(document).ready(function () {
                var Curr_theme = 'energyblue';
                $("#btnSave").jqxButton({width: '150', height: '25', theme: Curr_theme});
                $('#btnSave').on('click', function () {
                    $.ajax({
                        url: "../Data/saveCoAuthor.php?researchCode=" + <? echo $ResearchCode ?> + "&personId=" + tmpPerson_id,
                        success: function (data) {
                        }
                    });
                    $('#window').jqxWindow('close');
                });
            });
        </script>

    </head>
    <body>

        

       

        

        <div id='row' class="panel_row" style="width: 400px; height: 50px;float: right;">
            <input type="button" value="حفظ" id='btnSave' style="direction: rtl;float: right;margin-top: 20px;float: right;margin-right: 14px;"  />

        </div>


    </body>
</html>
