<?php
session_start();
require_once '../../lib/research_review.php';
if (empty($_GET['id'])) {
    echo 'Parameter id is not set';
} else {
    $id = base64_decode(filter_input(INPUT_GET, 'id'), true);
    $obj = new Research_Review();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: right;">
                <h3>
                    التحكيم
                </h3>
                <h4><?php echo $research_code; ?></h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered" style="text-align: right;font-size:12px;" dir="rtl">
                    <tr>
                        <td style="width: 150px;text-align: left;">
                            #
                        </td>
                        <td style="width: 150px;text-align: left;">
                            اسم المحكم
                        </td>
                        <td style="width: 150px;text-align: left;">
                            الرد
                        </td>
                        <td style="width: 150px;text-align: left;">
                            التفاصيل
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
