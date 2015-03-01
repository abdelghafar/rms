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

$smarty->display('../templates/Loggedin.tpl');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/>
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
        <title>

        </title>
    </head>
    <body>
    <center>
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?php
                    echo 'مرحبا ' . $_SESSION['User_Name'];
                    ?>
                </label>
            </legend>
            <div class="panel_row" style="padding-right: 50px; height: 100px;">

                <div class="panel-cell">
                    <a href="Researchers_Review.php">
                        <img src="images/view_research.png" alt="متابعة الأبحاث" title ="متابعة الأبحاث" style ="border:0"/>
                    </a>
                    <p style="margin-top: 0px;">
                       متابعة الابحاث
                    </p>

                </div>

                <div class="panel-cell" style="padding-right:100px;">
                    <a href="../inc/logout.inc.php">
                        <img src="images/exit.png" alt="خروج" title ="خروج" style ="border:0"/>
                    </a>
                     <p style="margin-top: 0px;">
                      خروج
                    </p>
                </div>
            </div>

        </fieldset>
    </center>

</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>