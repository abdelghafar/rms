<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/objectives.php';
require_once '../../lib/projectPhases.php';
require_once '../../lib/Settings.php';
require_once '../../lib/budget_items.php';
require_once '../../lib/project_budget.php';
require_once '../../lib/objectives.php';
// FILES FOR MANPOWER DUSRATIONS
require_once '../../lib/research_stuff.php';
require_once '../../lib/project_budget_manpower.php';
require_once '../../lib/stuff_tasks.php';
require_once '../../lib/duration_units.php';
require_once '../../lib/projectPhases.php';
require_once '../../lib/program_goals.php';
require_once '../../lib/goals_outcomes.php';
require_once '../../lib/outcomes.php';

$project_id = 1;
$budget_items = new budget_items();
$sysItems = $budget_items->GetSysItems();
$html = '<style type="text/css">
        .tg  {border-spacing:0;border-color:#999;margin:0px auto;}
        .tg td{font-size:14px;padding:10px 5px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
        .tg .tg-uy9o{font-size:18px}
        .tg .tg-0bb8{font-weight:bold;font-size:18px;background-color:#0d516d}
        .tg .tg-lrt0{background-color:#D2E4FC;font-size:18px}
    </style>';
$html .= '<table border = "1" class="tg" dir="rtl" style="width:640px;">
    <thead>
        <tr>
            <th>البند</th>
            <th>القيمة بالريال السعودي</th>
        </tr>
    </thead><tbody>';
while ($sysItem_row = mysql_fetch_array($sysItems)) {
    $parent_id = $sysItem_row['item_id'];
    $items = $budget_items->GetChildItems($parent_id);
    $items_total = 0;
    $html.='<tr><td colspan="2" class="tg-lrt0">' . $sysItem_row['item_title'] . '</td></tr>';
    while ($row = mysql_fetch_array($items)) {
        $item_id = $row['item_id'];
        $html.='<tr>' . '<td class="tg-uy9o">' . $row['item_title'] . '</td>';
        $project_budget = new project_budget();
        $project_budget_items = $project_budget->GetProjectBudget($project_id, $item_id);
        if (mysql_num_rows($project_budget_items) != 0) {
            while ($project_item_row = mysql_fetch_array($project_budget_items)) {
                $amount = $project_item_row['amount'];
                $total_amount+= $amount;
                $items_total+=$amount;
                $html.='<td>' . number_format($amount, 2) . '</td>';
            }
        } else {
            $html.='<td>' . number_format(0, 2) . '</td>';
        }
        $html.='</tr>';
    }
    $html.='<tr>' . '<td>' . 'الاجمالي' . '</td>' . '<td>' . number_format($items_total, 2) . '</td>' . '</tr>';
}
echo $html;
