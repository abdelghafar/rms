<?php
session_start();
require_once '../lib/technologies.php';
$token = $_SESSION['AddEditTechnologies']['token'] = sha1(uniqid());
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'insert': {
                break;
            }
        case 'edit': {
                $t = new Technologies();
                $rs = $t->GetTechnologies($seq_id);
                while ($row = mysql_fetch_array($rs)) {
                    $seq_id = $row['seq_id'];
                    $title = $row['title'];
                    $desc = $row['tech_desc'];
                    $isVisible = $row['isVisible'];
                }
                break;
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
            function clear()
            {
                alert('clear');
            }
        </script>
    </head>
    <body style="background-color: #ededed;">
        <form id="AddEditTechnologies" enctype="multipart/form-data" method="POST" action="inc/AddEditTechnologies.inc.php?action=<? echo $action; ?>" target="form-iframe">
            <input type="hidden" name="seq_id" value="<? echo $seq_id; ?>"/>
            <input type="hidden" name="action" value="<? echo $action; ?>"/>
            <input type="hidden" name="token" value="<? echo $token; ?>"/>
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
