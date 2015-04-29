<?php

ini_set("memory_limit", "64M");
sleep(5);
// Include the main TCPDF library (search for installation path).
require_once('../../lib/tcpdf/tcpdf.php');

require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/objectives.php';
require_once '../../lib/projectPhases.php';
require_once '../../lib/Settings.php';
require_once '../../lib/budget_items.php';
require_once '../../lib/project_budget.php';
require_once '../../lib/objectives.php';

// FILES FOR MANPOWER DUSRATIONS
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
            'duration' => $row['proposed_duration'],
            'status_date' => $row['status_date'],
            'research_code' =>$row['research_code'],
            'type_title' =>$row['type_title'],
            'type_title_en' =>$row['type_title_en'],
            'keywords' =>$row['keywords']
                );
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
    /*public function GetCurrRound() {
        $obj = new Settings();
        return $obj->GetCurrRound();
    }*/

}

if (isset($_GET['q'])) {

    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    // create new PDF document
    $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $details = GetRsearchDetails($project_id);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Research Proposal');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 011', PDF_HEADER_STRING);
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->setPrintFooter(false);
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
    
    //$pdf->SetFont('aealarabiya', '', 14);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();
    $pdf->setRTL(false);
    
    $title_ar = $details['title_ar'];
    $title_en = $details['title_en'];
    $tech_title = $details['tech_title'];
    $track_title = $details['track_title'];
    $subTrack_title = $details['subTrack_title'];
    $name_ar = $details['name_ar'];
    $name_en = $details['name_en'];
    $duration = $details['duration'];
    $status_date = $details['status_date'];
    $research_code = $details['research_code'];
    $type_title = $details['type_title'];
    $type_title_en = $details['type_title_en'];
    $keywords = $details['keywords'];
    
    $pdf->SetFont('aealarabiya', '', 14);
    $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font-family:Times New Roman;font size:16;font-weight:bold;}
        .ph1 {text-align: left;font-family:Times New Roman;font size:14;font-weight:bold;}
        .tg  {border-spacing:0;border-color:#999;margin:0px auto;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-family:Times New Roman;font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
        .tg .tg-even{font-size:12px}
        .tg .tg-header{font-weight:bold;font-size:14px;background-color:#0d516d}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
        .tg .en{font-family:Times New Roman;}
    </style>';
    
    $html = $html_styles . '<p class="rh1">' . 'Research Project Proposal' . '</p>';
    $html .= '<p class="ph1">' . 'General information' . '</p>';
    $html .='<hr/><br/>';
    $pdf->writeHTML($html, true, 0, true, 0);
    
    $pdf->SetFont('aealarabiya', '', 12);
    
    
    $html = $html_styles .'<table class="tg" border="2" dir="ltr">
        <tr>
            <th class="tg-header">Item</th>
            <th class="tg-header">Description</th>
        </tr>
        
        <tr>
            <td class="tg-odd en" style="font-weight: bold">Arabic research title</td>
            <td class="tg-odd" style="text-align:right !important; padding-top:10px!important">' . $title_ar . '</td>
        </tr>
        <tr>
            <td class="tg-even en" style="font-weight: bold">English research title</td>
            <td class="tg-even en en">' . $title_en . '</td>
        </tr>
        <tr>
            <td class="tg-odd en" style="font-weight: bold">Research area</td>
            <td class="tg-odd en">' . $tech_title . '</td>
        </tr>
        <tr>
            <td class="tg-even en" style="font-weight: bold">Track</td>
            <td class="tg-even en">' . $track_title . '</td>
        </tr>
        <tr>
            <td class="tg-odd en" style="font-weight: bold">Sub-track</td>
            <td class="tg-odd en">' . $subTrack_title . '</td>
        </tr>
        <tr>
            <td class="tg-even en" style="font-weight: bold">PI Arabic name </td>
            <td class="tg-even">' . $name_ar . '</td>
        </tr>
        <tr>
            <td class="tg-odd en" style="font-weight: bold">PI English name</td>
            <td class="tg-odd en">' . $name_en . '</td>
        </tr>
        <tr>
            <td class="tg-even en" style="font-weight: bold">Submit date</td>
            <td class="tg-even en">'.$status_date.'</td>
        </tr>
        <tr>
            <td class="tg-odd en" style="font-weight: bold">Submitted for deadline of</td>
            <td class="tg-odd en">30-3-2015</td>
        </tr>
        <tr>
            <td class="tg-even en" style="font-weight: bold">Estimated duration in monthes</td>
            <td class="tg-even en">' . $duration . ' Month</td>
        </tr>
        <tr>
            <td class="tg-odd en" style="font-weight: bold">Project type</td>
            <td class="tg-odd en">'.$type_title_en.'</td>
        </tr>
        <tr>
            <td class="tg-even en" style="font-weight: bold">Keywords</td>
            <td class="tg-even">' . $keywords . '</td>
        </tr>
        <tr>
            <td class="tg-odd en" style="font-weight: bold">Project code</td>
            <td class="tg-odd en">'.$research_code.'</td>
        </tr>
    </table>';
    $pdf->writeHTML($html, true, 0, true, 0);
    // close and output PDF document
    $base_dir = '../../uploads/' . $project_id . "/";
    $uniqid = 'summary';
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
