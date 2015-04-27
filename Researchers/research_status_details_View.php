<?
session_start();

require_once('../lib/CenterResearch.php');

$research_id = $_GET['research_id'];
$cr = new CenterResearch();
$rs = $cr->getResearchAllStatus($research_id);
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="css/reigster-layout.css" type="text/css"/>
    <title></title>
    <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
    <script type="text/javascript">
        $(document).ready(function () {
            $('#grid').dataTable({
                sPaginationType: "full_numbers",
                bJQueryUI: true,
                bLengthChange: true,
                width: 500,
                oLanguage: {
                    sUrl: "../js/dataTables/media/ar_Ar.txt"}
            });
        });

    </script>

</head>

<body style="background-color: #ededed;">
<table id="grid" class="display" dir="rtl" style="text-align: center;font-size:14px; font-weight: bold;">
    <thead>
    <tr>
        <th><em>م</em></th>
        <th>حالة البحث</th>
        <th>التاريخ</th>
        <th>ملاحظات</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $x = 1;

    while ($row = mysql_fetch_array($rs)) {
        ?>

        <tr style="text-align: center;">

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