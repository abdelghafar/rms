<?
session_start();
require_once 'lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();
$smarty->assign('style_css', 'style.css');
$smarty->assign('style_responsive_css', 'style.responsive.css');
$smarty->assign('jquery_js', 'jquery.js');
$smarty->assign('script_js', 'script.js');
$smarty->assign('script_responsive_js', 'script.responsive.js');

$smarty->assign('index_php', 'index.php');
$smarty->assign('research_projects_php', 'Researchers_View.php');
$smarty->assign('logout_php', 'inc/logout.inc.php');
$smarty->assign('about_php', 'aboutus.php');

$smarty->assign('login_php', 'login.php');
$smarty->assign('fqa_php', 'fqa.php');
$smarty->assign('contactus_php', 'contactus.php');

$smarty->display('templates/header.tpl');

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <script type="text/javascript" src="js/jqwidgets/scripts/gettheme.js"></script>
    <script type="text/javascript" src="js/jquery-ui/js/jquery-1.9.0.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxpasswordinput.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>

    <script src="js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jqwidgets/jqwidgets/jqxvalidator.js"></script>

    <link rel="stylesheet" href="js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
    <link href="js/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="js/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="register.js"></script>

</head>
<body>
<div class="panel panel-primary" style="width: 100%;margin-left: 50px;direction: rtl;">
    <div class="panel-heading">
        التسجبل / Registeration
    </div>
    <div class="panel-body">
        <form action="inc/Post.php" method="post">
            <div class="row" style="margin-top: 10px;direction: rtl;">
                <div class="col-md-6" style="float: right;">
                    <input type="text" name="FirstName_ar" value="" class="textbox"/>
                    <label style="float: left;margin-right: 15px;padding-left: 10px;float:right;">
                        الاسم الاول / First Name
                        <span style="color: red;font-size: 18px;">*</span>
                    </label>
                </div>

                <div class="col-md-6" style="float: right;">
                    <input type="text" name="FirstName_ar" value="" class="textbox"/>
                    <label style="float: left;margin-right:15px;padding-left: 10px;float:right;">
اسم الاب / Father Name
                        <span style="color: red;font-size: 18px;">*</span>
                    </label>
                </div>
            </div>

            <div class="row" style="margin-top: 10px;direction: rtl;">
                <div class="col-md-6" style="float: right;">
                    <input type="text" name="FirstName_ar" value="" class="textbox"/>
                    <label style="float: left;margin-right: 15px;padding-left: 10px;float:right;">
اسم الجد / GrandFather Name
                        <span style="color: red;font-size: 18px;">*</span>
                    </label>
                </div>

                <div class="col-md-6" style="float: right;">
                    <input type="text" name="FirstName_ar" value="" class="textbox"/>
                    <label style="float: left;margin-right:15px;padding-left: 10px;float:right;">
اسم العائلة / Family Name
                        <span style="color: red;font-size: 18px;">*</span>
                    </label>
                </div>
            </div>



            <div class="row" style="margin-top: 25px;">
                <div class="col-md-12" style="padding-left: 20px;">
                    <input type="submit" value="Save" id="Update" style="float: right;margin-right: 60px;"/>
                </div>
            </div>
        </form>
    </div>
</div>
<?
$smarty->display('templates/footer.tpl');
?>