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

$obj = new Document_categories();
$rs = $obj->GetList();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
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
                $(".Button").jqxButton({width: '100px', height: '30px', theme: 'energyblue', rtl: true});
            });</script>
        <script type="text/javascript">
            function Display_Update_frm(doc_cat_id)
            {
                window.showModalDialog("AddEdit_doc_Categories.php?doc_cat_id=" + doc_cat_id, 'PopupPage', 'dialogHeight:250px; dialogWidth:450px; resizable:0');
                location.reload();
            }

            function Display_Add_frm()
            {
                window.showModalDialog("AddEdit_doc_Categories.php", 'PopupPage', 'dialogHeight:250px; dialogWidth:450px; resizable:0');
                location.reload();
            }
            function Delete(doc_cat_id)
            {
                if (confirm('هل انت متأكد من اتمام عملية الحذف؟ ') === true)
                {
                    $.ajax({
                        type: 'post',
                        url: 'inc/Del_doc_Categories.inc.php?seq_id=' + doc_cat_id,
                        datatype: "html",
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            }

        </script>
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
            <input type="button" onclick="Display_Add_frm();" value="اضافة جديد" class="Button"/> 

            <table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold" dir="rtl" >
                <thead>
                    <tr>
                        <th><em>م</em></th>
                        <th>اسم الفئة</th>
                        <th>ملاحظات</th>
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
                            <td  style="width: 50px;"><?
                                echo $x;
                                $x++; //$row['id']; 
                                ?></td>
                            <td><? echo $row['cat_name']; ?></td>
                            <td style=" text-align: right"><? echo $row['notes']; ?></td>
                            <td style="width: 50px;"><a href="#" onClick="Display_Update_frm(<? echo $row['seq_id']; ?>);"><img src="images/edit.png" style="border:none !important" alt="تعديل"/></a></td>
                            <td  style="width: 50px;"><a href="#" onClick="Delete(<? echo $row['seq_id']; ?>);" ><img src="images/delete.png" style="border:none !important" alt="حذف"/></a></td>
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
