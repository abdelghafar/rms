<?php
session_start();
$id = filter_input(INPUT_GET, 'id');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jqwidgets/scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
        <link href="../js/jquery-ui/css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-ui/js/jquery-1.9.0.js" type="text/javascript"></script>
        <link href="../js/bootstrap/themes/bootstrap_cerulean.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/dataTables/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">

        <script type="text/javascript">
            $(document).ready(function () {
                $('.nav li a').click(function (e) {
                    $('.nav li').removeClass('active');
                    var $parent = $(this).parent();
                    if (!$parent.hasClass('active')) {
                        $parent.addClass('active');
                    }
                    e.preventDefault();
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#content').load('inc/details.inc.php?id=' + '<?php echo ($id); ?>');
            });
            $(document).ready(function () {
                $('#call1').click(function () {
                    $('#content').load('inc/details.inc.php?id=' + '<?php echo ($id); ?>');
                });
                $('#call2').click(function () {
                    $('#content').load('inc/IntinalReview.inc.php?id=' + '<?php echo ($id); ?>');
                });
                $('#call3').click(function () {
                    $('#content').load('inc/Reviewers.inc.php?id=' + '<?php echo ($id); ?>');
                });
            });
        </script>
        <title></title>
    </head>
    <body>
    <center>
        <div id="menu" style="width: 900px;height: auto;direction: rtl;padding-bottom: 50px;">
            <ul class="nav nav-pills" id="nav-pills" style="float: right;cursor: pointer;padding-right: 0px;">
                <li><a id="call3">التحكيم</a></li>
                <li><a id="call2">الفحص المبدئي</a></li>
                <li class="active"><a id="call1">التفاصيل</a></li>
            </ul>
        </div>
        <div id="content" style="width: 900px;height: 500px;alignment-baseline: central;margin-top: 10px;"></div>

    </center>
</body>
</html>
