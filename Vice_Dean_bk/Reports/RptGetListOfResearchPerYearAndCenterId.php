<?php
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean')
        header('Location:../../Login.php');
}
require_once '../../lib/CenterResearch.php';
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if (strtolower($type) == 'all') {
        $c = new CenterResearch();
        $rs = $c->GetResearchesList();
    } else {
        $center_id = $type;
        $c = new CenterResearch();
        $rs = $c->GetResearchesListByCenterId($center_id);
    }
} else {
    $c = new CenterResearch();
    $rs = $c->GetResearchesList();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/dataTables/media/js/ZeroClipboard.js" type="text/javascript"></script>
        <script src="../../js/dataTables/Plugins/ColVis/js/dataTables.colVis.js" type="text/javascript"></script>
        <script src="../../js/dataTables/media/js/dataTables.tableTools.js" type="text/javascript"></script>

        <link rel="stylesheet" href="../../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css" >
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/demo_table_jui.css" >
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/dataTables.tableTools.css">
        <link rel="stylesheet" type="text/css" href="../../js/dataTables/Plugins/ColVis/css/dataTables.colvis.jqueryui.css" >

        <link rel="stylesheet" href="../../common/css/reigster-layout.css" type="text/css" /> 

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatables').dataTable({
                    sPaginationType: "full_numbers",
                    bJQueryUI: true,
                    bLengthChange: true,
                    width: 800,
                    sDom: '<"H"Tfl>t<"F"ip>',
                    oTableTools: {
                        sSwfPath: "../../js/dataTables/media/swf/copy_csv_xls_pdf.swf",
                        aButtons: ["copy", "xls", "print"]
                    },
                    oLanguage: {
                        sUrl: "../../js/dataTables/media/ar_Ar.txt"}
                });
            });

        </script>

    </head>
    <body>
        <table id="datatables" class="display" style=" text-align: center;font-size:14px; font-weight: bold" dir="rtl" >
            <thead>
                <tr>
                    <th><em>م</em></th>
                    <th>رقم البحث</th>
                    <th>عنوان المشروع </th>
                    <th>تاريخ الاستلام</th>
                    <th>المركز البحثي</th>
                    <th>الباحث الرئيسي</th>
                    <th>التخصص العام</th>
                    <th>التخصص الدقيق</th>
                    <th>الميزانية</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $x = 1;
                while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
                    ?>
                    <tr>
                        <td><?
                            echo $x;
                            $x++; //$row['id']; 
                            ?></td>
                        <td><? echo $row['research_code']; ?></td>
                        <td>
                            <?php
                            echo $row['title_ar'];
                            ?>
                        </td>
                        <td style=" text-align: right;"><? echo $row['status_date']; ?></td>
                        <td style=" text-align: right;"><? echo $row['center_name']; ?></td>
                        <td style=" text-align: right;"><? echo $row['name']; ?></td>
                        <td style=" text-align: right;"><? echo $row['major_field']; ?></td>
                        <td style=" text-align: right;"><? echo $row['special_field']; ?></td>
                        <td style=" text-align: right;"><? echo $row['budget']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
