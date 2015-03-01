<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Council_board') {
        header('Location:../Login.php');
    }
}
require_once '../lib/users.php';
require_once '../js/fckeditor/fckeditor.php';

$user = new Users();
$personId = $user->GetPerosnId($_SESSION['User_Id'], 'Council_board');
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>

        <script type="text/javascript">
            $(document).ready(function () {
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'status_name'},
                                {name: 'status_id'}
                            ],
                            url: '../lib/json/reesearch_GetPhaseStatus1.php',
                            async: false
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#jqxdropdownlist").jqxDropDownList(
                        {
                            source: dataAdapter,
                            theme: 'energyblue',
                            width: 150,
                            height: 25,
                            selectedIndex: 0,
                            displayMember: 'status_name',
                            valueMember: 'status_id',
                            rtl: true
                        });

                $(".Calander").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
                $("#notes").jqxInput({rtl: true, height: 75, width: 450, minLength: 1, theme: 'energyblue'});

                $('#sendButton').on('click', function () {
                    $('#changeResearchStatusForm').jqxValidator('validate');
                });
                $('#changeResearchStatusForm').bind('validationError', function (event) {
                    alert('Error while validating!');
                });

                $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});
            });

        </script>
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

        <title>تعديل حالة المشروع البحثى</title>
    </head>
    <body style="background-color: #ededed;">
        <form method="POST" id="changeResearchStatusForm" enctype="multipart/form-data" action="inc/change_research_status.inc.php" target="form-iframe"> 
            <fieldset>
                <legend>
                    <img src="images/personal.png"/>
                    <label>
                        تعديل حالة المشروع البحثى
                    </label>

                </legend>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 120px;text-align: left;padding-left: 10px;"> 
                        <p>
                            رقم المشروع
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 

                        <label>
                            <?php echo $_GET['research_code']; ?>
                        </label>
                        <input type="hidden" name="research_id" id="research_id" value="<?php echo $_GET['research_id']; ?>"/>
                        <input type="hidden" name="person_Id" id="person_Id" value="<?php echo $personId ?>"/>
                    </div>
                </div> 

                <div class="panel_row">
                    <div class="panel-cell" style="width: 0px;text-align: left;padding-left: 10px;"> 
                        <p>حالة المشروع البحثى</p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="hidden" name="research_status" id="research_status"/>
                        <div id='jqxdropdownlist' style="height: 20px;" name="jqxdropdownlist">
                        </div>
                    </div>
                </div> 
                <div class="panel_row">
                    <div class="panel-cell" style="width: 120px;text-align: left;padding-left: 10px;">
                        <p>
                            تاريخ التعديل
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div style="float:right;" id="track_date" class="Calander" name="track_date">
                        </div>

                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 120px;text-align: left;padding-left: 10px;">
                        <p>
                            ملحقات
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="file" name="file" width="500" style="direction: rtl;" />
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width:120px;text-align: left;padding-left: 10px;vertical-align: top;"> 
                        <p>ملاحظات </p>
                    </div>
                    <div class="panel-cell">
                        <?
                        $oFCKeditor = new FCKeditor('notes');
                        $oFCKeditor->Height = "300px";
                        $oFCKeditor->Width = "640px";
                        $oFCKeditor->ToolbarSet = 'Advanced';
                        $oFCKeditor->BasePath = '../js/fckeditor/';
                        $oFCKeditor->Create();
                        ?>

                    </div>
                </div> 

            </fieldset>

            <input type="submit" value="ارسال" id='sendButton' style="margin-top: 10px;"/>
            <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0" >

            </iframe>
        </form>
        <div id="result" dir="rtl" style="text-align: center"></div>
    </body>
</html>
