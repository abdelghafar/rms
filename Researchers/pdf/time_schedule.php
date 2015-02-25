<?php
$phases_no = 1;
$task_no = 3;
$month_no = 12;
$rows = $phases_no + $task_no + 2;
$cols = $month_no + 2;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            td .small
            {
                width: 50px;
                height: 50px; 
                background-color: #9999ff;
            }
            td .large
            {
                width: 100px;
                height: 50px; 
                background-color: #9999ff;
            }
        </style>
    </head>
    <body>
        <table border="1">
            <?
            for ($i = 0; $i < $rows; $i++) {
                $html = '<tr>';
                for ($j = 0; $j < $cols; $j++) {
                    $html.='<td class="large"></td>';
                }
                $html.= '</tr>';
                echo $html;
            }
            ?>
        </table>
    </body>
</html>
