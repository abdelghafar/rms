<?php
session_start();
require_once '../lib/technologies.php';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if (isset($_GET['seq_id'])) {
        $action .= '&seq_id=' . $_GET['seq_id'];
        $t = new Technologies();
        $rs = $t->GetTechnologies($seq_id);
        while ($row = mysql_fetch_array($rs)) {
            $title = $row['title'];
            $desc = $row['tech_desc'];
            $isVisible = $row['isVisible'];
            $seq_id = $row['seq_id'];
        }
    }
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
                $("#Title").jqxInput({width: '300', height: '30', theme: theme, rtl: true});
                $("#Desc").jqxInput({width: '300', height: '100', theme: theme, rtl: true});
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {

            });
        </script>
    </head>
    <body style="background-color: #ededed;">
        <form id="AddEdit_Research_docs" enctype="multipart/form-data" method="POST" action="inc/AddEditTechnologies.inc.php?action=<? echo $action; ?>" target="form-iframe">
            <fieldset style="width: 600px;text-align: right;">
                <legend>
                    <label>
                        اولوية البحث
                    </label>
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            العنوان 
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="Title" name="Title" value="<?
                        if ($seq_id > 0) {
                            echo $title;
                        }
                        ?>"/>
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
                            <?
                            if ($seq_id > 0) {
                                echo $desc;
                            }
                            ?>
                        </textarea>
                    </div>
                </div> 
                <div class="panel_row">
                    <div class="panel-cell" style="width: 128px;text-align: left;padding-left: 10px;"> 
                        <p>
                            ظهور/اخفاء
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="checkbox" name="chkIsVisible" value="1" <?
                        if ($isVisible == 1) {
                            echo 'checked="checked"';
                        }
                        ?> />
                    </div>
                </div> 
                <input type="submit" value="حفظ" id="sendButton" style="margin-top: 10px;"/>
            </fieldset>
        </form>
        <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0">
        </iframe>
    </body>
</html>
