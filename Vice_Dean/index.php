<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean') {
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
                    echo 'مرحبا ' . $_SESSION['Alias_Name'];
                    ?>
                </label>
            </legend>
            <div class="panel_row" style="padding-right:  50px; height: 150px;">

                <div class="panel-cell">
                    <a href="research_grid.php">
                        <img id="view_research" src="images/view_research.png" alt="متابعة الأبحاث" title="متابعة الأبحاث" style ="border:0" /> 
                        <p style="margin-top: 0px;">
                            متابعة الابحاث
                        </p>
                    </a>
                </div>

                <div class="panel-cell"  style="padding-right:100px;">
                    <a href="reviewers.php">
                        <img id="reviwers" src="images/reviwers.png" alt="المحكمين" title="المحكمين" style ="border:0" /> 
                        <p style="margin-top: 0px;">
                            المحكمين
                        </p>
                    </a>
                </div>
                <div class="panel-cell"  style="padding-right:100px;">
                    <a href="reviewer_reply.php">
                        <img id="new_Research" src="images/reply.png" alt="ردود المحكين" title="ردود المحكين" style ="border:0" /> 
                        <p style="margin-top: 0px;">
                            ردود المحكمين
                        </p>
                    </a>
                </div>

                <div class="panel-cell" style="padding-right:100px;">
                    <a href="Reports/index.php">
                        <img src="images/reports.png" alt="التقارير" title = "التقارير" style ="border:0;"/>
                        <p style="margin-top: 0px;font-size: 13px;">
                            التقارير
                        </p>
                    </a>

                </div>
                <div class="panel-cell" style="padding-right:100px;">
                    <a href="Charts/index.php">
                        <img src="images/Statistics.png" alt=" بيانات احصائية" title =" بيانات احصائية" style ="border:0;margin-right: 0px;"/>
                        <p style="margin-top: 0px;font-size: 13px;">
                            بيانات احصائية
                        </p>
                    </a>

                </div>

            </div>
            <div class="panel_row" style="padding-right:  50px; height: 200px;">

                <div class="panel-cell">
                    <a href="technologies.php">
                        <img src="images/help-contents-2.png" alt=" بيانات احصائية" title =" بيانات احصائية" style ="border:0;margin-right: 10px;"/>
                        <p style="margin-top: 0px;font-size: 13px;">
                            أولويات البحث
                        </p>
                    </a> 
                </div>

                <div class="panel-cell" style="padding-right:100px;">
                    <a href="tracks.php">
                        <img src="images/settings.png" alt="خروج" title =" خروج" style ="border:0;margin-right: 0px;"/>
                        <p style="margin-top: 0px;font-size: 13px;">
                            التخصصات العامة
                        </p>
                    </a>
                </div>

<!--                <div class="panel-cell" style="padding-right:100px;">
                    <a href="#">
                        <img src="images/settings.png" alt="خروج" title =" خروج" style ="border:0;margin-right: 0px;"/>
                        <p style="margin-top: 0px;font-size: 13px;">
                            التخصصات الدقيقة
                        </p>
                    </a>
                </div>-->

                <div class="panel-cell" style="padding-right:100px;">
                    <a href="../inc/logout.inc.php">
                        <img src="images/exit.png" alt="خروج" title =" خروج" style ="border:0;margin-right: 0px;"/>
                        <p style="margin-top: 0px;font-size: 13px;">
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
