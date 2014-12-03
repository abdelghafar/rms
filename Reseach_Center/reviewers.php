<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Reseach_Center')
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
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');

$smarty->display('../templates/Loggedin.tpl');
?>
<?
require_once '../lib/ResearchCenter_Reviewers.php';
require_once('../lib/CenterResearch.php');


$c_researches = new CenterResearch();
$center_id = $c_researches->GetResearchCenterByUserName($_SESSION['User_Name']);
$obj = new ResearchCenter_Reviewers();
$rs = $obj->GetRCenterReviwers($center_id);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="../js/jquery-ui/js/jquery-1.9.0.js" type="text/javascript"></script>
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
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
            function Display_Add_frm()
            {
                window.showModalDialog("AddEdit_Reviwers.php?Action=Insert", 'PopupPage', 'dialogHeight:430px; dialogWidth:895px; resizable:0');
                location.reload();
            }
            function Display_Update(person_id)
            {
                window.showModalDialog("AddEdit_Reviwers.php?person_id=" + person_id + "&Action=Update", 'PopupPage', 'dialogHeight:430px; dialogWidth:895px; resizable:0');
                location.reload();
            }
            function Delete(person_id)
            {
                if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
                {
                    $.ajax({
                        type: 'post',
                        url: 'inc/Del_Reviwers.inc.php?person_id=' + person_id,
                        datatype: "html",
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            }
            function DisplayAccount(person_id)
            {
                window.showModalDialog("Account.php?person_id=" + person_id + "&Rule=Reviewer", 'PopupPage', 'dialogHeight:340px; dialogWidth:650px; resizable:0');
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
            <input type="button" onclick="Display_Add_frm();" value="اضافة جديد" class="Button"/>
            <div class="art-layout-cell layout-item-1" style="width: 950px" >

                <table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold" dir="rtl" >
                    <thead>
                        <tr>
                            <th><em>م</em></th>
                            <th>الاسم</th>
                            <th>التخصص العام</th>
                            <th>التخصص الدقيق</th>
                            <th>الجوال</th>
                            <th>البريد الالكتروني</th>
                            <th>الحساب</th>
                            <th>تعديل</th>
                            <th>حذف</th>
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
                                <td><? echo $row['name']; ?></td>
                                <td style=" text-align: right"><? echo $row['Major_Field']; ?></td>
                                <td style=" text-align: right"><? echo $row['Speical_Field']; ?></td>
                                <td><? echo $row['Mobile']; ?></td>
                                <td><? echo $row['Email']; ?></td>
                                <td><a href="#" onClick="DisplayAccount(<? echo $row['Person_id']; ?>);"><img src="images/account.png" style="border:none !important" alt="انشاء حساب"/></a></td>     
                                <td><a href="#" onClick="Display_Update(<? echo $row['Person_id']; ?>);"><img src="images/edit.png" style="border:none !important" alt="تعديل"/></a></td>

                                <td><a href="#" onClick="Delete(<? echo $row['Person_id']; ?>);"><img src="images/delete.png" style="border:none !important" alt="حذف"/></a></td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

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