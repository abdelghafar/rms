<?
session_start();
require_once '../../lib/technologies.php';
require_once '../../lib/users.php';
$users = new Users();
$userId = $_SESSION['User_Id'];
$obj = new Technologies();
$rs = $obj->GetAllTechnologies();
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
        <table id="datatables" class="display"  style=" text-align: center;font-size:14px; font-weight: bold;" dir="rtl" >
            <thead>
                <tr>
                    <th><em>م</em></th>
                    <th>
                        الاولوية
                    </th>
                    <th>
                        التوصيف
                    </th>
                    <th>
                        متاحة/غير متاحة
                    </th>
                    <th>
                        الترتيب
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
                        <td style=" text-align: right;"><? echo $row['desc']; ?></td>
                        <td style=" text-align: right;">
                            <?
                            if ($row['isVisible'] == 1) {
                                echo '<input type="checkbox" name="" value="ON" checked="checked" disabled="disabled" />';
                            } elseif ($row['isVisible'] == 0) {
                                echo '<input type="checkbox" name="" value="ON" disabled="disabled" />';
                            }
                            ?>
                        </td>
                        <td style=" text-align: right;"><? echo $row['ordering']; ?></td>
                        <td style=" text-align: center;"><a href="#" onClick="Delete(<? echo $row['seq_id']; ?>);"><img src="images/delete.png" style="border:none !important" alt="حذف"/></a></td>

                    </tr>
                    <?php
                }
                ?>

            </tbody>

        </table>


    </body>
</html>
