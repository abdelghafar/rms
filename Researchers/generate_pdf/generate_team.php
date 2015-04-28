<?php

ini_set("memory_limit", "128M");

// Include the main TCPDF library (search for installation path).
require_once('../../lib/tcpdf/tcpdf.php');

require_once '../../lib/person_name.php';
require_once '../../lib/research_stuff.php';



$research_team = new research_stuff();
$person = new PersonName();

class PDF extends TCPDF
{

    // Colored table
    public function GetCurrRound()
    {
        $obj = new Settings();
        return $obj->GetCurrRound();
    }

}

if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $rs = $research_team->GetProjectTeam($project_id);
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
    $pdf->setRTL(true);
    $pdf->SetFont('aealarabiya', '', 12);
    $pdf->setPrintFooter(false);
    //----------------------------------------------------------------
    //new page 
    $pdf->AddPage();
    $html_styles = '<style type="text/css">
        .rh1 {text-align: center;font size:16;font-weight:bold;}
        .ph1 {text-align: right;font size:14;font-weight:bold;}
        .tg  {border-spacing:1;border-color:#999;margin:5px;}
        .tg td{font-size:12px;font-weight:normal;padding:12px 10px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-size:14px;font-weight:bold;padding:12px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#0d516d;}
        .tg .tg-even{font-size:12px}
        .tg .tg-odd{background-color:#D2E4FC;font-size:12px}
    </style>';

    $html = $html_styles . '<p class="ph1">' . 'فريق العمل'  . '</p>';
    $html .='<hr/><br/>';
    $pdf->writeHTML($html, true, 0, true, 0);

    $pdf->SetFont('aealarabiya', '', 12);

    $html = $html_styles . '<table class="tg" border="2" dir="rtl">
        
    <thead>
        <tr>
            <th style="width: 30px;">#</th>
            <th style="width: 300px;">اسم الباحث</th>
            <th style="width: 150px;">الوظيفة</th>
            <th style="width: 150px;">الدرجة العلمية</th>
        </tr>
    </thead><tbody>';
    $counter = 1;

    $td_style = "tg-odd";
    while ($row = mysql_fetch_array($rs)) {
        if ($row['type'] === 'role_based') {
            $person_name = $row['role_name'];
            $role_name = '';
            $Position = '';
        } else {
            $person_name = $person->GetPersonName($row['person_id']);
            $Position = $person->GetPersonPosition($row['person_id']);
            $role_name = $row['role_name'];
        }
        if ($td_style == "tg-odd")
            $td_style = "tg-even";
        else
            $td_style = "tg-odd";

        $pdf->SetFont('aealarabiya', '', 10);
        $html .= '<tr>';
        $html .= '<td class="'.$td_style.'" style="width: 30px; text-align:center">' . $counter++ . '</td>';
        $html .= '<td class="'.$td_style.'" style="width:300px;">' . $person_name . '</td>';
        $html .= '<td class="'.$td_style.'" style="width:150px;">' . $role_name . '</td>';
        $html .= '<td class="'.$td_style.'" style="width:150px;">' . $Position . '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</tbody></table>';
    $pdf->writeHTML($html, true, 0, true, 0);
    //project stuff other personal ....

   
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
