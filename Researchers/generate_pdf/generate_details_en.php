<?php

ini_set("memory_limit", "128M");

// Include the main TCPDF library (search for installation path).
require_once('../../lib/tcpdf/tcpdf.php');
require_once 'pdf_proposal.php';
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
require_once '../../lib/person_name.php';

// extend TCPF with custom functions

function GetRsearchDetails($research_id) {
    $obj = new Reseaches();
    $rs = $obj->GetResearchDetailsMin($research_id);
    $array = array();
    while ($row = mysql_fetch_array($rs)) {
        $array = array('title_ar' => $row['title_ar'],
            'title_en' => $row['title_en'],
            'tech_title' => $row['tech_title'],
            'track_title' => $row['track_name'],
            'subTrack_title' => $row['subTrack_name'],
            'name_ar' => $row['name_ar'],
            'name_en' => $row['name_en'],
            'duration' => $row['proposed_duration']);
    }
    return $array;
}

function GetResearchIntro($research_id) {
    $r = new Reseaches();
    return $r->GetIntroductionText($research_id);
}

function GetResearchAbstractAr($research_id) {
    $r = new Reseaches();
    return $r->GetAbstractArText($research_id);
}

function GetResearchAbstractEng($research_id) {
    $r = new Reseaches();
    return $r->GetAbstractEnText($research_id);
}

function GetResearchReview($research_id) {
    $r = new Reseaches();
    return $r->GetLiteratureReviewText($research_id);
}

function GetResearchValue($research_id) {
    $r = new Reseaches();
    return $r->GetValueToKingdomText($research_id);
}

class PDF extends TCPDF {

// Colored table
    public function GetCurrRound() {
        $obj = new Settings();
        return $obj->GetCurrRound();
    }

    public function PhasesTable($data) {

        $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-spacing:1;border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-size:12px}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
        .tg .en{font-family:Times New Roman;}
    </style>';

        $html = $html_styles . '<p class="ph1">' . 'Project phases' . '</p>';
        $html .='<hr/><br/>';

        $this->writeHTML($html, true, 0, true, 0);

        $this->SetFont('aealarabiya', '', 12);

        $html = $html_styles . '<table class="tg" border="2" dir="ltr">
        
                <thead>
                    <tr>
                        <th style="width: 30px; text-align:center">#</th>
                        <th style="width: 250px;" >Phase name</th>
                        <th style="width: 350px;" >Phase description</th>
                    </tr>
                </thead><tbody>';

        $counter = 1;

        $td_style = "tg-odd";

        foreach ($data as $row) {

            if ($td_style == "tg-odd")
                $td_style = "tg-even";
            else
                $td_style = "tg-odd";

            $this->SetFont('aealarabiya', '', 10);
            $html .= '<tr>';
            $html .= '<td class="' . $td_style . '" style="width: 30px;text-align:center;">' . $counter++ . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 250px;text-align:left;">' . $row['phase_name'] . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 350px;text-align:left;">' . $row['phase_desc'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        $this->writeHTMLCell(0, 0, '', '', $html, '', 1, 0, true, 'R', true);
    }

//=============================================================================================
    public function ObjectivesTable($data) {

        $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-spacing:1;border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-size:12px}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
        .tg .en{font-family:Times New Roman;}
    </style>';

        $html = $html_styles . '<p class="ph1">' . 'Project objectives' . '</p>';
        $html .='<hr/><br/>';

        $this->writeHTML($html, true, 0, true, 0);

        $this->SetFont('aealarabiya', '', 12);

        $html = $html_styles . '<table class="tg" border="2" dir="ltr">
        
                <thead>
                    <tr>
                        <th style="width: 50px; text-align:center">#</th>
                        <th style="width: 580px;" >Objective</th>
                    </tr>
                </thead><tbody>';

        $counter = 1;

        $td_style = "tg-odd";

        foreach ($data as $row) {

            if ($td_style == "tg-odd")
                $td_style = "tg-even";
            else
                $td_style = "tg-odd";

            $this->SetFont('aealarabiya', '', 10);
            $html .= '<tr>';
            $html .= '<td class="' . $td_style . '" style="width: 50px;text-align:center;">' . $counter++ . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 580px;text-align:left;">' . $row['obj_title'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        $this->writeHTMLCell(0, 0, '', '', $html, '', 1, 0, true, 'R', true);
    }

