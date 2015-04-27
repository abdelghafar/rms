<?
session_start();
require_once '../../lib/Reseaches.php';
require_once('../../lib/CenterResearch.php');
require_once '../../lib/research_docs.php';
require_once '../../lib/research_Authors.php';
require_once '../../lib/users.php';
$users = new Users();
$userId = $_SESSION['User_Id'];
$personId = $users->GetPerosnId($userId, 'Researcher');
$research_id = $_GET['research_id'];
$obj = new Research_Documents();
$rs = $obj->GetResearchListDocuments($research_id);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatables').dataTable({
                sPaginationType: "full_numbers",
                bJQueryUI: true,
                bLengthChange: true,
                width: 400,
                oLanguage: {
                    sUrl: "../js/dataTables/media/ar_Ar.txt"}
            });
        });</script>
</head>
<body>
<table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold;" dir="rtl">
    <thead>
    <tr>
        <th><em>م</em></th>
        <th>
            عنوان المستند
        </th>
        <th>
            نوع المستند
        </th>
        <th>
            تحميل
        </th>
        <th>
            حذف
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
            <td style=" text-align: right;"><? echo $row['title']; ?></td>
            <td style=" text-align: right;"><? echo $row['cat_name']; ?></td>
            <td style=" text-align: right;"><? echo '<a href="../' . $row['doc_url'] . '">' . 'تحميل' . '</a>'; ?></td>

            <td style=" text-align: center;"><a href="#" onClick="Delete(<? echo $row['seq_id']; ?>);"><img
                        src="images/delete.png" style="border:none !important" alt="تعديل"/></a></td>

        </tr>
    <?php
    }
    ?>

    </tbody>

</table>

</body>
</html>
