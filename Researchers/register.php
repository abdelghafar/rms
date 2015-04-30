<?
session_start();
if ($_SESSION['Authorized'] == null) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
} else if ($_SESSION['Authorized'] == 0) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
}

require_once '../js/fckeditor/fckeditor.php';
require_once '../lib/Smarty/libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->assign('style_css', '../style.css');
$smarty->assign('style_responsive_css', '../style.responsive.css');
$smarty->assign('jquery_js', '../jquery.js');
$smarty->assign('script_js', '../script.js');
$smarty->assign('script_responsive_js', '../script.responsive.js');
$smarty->assign('index_php', '../index.php');
$smarty->assign('Researchers_register_php', '../Researchers/register.php');
$smarty->assign('login_php', '../login.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');
$smarty->display('../templates/header.tpl');
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../common/css/reigster-layout.css"/>

    <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script>
    <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxpasswordinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
    <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxfileupload.js"></script>

    <script type="text/javascript" src="js/register.js"></script>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>


    <style type="text/css">
        #recaptcha_area {
            width: 318px !important;
            direction: ltr;
        }
    </style>
    <script type="text/javascript">


    </script>

    <script type="text/javascript">
        $(document).ready(
            function () {

            });

    </script>

    <script type="text/javascript">

    </script>
    <style type="text/css">
        .demo-iframe {
            border: none;
            width: 900px;
            height: 150px;
            display: none;
        }
    </style>
    <script type="text/javascript">
        function Clear() {

        }
    </script>
    <title>تسجيل باحث</title>
</head>
<body>
<form method="POST" id="registerFrom" target="form-iframe" action="inc/register.inc.php" enctype="multipart/form-data">
    <input type="hidden" name="key" value="<? echo uniqid(); ?>">
    <fieldset style="width: 95%;text-align: right;">
        <legend>
            <label>
                بيانات شخصية / Personal Data
            </label>

        </legend>
        <div class="panel_row">
            <div class="panel-cell" style="width: 295px;text-align: left;padding-left: 10px;">
                <p style="font-weight: bold" class="classic">
                    الاسم باللغة العربية / Arabic Name
                </p>
            </div>
            <div class="panel-cell" style="width: 700px;">
                <input id="name_ar" type="text" placeholder="" name="name_ar"/>
            </div>
            <div class="panel_row">
                <div class="panel-cell" style="width: 280px;text-align: left;padding-left: 10px;">
                    <p style="font-weight: bold" class="classic">
                        الاسم باللغة الانجلزية / English Name
                    </p>
                </div>
                <div class="panel-cell" style="width: 700px;">
                    <input id="name_en" type="text" placeholder="" name="name_en"/>
                </div>
            </div>
            <div class="panel_row">
                <div class="panel-cell"
                     style="width: 218px;text-align: left;padding-left: 12px;vertical-align: middle;">
                    <p style="font-weight: bold" class="classic">
                        النوع / Gender
                    </p>
                </div>
                <div class="panel-cell" style="vertical-align: middle">
                    <div id="gender">
                        <input type="hidden" name="genderType" id="genderType"/>
                    </div>
                </div>

                <div class="panel-cell" style="width:315px;text-align: left;padding-left: 10px;vertical-align: middle;">
                    <p style="font-weight: bold" class="classic">
                        الجنسية / Nationality
                    </p>
                </div>
                <div class="panel-cell" style="vertical-align: middle">
                    <div id="countriesList"></div>
                    <input type="hidden" id="selectedCountry" name="selectedCountry">
                </div>
            </div>
        </div>
    </fieldset>
    <br/>
    <br/>
    <fieldset style="width: 95%;text-align: right;">
        <legend>

            <label>
                بيانات العمل/ Working Data
            </label>
        </legend>
        <div class="panel_row">
            <div class="panel-cell" style="width:225px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    الدرجة العلمية / Scientific Degree
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input type="hidden" name="Position" id="Position"/>

                <div id='jqxdropdownlist' style="height: 20px;">
                </div>
            </div>

        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width:225px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    جهة العمل / Institution
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input id="university" name="university" class="textbox" type="text" value="" placeholder=""/>
            </div>
        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width:225px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    الكلية / College
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input name="college" id="college" class="textbox" type="text" placeholder=""/>
            </div>
        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width:225px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    القسم/ Dept
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input name="dept" id="dept" class="textbox" type="text" placeholder=""/>
            </div>
        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width:225px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    صورة اثبات الهوية / NI Image
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input type="file" name="uploadFile" id="uploadFile">
            </div>
        </div>

    </fieldset>
    <br/>
    <fieldset style="width: 95%;text-align: right;">
        <legend>
            <label>
                للإتصـــال / Contact
            </label>
        </legend>
        <div class="panel_row">
            <div class="panel-cell" style="width:225px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    البريد الالكتروني الرسمى / Offical Email
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input id="email" name="email" class="textbox" type="text" placeholder=""/>
            </div>
        </div>
        <div class="panel_row">
            <div class="panel-cell" style="width:225px;text-align: left;padding-left: 10px;vertical-align: middle;">
                <p style="font-weight: bold" class="classic">
                    جوال / Mobile
                </p>
            </div>
            <div class="panel-cell" style="vertical-align: middle">
                <input id="mobile" name="mobile" class="textbox" type="text" value=""/>
            </div>
        </div>
    </fieldset>

    <input type="submit" value="ارسال" id='sendButton' style="margin-top: 10px;"/>
</form>
<iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe>

</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>