    public function ObjectivesApproachTable($data) {

        $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-spacing:1;border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-size:12px}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
        .tg .en{font-family:Times New Roman;}
    </style>';

        $html = $html_styles . '<p class="ph1">' . 'Approach utilized for achieving objectives' . '</p>';
        $html .='<hr/><br/>';

        $this->writeHTML($html, true, 0, true, 0);

        $this->SetFont('aealarabiya', '', 12);

        $html = $html_styles . '<table class="tg" border="2" dir="ltr">
        
                <thead>
                    <tr>
                        <th style="width: 50px; text-align:center">#</th>
                        <th style="width: 260px;" >Objective</th>
                        <th style="width: 320px;" >Approach of achieving the objective</th>
                    </tr>
                </thead><tbody>';

        $counter = 1;

        $td_style = "tg-odd";

        foreach ($data as $row) {

            if ($td_style == "tg-odd")
                $td_style = "tg-even";
            else
                $td_style = "tg-odd";

            $this->SetFont('aealarabiya', '', 10);
            $html .= '<tr>';
            $html .= '<td class="' . $td_style . '" style="width: 50px;text-align:center;">' . $counter++ . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 260px;text-align:left;">' . $row['obj_title'] . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 320px;text-align:left;">' . $row['obj_desc'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        $this->writeHTMLCell(0, 0, '', '', $html, '', 1, 0, true, 'R', true);
    }

    public function ObjectivesTasksTable($data) {

        $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-spacing:1;border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-size:12px}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
        .tg .en{font-family:Times New Roman;}
    </style>';

        $html = $html_styles . '<p class="ph1">' . 'Mapping of phases and tasks to achieve objectives' . '</p>';
        $html .='<hr/><br/>';

        $this->writeHTML($html, true, 0, true, 0);

        $this->SetFont('aealarabiya', '', 12);

        $html = $html_styles . '<table class="tg" border="2" dir="ltr">
        
                <thead>
                    <tr>
                        <th style="width: 30px; text-align:center">#</th>
                        <th style="width: 200px;" >Objectives</th>
                        <th style="width: 200px;" >Phases</th>
                        <th style="width: 200px;" >Tasks</th>
                    </tr>
                </thead><tbody>';

        $counter = 1;

        $td_style = "tg-odd";

