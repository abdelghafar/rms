<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Archive')
        header('Location:../Login.php');
}

require_once '../lib/Smarty/libs/Smarty.class.php';
require_once '../lib/doc_categories.php';
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
require_once '../lib/research_docs.php';
$doc = new Research_Documents();
$rs = $doc->GetAllDocuments();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/> 
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#datatables').dataTable({
                    sPaginationType: "full_numbers",
                    bJQueryUI: true,
                    bLengthChange: true,
                    width: 600,
                    oLanguage: {
                        sUrl: "../js/dataTables/media/ar_Ar.txt"}
                });
            });

        </script>
        <script type="text/javascript">
            function Display_Add_frm()
            {
                window.showModalDialog("AddEdit_Research_docs.php", 'PopupPage', 'dialogHeight:430px; dialogWidth:650px; resizable:0');
                location.reload();
            }
            function Delete(doc_cat_id)
            {
                if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
                {
                    $.ajax({
                        type: 'post',
                        url: 'inc/Del_Research_Doc.inc.php?seq_id=' + doc_cat_id,
                        datatype: "html",
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            }

        </script>
        <title></title>
    </head>

    <body style="background-color: #ededed;">
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    <?
                    echo 'مرحبا ' . $_SESSION['User_Name'];
                    ?>
                </label>
            </legend>
            <input type="button" onclick="Display_Add_frm();" value="اضافة جديد" class="Button"/>
            <table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold" dir="rtl" >
                <thead>
                    <tr>
                        <th><em>م</em></th>
                        <th>
                            رقم البحث
                        </th>
                        <th>
                            نوع المستند
                        </th>
                        <th>
                            ملاحظات
                        </th>
                        <th>
                            تحميل
                        </th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $x = 1;
                    while ($row = mysql_fetch_array($rs)) {
                        ?>
                        <tr>
                            <td style="width: 30px;"><?
                                echo $x;
                                $x++; //$row['id']; 
                                ?></td>
                            <td style=" text-align: right;"><? echo $row['research_code']; ?></td>
                            <td style=" text-align: right;"><? echo $row['cat_name']; ?></td>
                            <td><? echo $row['notes']; ?></td>
                            <td style=" text-align: center;width: 50px;">
                                <a href="<? echo 'upload/' . $row['doc_url']; ?>">
                                    <img style="border: 0;" src="../common/images/download.png"/>
                                </a>
                            </td>
                            <td  style="width: 50px;"><a href="#" onClick="Delete(<? echo $row['seq_id']; ?>);" ><img src="../common/images/delete.png" style="border:none !important" alt="حذف"/></a></td>

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

    </body>

</html>
<?
$smarty->display('../templates/footer.tpl');
?>
