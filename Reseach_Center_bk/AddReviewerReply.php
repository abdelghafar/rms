<?
session_start();
$seqId = $_GET['seqId'];
$research_Code = $_GET['researchCode'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            تسجيل رد المحكم
        </title>
        <link rel="stylesheet" href="css/reigster-layout.css"/> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/globalization/jquery.global.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>


        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 

        <script type="text/javascript">
            $(document).ready(function() {

                var comboSrc = ["مقبول", "مرفوض"];
                $("#jqxdropdownlist").jqxDropDownList({rtl: true, source: comboSrc, selectedIndex: 0, width: '150px', height: '25px', theme: 'energyblue'});

                $(".Calander").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
                $("#notes").jqxInput({rtl: true, height: 75, width: 450, minLength: 1, theme: 'energyblue'});

                $('#sendButton').on('click', function() {
                    $('#changeResearchStatusForm').jqxValidator('validate');
                });
                $('#changeResearchStatusForm').bind('validationError', function(event) {
                    alert('Error while validating!');
                });

                $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});
            });

        </script>
        <script type="text/javascript">
            $(document).ready(
                    function() {
                        var item = 0;
                        $("#research_status").val(item);
                        $('#jqxdropdownlist').bind('select', function(event) {
                            var args = event.args;
                            item = $('#jqxdropdownlist').jqxDropDownList('getItem', args.index);
                            // alert(item);
                            $("#research_status").val(item.index);
                        });
                    });

        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#changeResearchStatusForm').jqxValidator({rules: [
                        {input: '#jqxdropdownlist', message: 'من فضلك إختار حالة البحث ', action: 'valuechanged, blur', rtl: true, position: 'topcenter', rule: function(input, commit) {
                                var index = $("#research_status").val();
                                if (index === '0')
                                    return false;
                            }}
                    ], theme: 'energyblue', animation: 'fade'
                });
            });
        </script>
    </head>
    <body style="background-color: #ededed;">
        <form method="POST" action="inc/AddReviewerReply.inc.php">  

            <fieldset>
                <legend>
                    <img src="images/personal.png"/>
                    <label>
                        تعديل حالة المشروع البحثى
                    </label>

                </legend>
                <input type="hidden" id="seqId" name="seqId" value="<?php echo $seqId; ?>"/>
                <input type="hidden" id="research_Code" name="research_Code" value="<?php echo $research_Code; ?>"/>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p>رقم المشروع</p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <p>
                            <?
                            echo $research_Code;
                            ?>
                        </p>

                    </div>
                </div> 

                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;"> 
                        <p>حالة المشروع البحثى</p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="hidden" name="research_status" id="research_status"/>
                        <div id='jqxdropdownlist' style="height: 20px;">
                        </div>
                    </div>
                </div> 
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;">
                        <p>
                            تاريخ التعديل
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div style="float:right;" id="track_date" class="Calander">

                        </div>

                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width: 200px;text-align: left;padding-left: 10px;vertical-align: top;"> 
                        <p>ملاحظات </p>
                    </div>
                    <div class="panel-cell" >
                        <input id="notes" class="textArea" type="text" placeholder="ملاحظات" name="notes"/>  
                    </div>
                </div> 

            </fieldset>

            <input type="submit" value="ارسال" id='sendButton' style="margin-top: 10px;"/>

        </form>
        <div id="result" dir="rtl" style="text-align: center"></div>

    </body>
</html>
