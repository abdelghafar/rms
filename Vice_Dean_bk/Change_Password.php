<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean')
        header('Location:../Login.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>                
            تغير كلمة مرور حساب
        </title>
        <link rel="stylesheet" href="../common/css/reigster-layout.css"/> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
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
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxpasswordinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcombobox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxexpander.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.export.js"></script>

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
        <style type="text/css">
            .demo-iframe {
                border: none;
                width: 200px;
                height: 20px;
                display:none; 
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                var theme = "energyblue";
                $("#createAccount").jqxExpander({theme: theme, toggleMode: 'none', width: '480px', showArrow: false, rtl: true});
                $("#password").jqxPasswordInput({theme: theme, width: '200px', height: '25px', maxLength: 20, showStrength: true, showStrengthPosition: "left", rtl: true});
                $("#passwordConfirm").jqxPasswordInput({theme: theme, width: '200px', height: '25px', maxLength: 20, rtl: true});
                $('#sendButton').jqxButton({width: 60, height: 25, theme: theme});

                $('#form').jqxValidator({
                    rules: [
                        {input: '#password', message: 'من فضلك ادخل كلمة المرور', action: 'keyup, blur', rule: 'required', position: 'top'}, {input: '#passwordConfirm', message: 'من فضلك ادخل كلمة المرور', action: 'keyup, blur', rule: 'required', position: 'top'},
                        {input: '#password', message: 'كلمة المرور يجب أن تكون 8 حروف علي الاقل', action: 'keyup, blur', rule: 'length=8,20', position: 'top'},
                        {input: '#passwordConfirm', message: 'من فضلك ادخل كلمة المرور بشكل صحيح', action: 'keyup, focus', position: 'top', rule: function(input, commit) {
                                if (input.val() === $('#password').val()) {
                                    return true;
                                }
                                return false;
                            }
                        }
                    ], theme: theme

                });
                $("#sendButton").click(function() {
                    var validationResult = function(isValid) {
                        if (isValid) {
                            $("#form").submit();
                        }
                    };
                    $('#form').jqxValidator('validate', validationResult);
                });

                $("#form").on('validationSuccess', function() {
                    $("#form-iframe").fadeIn('fast');
                });

            });
        </script>
    </head>
    <body style="background-color: #ededed;">
        <form id="form" enctype="multipart/form-data" method="POST" action="inc/Change_Password.inc.php" target="form-iframe">
            <input type="hidden" name="user_id" value="<? echo $_GET['userId']; ?>"/>
            <fieldset style="width: 90%;text-align: right;"> 
                <legend>
                    <label>
                        تعديل بيانات الحساب
                    </label>
                </legend>
                <div class="panel_row">
                    <div class="panel-cell" style="width:85px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p class="classic">
                            كلمة المرور   
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="password" type="password" name ="password"/>
                    </div>
                </div>
                <div class="panel_row">
                    <div class="panel-cell" style="width:0px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p class="classic">
                            تأكيد كلمة المرور
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="passwordConfirm" type="password" name ="passwordConfirm"/>
                    </div>
                </div>
            </fieldset>
            <input type="button" value="حفظ" id="sendButton" />
        </form>
        <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe>
    </body>
</html>
