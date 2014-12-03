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
require_once '../lib/users.php';
$person_id = $_GET['person_id'];
$rule = $_GET['Rule'];
$u = new Users();
$result = $u->GetUserByPersonId($person_id, $rule);
while ($row = mysql_fetch_array($result)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
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
        <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
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
                width: 400px;
                height: auto;
                display:none; 
                clear: both;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = "energyblue";
                $("#userName").jqxInput({disabled: true});
                $(".textbox").jqxInput({rtl: true, height: 25, width: 200, minLength: 1, theme: theme});
                $("#password").jqxPasswordInput({theme: theme, width: '200px', height: '25px', maxLength: 20, showStrength: true, showStrengthPosition: "left", rtl: true});
                $("#passwordConfirm").jqxPasswordInput({theme: theme, width: '200px', height: '25px', maxLength: 20, rtl: true});
                $(".Calander").jqxDateTimeInput({width: '140px', height: '25px', rtl: true, theme: 'energyblue', formatString: 'yyyy-MM-dd'});
                $('#sendButton').jqxButton({width: 60, height: 25, theme: theme});

                $('#form').jqxValidator({
                    rules: [
                        {input: '#password', message: 'من فضلك ادخل كلمة المرور', action: 'keyup, blur', rule: 'required', position: 'top'}, {input: '#passwordConfirm', message: 'من فضلك ادخل كلمة المرور', action: 'keyup, blur', rule: 'required', position: 'top'},
                        {input: '#password', message: 'كلمة المرور يجب أن تكون 8 حروف علي الاقل', action: 'keyup, blur', rule: 'length=8,20', position: 'top'},
                        {input: '#passwordConfirm', message: 'من فضلك ادخل كلمة المرور بشكل صحيح', action: 'keyup, focus', position: 'top', rule: function (input, commit) {
                                if (input.val() === $('#password').val()) {
                                    return true;
                                }
                                return false;
                            }
                        }
                    ], theme: theme

                });
                $("#sendButton").click(function () {
                    var validationResult = function (isValid) {
                        if (isValid) {
                            $("#form").submit();
                        }
                    };
                    $('#form').jqxValidator('validate', validationResult);
                });

                $("#form").on('validationSuccess', function () {
                    $("#form-iframe").fadeIn('fast');
                });

            });
        </script>

    </head>
    <body style="background-color: #ededed;">

        <form id="form" enctype="multipart/form-data" method="POST" action="inc/Account.inc.php" target="form-iframe">
            <input type="hidden" name="user_id" value="<? echo $user_id; ?>"/>
            <fieldset style="width: 95%;text-align: right;"> 
                <legend>
                    <label>
                        تعديل بيانات الحساب
                    </label>
                </legend>
                <div class="panel_row">
                    <div class="panel-cell" style="width:85px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p class="classic">
                            اسم المستخدم  
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="userName" name="userName" class="textbox" type="text" value="<? echo $user_name ?>"/>
                    </div>
                </div>
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
                <div class="panel_row">
                    <div class="panel-cell" style="width:85px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p class="classic">
                            تاريخ التفعيل
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div style="float:right;" id="fromDate" class="Calander" name="fromDateVal">
                        </div>

                    </div>
                    <div class="panel-cell" style="padding-right: 75px;text-align: left;padding-left: 10px;vertical-align: middle;">
                        <p class="classic">
                            تاريخ الانتهاء
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div style="float:right;" id="thruDate" class="Calander">
                            <input type="hidden" id="thruDateVal" name="thruDateVal"/>
                        </div>

                    </div>
                </div>

            </fieldset>
            <input type="button" value="حفظ" id="sendButton" style="margin-top: 10px;" />
            <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe>
        </form>

    </body>
</html>
