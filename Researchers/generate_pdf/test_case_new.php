<?php

/** * Created by PhpStorm. * User: Abdelghafar * Date: 11/04/15 * Time: 11:23 م */require_once '../../lib/person_name.php';
require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/objectives.php';
require_once '../../lib/projectPhases.php';
require_once '../../lib/Settings.php';
require_once '../../lib/budget_items.php';
require_once '../../lib/project_budget.php';
require_once '../../lib/objectives.php';
require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';

function get_project_phases($project_id) {
    $projectphases = new projectPhase();
    $phases_rs = $projectphases->GetProjectPhases($project_id);
    while ($phases_row = mysql_fetch_array($phases_rs, MYSQL_ASSOC)) {
        $phases_list[] = array('phase_id' => $phases_row['seq_id'], 'phase_name' => $phases_row['phase_name']);
    } return $phases_list;
}

$data = get_project_phases(47); 
// print colored table        
// $html_styles = '<style type="text/css">        
// .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}        
// .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}        
// .tg  {border-spacing:1;border-color:#999;margin:5px;}        
// .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}        .tg .tg-even{font-size:12px}        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}        .tg .en{font-family:Times New Roman;}    </style>';        
// $html = $html_styles . '<p class="ph1">' . 'Project phases' . '</p>';        
// $html .='<hr/><br/>';                     
//  $html = $html_styles . '<table class="tg" border="2" dir="ltr">                        
//  <thead>                    
//  <tr>                        
//  <th style="width: 30px; text-align:center">#</th>                        
//  <th style="width: 250px;" >Phase name</th>                        
//  <th style="width: 350px;" >Phase description</th>                                           
//  </tr>                
//  </thead>
//  <tbody>';        
//  $counter = 1;        $td_style = "tg-odd";        foreach ($data as $row) {                        if ($td_style == "tg-odd")                $td_style = "tg-even";            else                $td_style = "tg-odd";                        $html .= '<tr>';            $html .= '<td class="' . $td_style . '" style="text-align:center;">' . $counter++ . '</td>';            $html .= '<td class="' . $td_style . '" style="text-align:left;">' . $row['phase_name'] . '</td>';            $html .= '<td class="' . $td_style . '" style="text-align:left;">' . $row['phase_desc'] . '</td>';            $html .= '</tr>';        }        $html .= '</tbody></table>';        echo $html;