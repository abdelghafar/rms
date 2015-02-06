<?php
session_start();
require_once '../lib/Subtracks.php';
//if (isset($_GET['action'])) {
//    $action = $_GET['action'];
//    if (isset($_GET['track_id'])) {
//        $action.= '&track_id=' . $_GET['track_id'];
//        echo $action;
//    }
//    if (isset($_GET['subtrack_id'])) {
//        $action .= '&subtrack_id=' . $_GET['subtrack_id'];
//        echo $action;
//        $t = new Subtracks();
//        $subtrack_id = $_GET['subtrack_id'];
//        $rs = $t->GetSubtrack($subtrack_id);
//        while ($row = mysql_fetch_array($rs)) {
//            $title = $row['subTrack_name'];
//            $seq_id = $row['seq_id'];
//        }
//    }
//}
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'insert': {
                $track_id = $_GET['track_id'];
                $url = 'action=' . $action . '&track_id=' . $track_id;
                break;
            }
        case 'edit': {
                $subtrack_id = $_GET['subtrack_id'];
                $url = 'action=' . $action . '&subtrack_id=' . $subtrack_id;
                $obj = new Subtracks();
                $rs = $obj->GetSubtrack($subtrack_id);
                while ($row = mysql_fetch_array($rs)) {
                    $title = $row['subTrack_name'];
                    $seqId = $row['seq_id'];
                }
                break;
            }
        default: {
                exit();
            }
    }
    //echo $url;
}
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
                $("#title").jqxInput({width: '300', height: '30', theme: theme, rtl: true});
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {

            });
        </script>
    </head>
    <body style="background-color: #ededed;">
        <form id="AddEdit_Research_docs" enctype="multipart/form-data" method="POST" action="inc/AddEditSubtrack.inc.php?action=<? echo $url; ?>" target="form-iframe">
            <input type="hidden" name="track_id" value="<? echo $track_id; ?>"/>
            <input type="hidden" name="subtrack_id" value="<? echo $subtrack_id; ?>"/>
            <input type="hidden" name="action" value="<? echo $action; ?>"/>
            <fieldset style="width: 600px;text-align: right;">
                <legend>
                    <label>
                        التخصص الدقيق
                    </label>
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            العنوان 
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="title" name="title" value="<?
                        if (isset($subtrack_id)) {
                            echo $title;
                        }
                        ?>"/>
                    </div>
                </div> 
                <input type="submit" value="حفظ" id="sendButton" style="margin-top: 10px;"/>
            </fieldset>
        </form>
        <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0">
        </iframe>
    </body>
</html>
