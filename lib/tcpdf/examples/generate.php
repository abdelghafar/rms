<?php
require_once '../../../lib/objectives.php';
$obj = new Objectives();
$rs = $obj->GetObjectivies(1);
$obj_counter = 1;
echo 'أهداف المشروع' . '<br/>';

echo '<table border="1" style="width:800px;direction:rtl;">';
echo '<thead><tr><th>م</th><th>الهدف</th></tr></thead>';

while ($row = mysql_fetch_array($rs)) {
    echo '<tr>';
    echo '<td>' . $obj_counter . '</td>';
    echo '<td>' . $row['obj_title'] . '</td>';
    echo '</tr>';
    $obj_counter++;
}
echo '</table>';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

    </body>
</html>
