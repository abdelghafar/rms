<?
require_once 'lib/Smarty/libs/Smarty.class.php';

$smarty = new Smarty();

$smarty->assign('style_css', 'style.css');
$smarty->assign('style_responsive_css', 'style.responsive.css');
$smarty->assign('jquery_js', 'jquery.js');
$smarty->assign('script_js', 'script.js');
$smarty->assign('script_responsive_js', 'script.responsive.js');
$smarty->assign('index_php', 'index.php');
$smarty->assign('Researchers_register_php', 'Researchers/register.php');
$smarty->assign('login_php', 'login.php');
$smarty->assign('fqa_php', 'fqa.php');
$smarty->assign('contactus_php', 'contactus.php');

$smarty->display('templates/header.tpl');
?> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <script type="text/javascript" src="js/jqwidgets/scripts/gettheme.js"></script> 
    <script type="text/javascript" src="js/jquery-ui/js/jquery-1.9.0.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxcheckbox.js"></script>
    <link rel="stylesheet" href="js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
    <style type="text/css">
        .demo-iframe {
            border: none;
            width: 600px;
            height: 200px;
            clear: both;
            display: none;
        }
        .form #password, .form #username {
            height: 24px;
            margin-top: 5px;
            width: 150px;
        }
        .art-postheader h2{
            font-family: Arial, 'Arial Unicode MS', Helvetica, Sans-Serif;
            text-decoration: none;
            color: #F0AC00;
        }
        .prompt {
            margin-top: 10px; font-size: 10px;
        }
        fieldset
        {
            width: 900px;

            direction: rtl; 
            border-radius: 10px; 
            border: 2px solid #011d94; 
        }

        fieldset legend
        {
            font-weight: bold; 
            color: #2F108C; 
            padding-right: 8px; 
            padding-left: 8px;
        }
        label
        {
            font-weight: bold; 
            color: #2F108C; 
            font-size: 18px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            var theme = "energyblue";
            $("#username, #password").addClass('jqx-input');
            $("#rememberme").jqxCheckBox({width: 130, theme: theme});
            $("#loginButton").jqxButton({theme: theme});

            // add validation rules.
            $('#form').jqxValidator({
                rules: [
                    {input: '#username', message: 'من فضلك ادخل اسم المستخدم', action: 'keyup, blur', rule: 'required', position: 'left'},
                    {input: '#username', message: 'اسم المستخدم يجب أن يبدأ بحرف', action: 'keyup, blur', rule: 'startWithLetter'},
                    {input: '#password', message: 'من فضلك أدخل كلمة المرور', action: 'keyup, blur', rule: 'required', position: 'left'}
                ]
                        , theme: 'energyblue'
            });
            // validate form.
            $("#loginButton").click(function() {
                $('#form').jqxValidator('validate');
            });

            $("#form").on('validationSuccess', function() {
                $("#form-iframe").fadeIn('fast');
            });
        });
    </script>

    <title>
        الدخول الي النظام
    </title>
</head>
<body>
<center>
    <div style="height: 300px; display: block; font-size: 13px; font-family: Verdana; ">
        <fieldset style="width: 95%;text-align: right;"> 
            <legend style="color: #F0AC00;font-size: medium;">
                تسجيل الدخول

            </legend>
            <p style="color:red;">
                <?
                $Attempt = $_GET['Attempt'];
                if ($Attempt == 'False')
                    echo 'من فضلك ادخل اسم المستخدم و كلمة المرور بشكل صحيح';
                ?>
            </p>
            <form class="form" id="form" method="post" action="inc/login.inc.php" style="width: 650px;text-align: right;">
                <p>اسم المستخدم</p>
                <div>
                    <input type="text" id="username" name="username" style="width: 200px;background-color: white;" placeholder="example@uqu.edu.sa" />
                </div>
                <p>كلمة المرور</p> 
                <div>
                    <input type="password" id="password" name="password" style="width: 200px;background-color: white;"  />
                </div>
                <br/>

                <br/>

                <div>
                    <input id="loginButton" type="submit" value="دخول" style="width: 90px;"  />
                    <div style="margin-top: 10px;">
                        <a href="Researchers/register.php" style="font-weight: bold" >
                            تسجيل جديد
                        </a>
                    </div>
                </div>

            </form>

        </fieldset>

    </div>
    <div>
    </div>
</center>
</body>

<?
$smarty->display('../templates/footer.tpl');
?>