        foreach ($data as $row) {

            if ($td_style == "tg-odd")
                $td_style = "tg-even";
            else
                $td_style = "tg-odd";

            $this->SetFont('aealarabiya', '', 10);
            $html .= '<tr>';
            $html .= '<td class="' . $td_style . '" style="width: 30px;text-align:center;">' . $counter++ . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 200px;text-align:left;">' . $row['objective_name'] . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 200px;text-align:left;">' . $row['phase_name'] . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 200px;text-align:left;">' . $row['task_name'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        $this->writeHTMLCell(0, 0, '', '', $html, '', 1, 0, true, 'R', true);
    }

    public function ManpowerDurationTable($data) {
        $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-spacing:1;border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-size:12px}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
        .tg .en{font-family:Times New Roman;}
    </style>';

        $html = $html_styles . '<p class="ph1">' . 'Role and involvement duration of project team' . '</p>';
        $html .='<hr/><br/>';

        $this->writeHTML($html, true, 0, true, 0);

        $this->SetFont('aealarabiya', '', 12);

        $html = $html_styles . '<table class="tg" border="2" dir="ltr">
        
                <thead>
                    <tr>
                        <th style="width: 30px; text-align:center">#</th>
                        <th style="width: 400px;" >Team members - Roles</th>
                        <th style="width: 200px;" >Duration</th>
                    </tr>
                </thead><tbody>';

        $counter = 1;

        $td_style = "tg-odd";

        foreach ($data as $row) {

            if ($td_style == "tg-odd")
                $td_style = "tg-even";
            else
                $td_style = "tg-odd";

            $this->SetFont('aealarabiya', '', 10);
            $html .= '<tr>';
            $html .= '<td class="' . $td_style . '" style="width: 30px;text-align:center;">' . $counter++ . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 400px;text-align:left;">' . $row['role_person_en'] . '</td>';
            $html .= '<td class="' . $td_style . '" style="width: 200px;text-align:left;">' . $row['duration'] . ' ' . $row['duration_unit_en'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        $this->writeHTMLCell(0, 0, '', '', $html, '', 1, 0, true, 'R', true);
    }

    public function WorkPlanTable($project_id, $data, $duration) {
        $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-spacing:1;border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-size:12px}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
        .tg .en{font-family:Times New Roman;}
    </style>';

        $html = $html_styles . '<p class="ph1">' . 'Work plan and time schedule' . '</p>';
        $html .='<hr/><br/>';

        $this->writeHTML($html, true, 0, true, 0);

        $html = '
            <table border = "1" bordercolor = "#d9e4e6" rules = "cols" frame = "avoid" style = "border-collapse: collapse;">
<tr style = "background-color: #4bacc6;color: white;" height = "50px" valign = "middle">
<th rowspan = "2" align = "center" width = "100" style = "font-family:Times New Roman;font-size:12;font-weight:bold;border-left-color:black;border-right-color:black;vertical-align: middle;">
Phases & <br> Tasks
</th>
<th rowspan = "2" align = "center" width = "170" style = "font-family:Times New Roman;font-size:12;font-weight:bold;border-right-color:black; border-left-color: 2px black; vertical-align: middle !important">
Involvement
</th>
<th colspan = "' . $duration . '" align = "center" width = "360" style = "font-family:Times New Roman;font-size:12;font-weight:bold;border-color:black;border-bottom-color:black;vertical-align: middle">Duration</th>
</tr>
<tr style = "background-color: #4bacc6;color: white;" height = "50px" valign = "middle">';
        $cell_width = 360 / $duration;
        for ($i = 1; $i <= $duration; $i++) {
            $html = $html . '<th width = "' . $cell_width . '" style="text-align: center ;font-family:Times New Roman;font-size:6;">' . $i . '</th>';
        }
        $html = $html . '</tr>';

        //$seq_no = 1;
        //print_r($data);
        foreach ($data as $row) {
            $html = $html . '
                <tr bgcolor = "#b6dde8" style = "color: black;">
                <td align = "left" style="font-size:10;">' . $row['phase_name'] . '</td>
                <td align = "left" style=";font-family:Times New Roman;font-size:12;font-weight:bold;">Name---Role</td>';
            for ($i = 1; $i <= $duration; $i++) {
                $html = $html . '<td align = "right"></td>';
            }
            $html = $html . '</tr>';
            //echo "sssssssss". $row['phase_id'];

            $stuf_task_data = get_project_work_plan($project_id, $row['phase_id'], $duration);
            //print_r($stuf_task_data);
            foreach ($stuf_task_data as $stuf_task_row) {
                $html = $html . '
                    <tr bgcolor = "#ffffff" style = "color: black;">
                    <td align = "left" style="font-size:10;">' . $stuf_task_row['task_name'] . '</td>
                    <td align = "left" style="font-family:Times New Roman;font-size:9;">' . $stuf_task_row['person_role_en'] . '</td>';
                for ($i = 1; $i <= $duration; $i++) {
                    $field_name = 'm_' . $i;
                    //echo $stuf_task_row[$field_name];
                    if ($stuf_task_row[$field_name] == 1)
                        $html = $html . '<td align = "right" bgcolor = "#1ea731"></td>';
                    else
                        $html = $html . '<td align = "right"></td>';
                }
                $html = $html . '</tr>';
            }
        }
        $html = $html . '</table>';
        $this->writeHTMLCell(0, 0, '', '', $html, '', 1, 0, true, 'R', true);
    }

    public function GoalsFrameworkTable($project_id) {
        $goals = new ProgramGoals();
        $program_id = $goals->GetprojectProgram($project_id);

        $goals_rs = $goals->GetProgramGoals($program_id);
        $goals_total = mysql_num_rows($goals_rs);
        $goals_array = array();
        for ($i = 1; $i <= $goals_total; $i++) {
            $goals_row = mysql_fetch_array($goals_rs, MYSQL_ASSOC);
            $goals_array[$i] = $goals_row['seq_id'];
        }
        //print_r($goals_array);
        //echo 'goals_total = '. $goals_total;
        $outcomes = new Outcomes();
        $outcomes_rs = $outcomes->GetProjectOutcomes($project_id);

        $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-spacing:1;border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-size:12px}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
        .tg .en{font-family:Times New Roman;}
    </style>';

        $html = $html_styles . '<p class="ph1">' . 'Relationship to strategic framework' . '</p>';
        $html .='<hr/><br/>';

        $this->writeHTML($html, true, 0, true, 0);

        $html = '<table border = "1" bordercolor = "#d9e4e6" rules = "cols" frame = "avoid" style = "border-collapse: collapse;">
<tr style = "background-color: #4bacc6;color: white;" height = "50px" valign = "middle">
<th rowspan = "2" align = "left" width = "100" style = "font-family:Times New Roman;font-size:10;font-weight:bold;border-left-color:black;border-right-color:black;vertical-align: middle;">
Project expected outcomes</th>
<th rowspan = "2" align = "center" width = "170" style = "font-family:Times New Roman;font-size:12;font-weight:bold;border-left-color:black;border-right-color:black;vertical-align: middle;">
Project objectives achieved </th>
<th colspan = "' . $goals_total . '" align = "center" width = "360" style = "font-family:Times New Roman;font-size:12;font-weight:bold;border-left-color:black;border-right-color:black;vertical-align: middle;">
   Strategic program goals</th>
</tr>
<tr style = "background-color: #4bacc6;color: white;" height = "50px" valign = "middle">';
        $cell_width = 360 / $goals_total;
        for ($i = 1; $i <= $goals_total; $i++) {
            $html = $html . '<th align = "center" width = "' . $cell_width . '" style = "font-family:Times New Roman;font-size:9;font-weight:bold;" >
                Goal ' . $i . '</th>';
        }
        //print_r($goals_array);
        $html = $html . '</tr>';
        $objectives = new GoalsOutcomes();
        $oogoals = new GoalsOutcomes(); // all Goals of specific outcome,objective 
        //$seq_no = 1;
        //print_r($data);
        While ($outcomes_row = mysql_fetch_array($outcomes_rs, MYSQL_ASSOC)) {
            $objectives_rs = $objectives->GetOutcomeObjectives($outcomes_row['seq_id']);
            $objectives_total = mysql_num_rows($objectives_rs);
            $obj_no = 0;
            //echo '<br> outcome = '. $outcomes_row['seq_id'];

            $row_bg == "#e0ebff";

            $html = $html . '
            <tr bgcolor = "#ffffff" style = "color: black;">
            
            <td bgcolor = "' . $row_bg . '" align = "left" rowspan = "' . $objectives_total . '">' . $outcomes_row['outcome_title'] . '</td>';
            $objectives_row = mysql_fetch_array($objectives_rs, MYSQL_ASSOC);
            do {
                if ($row_bg == "#e0ebff")
                    $row_bg = "#ffffff";
                else
                    $row_bg = "#e0ebff";

                $obj_no++;
                $html = $html . '
                <td bgcolor = "' . $row_bg . '" align = "left" >' . $objectives_row['obj_title'] . '</td>';
                //echo ' obj = '. $objectives_row['seq_id'];
                $oogoals_rs = $oogoals->GetOutcomeObjectivesAllGoals($outcomes_row['seq_id'], $objectives_row['seq_id']);
                $oogoals_total = mysql_num_rows($oogoals_rs);

                //echo ' oogoals_total = '. $oogoals_total;

                $end_goal = 1;
                while ($oogoals_row = mysql_fetch_array($oogoals_rs, MYSQL_ASSOC)) {
                    // echo ' end_goal = '.$end_goal;
                    // echo ' goal_id = '. $oogoals_row['goal_id'];

                    for ($x = $end_goal; $x <= $goals_total; $x++) {
                        // echo "  goal_array[]=  ". $goals_array[$x];
                        if ($oogoals_row['goal_id'] == $goals_array[$x]) {
                            $html = $html . '<td align = "center" bgcolor = "#00bf00"> Y </td>';
                            $end_goal = $x + 1;
                            // echo " true ";
                            break;
                        } else {
                            $html = $html . '<td align = "center" bgcolor = "white"></td>';
                            //echo "false";
                        }
                    }
                }
                for ($x = $endgoal; $x <= $goals_total; $x++) {
                    $html = $html . '<td align = "center"></td>';
                }
                $end_goal = 1;
                $html = $html . '</tr>';
                if ($obj_no < $objectives_total)
                    $html = $html . '<tr bgcolor = "white" style = "color: black;">';
            } while ($objectives_row = mysql_fetch_array($objectives_rs, MYSQL_ASSOC));
        }

        $html = $html . '</table>';
        $this->writeHTMLCell(0, 0, '', '', $html, '', 1, 0, true, 'R', true);
    }

