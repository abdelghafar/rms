<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Researcher') {
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
$smarty->assign('index_php', '../Researchers/index.php');
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
                    <a href="UpdateInfo.php">
                        <img src="images/Profile.png" alt="تعديل البيانات" title ="تعديل البيانات" style ="border:0;"/>
                        <p style="margin-top: 0px;">
                            تعديل بيانات
                        </p>
                    </a>

                </div>
                <div class="panel-cell" style="padding-right:100px;">

                    <a href="research_submit.php">
                        <img id="new_Research" src="images/new_Research.png" alt="تقديم بحث" title="تقديم بحث" style ="border:0" /> 
                        <p style="margin-top: 0px;">
                            تقديم بحث
                        </p>
                    </a>
                </div>

                <div class="panel-cell" style="padding-right: 100px;">
                    <a href="CoAuthors.php"> 
                        <img src="images/team.png" alt="الباحثين المشاركين" title ="الباحثين المشاركين" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            الباحثين المشاركين
                        </p>
                    </a>

                </div>

                <div class="panel-cell" style="padding-right: 100px;">
                    <a href="Researchers_View.php">
                        <img src="images/view_research.png" alt="متابعة الأبحاث" title ="متابعة الأبحاث" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            متابعة الابحاث
                        </p>
                    </a>

                </div>
                <div class="panel-cell" style="padding-right: 100px;">
                    <a href="Forms.php">
                        <img src="images/invoice.png" alt="  النماذج  و الاستمارات" title ="  النماذج  و الاستمارات" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            النماذج  و الاستمارات
                        </p>
                    </a>

                </div>
            </div>
            <div class="panel_row" style="padding-right: 50px; height: 100px;clear: both;margin-top: 20px;" >
                <div class="panel-cell" style="padding-right: 0px;">

                    <a href="ChangePassword.php">
                        <img src="images/password_change.png" alt="تغير كلمة المرور" title ="تغير كلمة المرور" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            تغير كلمة المرور
                        </p>
                    </a>
                </div>

                <div class="panel-cell" style="padding-right: 100px;">
                    <a href="workingPlan.php">
                        <img src="images/view-calendar.png" alt="خطة العمل" title ="خطة العمل" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            خطة العمل
                        </p>
                    </a>

                </div>

                <div class="panel-cell" style="padding-right: 100px;">
                    <a href="budget.php">
                        <img src="images/budget.png" alt="الميزانية" title ="الميزانية" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            الميزانية
                        </p>
                    </a>

                </div>
                <div class="panel-cell" style="padding-right: 100px;">
                    <a href="#">
                        <img src="images/task-due.png" alt="اهداف المشروع" title ="اهداف المشروع" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            اهداف المشروع
                        </p>
                    </a>

                </div>

                <div class="panel-cell" style="padding-right: 100px;">
                    <a href="../inc/logout.inc.php">
                        <img src="images/exit.png" alt="خروج" title ="خروج" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            خروج
                        </p>
                    </a>

                </div>
            </div>

            <div class="panel_row" style="padding-right: 50px; height: 100px;clear: both;margin-top: 20px;" >
                <div class="panel-cell" style="padding-right: 0px;">

                    <a href="schedule.php">
                        <img src="images/appointment-new.png" alt="جدول المهام" title ="جدول المهام" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            جدول المهام
                        </p>
                    </a>
                </div>

                <div class="panel-cell" style="padding-right: 100px;">
                    <a href="#">
                        <img src="images/documents.png" alt=" المستندات الهامة" title =" المستندات الهامة" style ="border:0"/>
                        <p style="margin-top: 0px;">
                            المستندات الهامة
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
