<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Reseach_Center')
        header('Location:../Login.php');
}
?>
<?
$researchCode = $_GET['research_code'];
$researchId = $_GET['research_id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../common/css/reigster-layout.css"/> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/globalization/jquery.global.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcombobox.js"></script>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
        <title>
            ارسال رسالة
        </title>

        <script type="text/javascript">
            $(document).ready(function() {
                var theme = "energyblue";
                $(".textbox").jqxInput({rtl: true, height: 25, width: 300, minLength: 1, theme: theme});
                $("#dest").jqxInput({rtl: true, height: 25, width: 150, minLength: 1, theme: theme, disabled: true});
                $(".textArea").jqxInput({rtl: true, height: 100, width: 300, minLength: 1, theme: theme});
                $('#sendButton').on('click', function() {
                    $('#form').jqxValidator('validate');
                });
                $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});
                // validate form.
                $("#sendButton").click(function() {
                    var validationResult = function(isValid) {
                        if (isValid) {
                            $("#form").submit();
                        }
                        ;
                    };
                    $('#form').jqxValidator('validate', validationResult);
                });
                $("#form").on('validationSuccess', function() {
                    $("#form-iframe").fadeIn('fast');
                });
            });</script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#form').jqxValidator({rules: [
                        {input: '#subject', message: 'من فضلك ادخل موضوع الرسالة', action: 'keyup, blur', rule: 'required', rtl: true, position: 'top'},
                        {input: '#dest', message: 'من فضلك ادخل المرسل اليه', action: 'keyup, blur', rule: 'required', rtl: true, position: 'top'},
                        {input: '#message', message: 'من فضلك ادخل الرسالة', action: 'keyup, blur', rule: 'required', rtl: true, position: 'left'}

                    ], theme: 'energyblue', animation: 'fade'
                });
            });
        </script>
        <style type="text/css">
            .demo-iframe {
                border: none;
                width: 300px;
                height: 50px; 
                clear: both;
                float: right; 
                margin:0px;
                padding: 0px;
            }
        </style>
    </head>
    <body style="background-color: #ededed;">
        <form id="form" target="form-iframe" name="form" method="POST" enctype="multipart/form-data" action="inc/SendMessages.inc.php">
            <input type="hidden" name="researchCode" value="<? echo $researchCode; ?>"/>
            <input type="hidden" name="researchId" value="<? echo $researchId; ?>"/>
            <fieldset style="width: 95%;text-align: right;"> 
                <legend>
                    <label>
                        ارسال رسالة
                    </label>
                </legend>
                <div class="panel_row">
                    <div class="panel-cell" style="width:65px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p style="font-weight: bold">
                            الــي
                            <label>
                                <span class="required">*</span>
                            </label>
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="dest" name="dest" value="<? echo $researchCode; ?>" />
                        <input type="hidden" id="to" name="to" value="<? echo $researchCode; ?>" />
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width:65px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p style="font-weight: bold">
                            الموضوع
                            <label>
                                <span class="required">*</span>
                            </label>
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="subject" name="subject" class="textbox"/>
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width:65px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p style="font-weight: bold;margin-top: 0px;">
                            الرسالة
                            <label>
                                <span class="required">*</span>
                            </label>
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: top"> 
                        <textarea id="message" name="message" rows="4" cols="20" class="textArea" style="resize: none;">
                        </textarea>
                    </div>
                </div>
            </fieldset>
            <input type="submit" value="حفظ" id='sendButton' style="margin-top: 10px;"/>
            <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0" >

            </iframe>
        </form>
    </body>
</html>