    public function GoalsTable($data) {


        $html = '<br> <br> <table border = "1" bordercolor = "#d9e4e6" rules = "cols" frame = "avoid" style = "border-collapse: collapse;">
<tr style = "background-color: #4bacc6;color: white;" height = "50px" valign = "middle">
<th align = "center" width = "50" style = "border-color:black">#</th>
<th align = "center" width = "580">Strategic program goals</th>
</tr>
';
        $seq_no = 1;
        foreach ($data as $row) {
            $html = $html . '
<tr bgcolor = "' . $row_bg . '" style = "color: black;">
<td align = "center" style="font-family: Times New Roman; font-size:12">' . number_format($seq_no) . '</td>
<td align = "left" style="font-family: Times New Roman; font-size:12">' . $row['goal_title_en'] . '</td>';

            $html = $html . '</tr>';
            if ($row_bg == "#e0ebff")
                $row_bg = "#ffffff";
            else
                $row_bg = "#e0ebff";
            ++$seq_no;
        }

        $html = $html . '</table>';
        $this->writeHTMLCell(0, 0, '', '', $html, '', 1, 0, true, 'R', true);
    }

}

if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    // create new PDF document
    $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $details = GetRsearchDetails($project_id);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('المقترح البحثى');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 011', PDF_HEADER_STRING);
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language dependent data:
    $lg = Array();
    $lg['a_meta_charset'] = 'UTF-8';
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = 'page';
// set some language-dependent strings (optional)
    $pdf->setLanguageArray($lg);
    $pdf->setPrintFooter(false);
    $pdf->SetFont('aealarabiya', '', 16);
    //new page 
    //Abdo code
    //// ---------------------------------------------------------
