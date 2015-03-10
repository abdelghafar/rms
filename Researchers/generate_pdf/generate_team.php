<?php

ini_set("memory_limit", "64M");

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



class PDF extends TCPDF {

    // Colored table
    public function GetCurrRound() {
        $obj = new Settings();
        return $obj->GetCurrRound();
    }

}

if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    // create new PDF document
    $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
    $lg['a_meta_dir'] = 'rtl';
    $lg['a_meta_language'] = 'ar';
    $lg['w_page'] = 'page';
// set some language-dependent strings (optional)
    $pdf->setLanguageArray($lg);
    $pdf->SetFont('aealarabiya', '', 12);
    $pdf->setPrintFooter(false);
    //----------------------------------------------------------------
    //new page 
    $pdf->AddPage();
    $html = '<p>' . 'فريق العمل' . '</p>';
    $html.='<hr/><br/>';
    $html .= '<style type="text/css">
        .tg  {border-spacing:0;border-color:#999;margin:0px auto;}
        .tg td{font-size:14px;padding:10px 5px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
        .tg .tg-uy9o{font-size:18px}
        .tg .tg-0bb8{font-weight:bold;font-size:18px;background-color:#0d516d}
        .tg .tg-lrt0{background-color:#D2E4FC;font-size:18px}
    </style>';
    $obj = new research_stuff();
    $rs = $obj->GetProjectStuff($project_id);
    $list = array();
    $html.='<table border = "1" class="tg" dir="rtl" style="width:760px;">
    <thead>
        <tr>
            <th style="width: 30px;">#</th>
            <th>اسم الباحث</th>
            <th>التخصص العام</th>
            <th>الوظيفة</th>
            <th>الدرجة العلمية</th>
        </tr>
    </thead><tbody>';
    $counter = 1;
    while ($row = mysql_fetch_array($rs)) {
        $html.= '<tr>';
        $html.='<td class="tg-lrt0" style="width: 30px;">' . $counter++ . '</td>';
        $html.='<td class="tg-uy9o" style="width:150px;">' . $row['name_ar'] . '</td>';
        $html.='<td class="tg-lrt0">' . ' ' . $row['Major_Field'] . '</td>';
        $html.='<td class="tg-uy9o">' . $row['role_name'] . '</td>';
        $html.='<td class="tg-lrt0">' . $row['Position'] . '</td>';
        $html.='</tr>';
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, 0, true, 0);
    //--------------------------------------------------------
    //
    // close and output PDF document
    $base_dir = '../../uploads/' . $project_id . "/";
    $uniqid = 'team';
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
