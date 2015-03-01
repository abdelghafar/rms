<?php

echo '<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8" />';
//For each item_id in budget_items
//if (item_id) isSys = true Then
//For each item_id in the parent item
//determine the amount budget 
//End
require_once '../../lib/budget_items.php';
require_once '../../lib/project_budget.php';
$project_id = 1;
$budget_items = new budget_items();
$sysItems = $budget_items->GetSysItems();
$html.='<table border = "1" dir="rtl" style="width:760px;">
    <thead>
        <tr>
            <th style="width: 90px;">البند</th>
            <th>القيمة</th>
        </tr>
    </thead><tbody>';
$total_amount = 0;
while ($sysItem_row = mysql_fetch_array($sysItems)) {
    $parent_id = $sysItem_row['item_id'];
    $items = $budget_items->GetChildItems($parent_id);
    $items_total = 0;
    $html.='<tr><td colspan="2" style="background-color: #cccccc">' . $sysItem_row['item_title'] . '</td></tr>';
    while ($row = mysql_fetch_array($items)) {
        $item_id = $row['item_id'];
        $html.='<tr>' . '<td>' . $row['item_title'] . '</td>';
        $project_budget = new project_budget();
        $project_budget_items = $project_budget->GetProjectBudget($project_id, $item_id);
        if (mysql_num_rows($project_budget_items) != 0) {
            while ($project_item_row = mysql_fetch_array($project_budget_items)) {
                $amount = $project_item_row['amount'];
                $total_amount+= $amount;
                $items_total+=$amount;
                $html.='<td>' . number_format($amount, 2) . '</td>';
            }
            $html.='</tr>';
        } else {
            $html.='<td>' . number_format(0, 2) . '</td>';
        }
    }
    $html.='<tr>' . '<td>' . 'الاجمالي' . '</td>' . '<td>' . number_format($items_total, 2) . '</td>' . '</tr>';
}
$html.='<tr>' . '<td style="background-color: #cccccc">' . 'الاجمالي' . '</td>' . '<td style="background-color: #cccccc">' . number_format($total_amount, 2) . '</td>' . '</tr>';
echo $html;