//  ====================================== Project PHASES
    $pdf->AddPage();
    $pdf->setRTL(false);
    $pdf->SetFont('aealarabiya', '', 14);
    $obj_data = get_project_phases($project_id);
// print colored table
    $pdf->PhasesTable($obj_data);
// ---------------------------------------------------------
//  ====================================== Project OBJECTIVES List
    $pdf->AddPage();
    $pdf->setRTL(false);
    $pdf->SetFont('aealarabiya', '', 14);
    $obj_data = get_project_objectives($project_id);
// print colored table
    $pdf->ObjectivesTable($obj_data);
// ---------------------------------------------------------
//  ====================================== Project APPROACH UTILIZED FOR ACHIEVING OBJECTIVES List
    $pdf->AddPage();
    $pdf->setRTL(false);
    $pdf->SetFont('aealarabiya', '', 14);
    //$pdf->SetFont('freeserif', '', 10);

    $obj_data = get_project_objectives($project_id);
// print colored table
    $pdf->ObjectivesApproachTable($obj_data);
//-----------------------------------------------------------------------------
//  ====================================== MAPPING OF PHASES AND TASKS TO ACHIEVE OBJECTIVES

    $pdf->AddPage();
    $pdf->setRTL(false);
    $pdf->SetFont('aealarabiya', '', 14);
    //$pdf->SetFont('freeserif', '', 10);
// column titles
    $header = array('الهدف', 'المرحلة', 'المهمة');

    $obj_data = get_project_objectives_tasks($project_id);
// print colored table
    $pdf->ObjectivesTasksTable($obj_data);
//-----------------------------------------------------------
//  ======================================  ROLE AND INVOLVEMENT DURATION OF PROJECT TEAM

    $pdf->AddPage();
    $pdf->setRTL(false);
    $pdf->SetFont('aealarabiya', '', 14);
    //$pdf->SetFont('freeserif', '', 10);
