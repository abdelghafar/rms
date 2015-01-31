<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Researcher')
        header('Location:../Login.php');
}

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
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');

$smarty->display('../templates/Loggedin.tpl');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <link rel="stylesheet" href="../common/css/MessageBox.css" type="text/css"/> 
        <title></title>
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.Infobox').hide();
                $(".Infobox").fadeIn(4000, 'swing');
            });
        </script>
    </head>
    <body>
    <center>

        <div class="Infobox" style="direction:rtl;width:850px;text-align: right;">
            <span>
                فترة التقديم
            </span>
            <br/>
            <ul type="disc" style="text-align: right;">
                <li  style="color:#00529B;text-align: right;">
                    (للرجال) في الفترة من  4-5-1436 هـ  الي 3-6-1436 هـ
                </li>
                <li  style="color:#00529B;text-align: right;">
                    (للنساء) في الفترة من 9-5-1436 هـ الي 8-6-1436 هـ
                </li>
            </ul>

        </div>
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?php
                    echo 'مرحبا ' . $_SESSION['User_Name'];
                    ?>
                </label>
            </legend>
            <div class="panel_row" style="padding-right: 50px; height: 200px;">

                <div class="panel-cell">
                    <a href="forms/ISR-99-2013.doc">
                        <img src="images/invoice.png" alt="طلب تمويل" title ="طلب تمويل" style ="border:0;"/>
                        <p style="margin-top: 0px;">
                            طلب تمويل
                        </p>
                    </a>
                </div>
                <div class="panel-cell" style="padding-right:100px;">
                    <a href="forms/ISR-Proposal-Form.doc">
                        <img id="new_Research" src="images/document-open-8.png" alt="نموذج-2" title="نموذج-2" style ="border:0" /> 
                        <p style="margin-top: 0px;">
                            نموذج-2
                        </p>
                    </a>
                </div>
                <div class="panel-cell" style="padding-right:100px;">
                    <a href="forms/ISR-Letter-3.doc">
                        <img id="new_Research" src="images/invoice.png" alt="نموذج-2" title="نموذج-2" style ="border:0" /> 
                        <p style="margin-top: 0px;">
                            طلب تمويل أجهزة
                        </p>
                    </a>
                </div>
        </fieldset>
        <label>
            <a href="index.php?program=<? echo $_SESSION['program'] ?>" style="float: left;margin-left: 25px;margin-top: 20px;">
                رجوع
            </a></label>
    </center>
</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>