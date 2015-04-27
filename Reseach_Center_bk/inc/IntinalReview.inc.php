<?php
session_start();
require_once '../../lib/research_review.php';
if (empty($_GET['id'])) {
    echo 'Parameter id is not set';
} else {
    $id = base64_decode(filter_input(INPUT_GET, 'id'), true);
    $obj = new Research_Review();
    $rs = $obj->GetResearchReviewers(1, 1);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../js/font/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../js/bootstrap/themes/bootstrap_cerulean.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#btnBack').click(function () {
                    return alert('btnBack is pressed....');
                });

                $('#btnRefresh').click(function () {
                    return alert('btnRefresh is pressed....');
                });

                $('#btnAddNew').click(function () {
                    return alert('btnAddNew is pressed....');
                });

            });
        </script>
    </head>
    <body>
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: right;">
                <h3>
                    الفحص المبدئي
                </h3>
            </div>
            <div class="panel-body">
                <div class="btn-group" style="margin-bottom: 10px;float: right;direction: ltr;">
                    <button id="btnBack" type="button" class="btn btn-default">
                        <span class="fa fa-arrow-left"></span>
                    </button>
                    <button id="btnRefresh" type="button" class="btn btn-default">
                        <span class="fa fa-refresh"></span>
                    </button>
                    <button id="btnAddNew" type="button" class="btn btn-default">
                        <span class="fa fa-plus-square"></span>
                    </button>
                </div> 
                <table id="grid" class="table table-bordered" style="text-align: right;font-size:14px;font-weight: bold;" dir="rtl">
                    <thead>
                    <td style="width: 150px;text-align: right;" class="active">
                        م
                    </td>
                    <td style="width: 250px;text-align: center;" class="active">
                        اسم المحكم
                    </td>
                    <td style="width: 150px;text-align: center;" class="active">
                        ت. الارسال
                    </td>
                    <td style="width: 150px;text-align: center;" class="active">
                        الرد
                    </td>
                    <td style="width: 150px;text-align: center;" class="active">
                        ت. الرد
                    </td>
                    <td style="width: 150px;text-align: center;" class="active">
                        التفاصيل
                    </td>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        while ($row = mysql_fetch_array($rs)) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $x;
                                    $x++;
                                    ?>
                                </td>
                                <td>
                                    <?
                                    echo $row['name_ar'];
                                    ?>
                                </td>
                                <td>
                                    <?
                                    echo $row['submission_date'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $row['Status_name'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $row['responce_date'];
                                    ?>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>


            </div>
        </div>

    </body>
</html>