// column titles
    $obj_data = get_project_manpower_durations($project_id);
// print colored table
    $pdf->ManpowerDurationTable($obj_data);
//-----------------------------------------------------------
//
//  ======================================  WORK PLAN AND TIME SCHEDUAL

    $pdf->AddPage();
    $pdf->setRTL(false);
    $pdf->SetFont('aealarabiya', '', 14);
    //$pdf->SetFont('freeserif', '', 10);
// column titles
    $project = new research_stuff();
    $project_durations_rs = $project->GetProjectDuration($project_id);
    $project_durations_row = mysql_fetch_array($project_durations_rs, MYSQL_ASSOC);
    $duration = $project_durations_row['proposed_duration'];

    $obj_data = get_project_phases($project_id, $duration);

// print colored table
    $pdf->WorkPlanTable($project_id, $obj_data, $duration);


// ---------------------------------------------------------
// 
//  ======================================  RELATIONSHIP TO STRATEGIC FRAMEWORK

    $pdf->AddPage();
    $pdf->setRTL(false);
    $pdf->SetFont('aealarabiya', '', 14);
    //$pdf->SetFont('freeserif', '', 10);
    $pdf->GoalsFrameworkTable($project_id);

    //$pdf->SetFont('freeserif', '', 10);
    $obj_data = get_program_goals($project_id);
    $pdf->GoalsTable($obj_data);
    //End of adduo code 
    //
//  ======================================  PROJECT BUDGET ===============================
    $pdf->AddPage();
    $budget_items = new budget_items();
    $sysItems = $budget_items->GetSysItems();


    $html = '<p style="text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;">' . 'Proposed budget (in Saudi Riyals)' . '</p>';
    $html .='<hr/>';

    $html .= '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-family:Times New Roman;font-size:12px; font-weight:bold}
        .tg .tg-odd{font-family:Times New Roman; background-color:#D2E4FC;font-size:12px; font-weight:bold}
        .tg .en{font-family:Times New Roman;}
                   .tg .tg-cat-total{font-family:Times New Roman;
                                font-weight:bold;
                                font-size:14px;
                                background-color:#ffffff;
                                height : 20px !important;
                                vertical-align: middle}
                   
                   .tg .tg-grand-total{font-family:Times New Roman;
                                font-weight:bold;
                                font-size:16px;
                                background-color:#D2E4FC;
                                border-bottom-style: double;
                                border-top-style: double;
                                height : 30px !important;
                                vertical-align: middle}
                   
                </style>';
    $html .= '<br/><table border = "1" class = "tg" dir = "ltr" style = "width:640px;">
<thead>
<tr>
<th>Item</th>
<th>Total (in Saudi Riyals)</th>
</tr>
</thead><tbody>';

    $total_amount = 0;
    while ($sysItem_row = mysql_fetch_array($sysItems)) {
        $parent_id = $sysItem_row['item_id'];
        $items = $budget_items->GetChildItems($parent_id);
        $items_total = 0;
        $html.='<tr><td colspan = "2" class = "tg-odd">' . $sysItem_row['item_title_en'] . '</td></tr>';
        while ($row = mysql_fetch_array($items)) {
            $item_id = $row['item_id'];
            $html.='<tr>' . '<td class = "tg-even">' . $row['item_title_en'] . '</td>';
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
        $html.='<tr>' . '<td class = "tg-cat-total">' . '     Item total' . '</td>' . '<td class = "tg-cat-total">' . number_format($items_total, 2) . '</td>' . '</tr>';
    }
    $html.='<tr>' . '<td class = "tg-grand-total">' . '      Project total' . '</td>' . '<td class = "tg-grand-total">' . number_format($total_amount, 2) . '</td>' . '</tr>';
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, 0, true, 0);


    // close and output PDF document

    $base_dir = '../../uploads/' . $project_id . "/";
    $uniqid = 'details';
    $file_name = $base_dir . $uniqid;
    if (file_exists($file_name)) {
        unlink($file_name);
    }
    $pdf->Output($file_name . '.pdf', 'F');
    $abs_file_name = $base_dir . $uniqid . '.pdf';
//============================================================+
// END OF FILE
//============================================================+
}
