<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'DeanShip')
        header('Location:../Login.php');
}

require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/Util.php';
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
require_once '../lib/users.php';
$c = new Users();
$rs = $c->GetResearchCenterAcc();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="../js/jquery-ui/js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/> 
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatables').dataTable({
                    sPaginationType: "full_numbers",
                    bJQueryUI: true,
                    bLengthChange: true,
                    width: 800,
                    oLanguage: {
                        sUrl: "../js/dataTables/media/ar_Ar.txt"}
                });
            });

        </script>
        <script type="text/javascript">
            function display_Change_Password(userId)
            {
                window.showModalDialog("ChangePassword.php?userId=" + userId, 'PopupPage', 'dialogHeight:300px; dialogWidth:500px; resizable:0');
                location.reload();
            }
        </script>
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


            <table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold" dir="rtl" >
                <thead>
                    <tr>
                        <th><em>م</em></th>
                        <th>اسم المستخدم </th>
                        <th>الوصف</th>
                        <th>
                            أخر دخول
                        </th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $x = 1;
                    while ($row = mysql_fetch_array($rs)) {
                        ?>
                        <tr>
                            <td><?
                                echo $x;
                                $x++; //$row['id']; 
                                ?></td>
                            <td><? echo $row['user_name']; ?></td>
                            <td style=" text-align: right;"><? echo $row['alias_name']; ?></td>
                            <td style=" text-align: center;"><? echo get_time_difference_php($row['Last_Access']); ?></td>

                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
        <label>
            <a href="index.php" style="float: left;margin-left: 25px;margin-top: 20px;">
                رجوع
            </a></label>
    </center>
</body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>