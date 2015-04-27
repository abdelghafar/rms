<?
session_start();

require_once('../lib/CenterResearch.php');
require_once '../lib/Reseaches.php';

$research_code = $_GET['research_code'];
$c = new Reseaches();
$research_id = $c->GetResearchId($research_code);
$cr = new CenterResearch();
$rs = $cr->getResearchAllStatus($research_id);
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../common/css/reigster-layout.css" type="text/css"/> 
    <script type="text/javascript" src="../jquery.js"></script>
    <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#datatables').dataTable({width: 500, bJQueryUI: true, oLanguage: {
                    sUrl: "../js/dataTables/media/ar_Ar.txt"}});
        });

    </script>

</head>

<body style="background-color: #ededed;">

    <div class="panel_row" style="padding-bottom: 10px;">
        <div class="panel-cell" style="width: 80px;text-align: left;padding-left: 10px;"> 
            <p>
                رقم المشروع
            </p>
        </div>
        <div class="panel-cell" style="width: 450px;height: 30px;"> 
            <label style="font-weight: bold;">
                <?php echo $research_code; ?>
            </label>
        </div>
    </div>
    <table id="datatables" class="display" dir="rtl" style="text-align: center;font-size:14px; font-weight: bold" >
        <thead>
            <tr>
                <th><em>م</em></th>
                <th>حالة البحث</th>
                <th>التاريخ</th>
                <th>ملاحظات </th>
            </tr>
        </thead>
        <tbody>

            <?php
            $x = 1;

            while ($row = mysql_fetch_array($rs)) {
                ?>

                <tr style="text-align: center;" >

                    <td><?
                        echo $x;
                        $x++; //$row['id']; 
                        ?></td>

                    <td><? echo $row['Status_name']; ?></td>

                    <td><? echo $row['track_date']; ?></td>

                    <td><? echo $row['notes']; ?></td>

                </tr>

                <?php
            }
            ?>

        </tbody>

    </table>
</body>