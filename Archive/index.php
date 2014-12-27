<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Archive') {
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
        <title></title>
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/>
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
            <div class="panel_row" style="padding-right:50px; height: 400px;">
                <div class="panel-cell" style="padding-right:200px;text-align: center;">
                    <a href="docs_categories.php">
                        <img id="new_Research" src="images/document-open-8.png" alt="فئات المستندات" title="فئات المستندات" style ="border:0" /> 
                        <p style="margin-top: 0px;">
                            فئات المستندات
                        </p>
                    </a>
                </div>

                <div class="panel-cell" style="padding-right:100px;text-align: center;">
                    <a href="Research_docs.php">
                        <img src="images/document-new-3.png" alt="المستندات" title ="المستندات" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            المستندات
                        </p>
                    </a>

                </div>

                <div class="panel-cell" style="padding-right:100px;text-align: center;">
                    <a href="../inc/logout.inc.php">
                        <img src="images/exit.png" alt="خروج" title ="خروج" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            خروج
                        </p>
                    </a>
                </div>
            </div>

        </fieldset>
    </center>
</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>


