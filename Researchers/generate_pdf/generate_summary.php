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

function GetRsearchDetails($research_id)
{
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

function GetResearchIntro($research_id)
{
    $r = new Reseaches();
    return $r->GetIntroductionText($research_id);
}

function GetResearchAbstractAr($research_id)
{
    $r = new Reseaches();
    return $r->GetAbstractArText($research_id);
}

function GetResearchAbstractEng($research_id)
{
    $r = new Reseaches();
    return $r->GetAbstractEnText($research_id);
}

function GetResearchReview($research_id)
{
    $r = new Reseaches();
    return $r->GetLiteratureReviewText($research_id);
}

function GetResearchValue($research_id)
{
    $r = new Reseaches();
    return $r->GetValueToKingdomText($research_id);
}

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
    $pdf->AddPage();
    $pdf->setRTL(true);
    $title_ar = $details['title_ar'];
    $title_en = $details['title_en'];
    $tech_title = $details['tech_title'];
    $track_title = $details['track_title'];
    $subTrack_title = $details['subTrack_title'];
    $name_ar = $details['name_ar'];
    $name_en = $details['name_en'];
    $duration = $details['duration'];
    $html = '<p>' . 'المقدمة' . '</p>';
    $html .= '<hr/><br/>';
    $html .= '<style type="text/css">
        .tg  {border-spacing:0;border-color:#999;margin:0px auto;}
        .tg td{font-size:14px;padding:10px 5px;border-style:solid;border-width:2px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
        .tg th{font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
        .tg .tg-uy9o{font-size:18px}
        .tg .tg-0bb8{font-weight:bold;font-size:18px;background-color:#0d516d}
        .tg .tg-lrt0{background-color:#D2E4FC;font-size:18px}
    </style>
    <table class="tg" border="2" dir="rtl">
        <tr>
            <th class="tg-0bb8">العنصر</th>
            <th class="tg-0bb8">الوصف</th>
        </tr>
        <tr>
            <td class="tg-lrt0" style="font-weight: bold">عنوان البحث / اللغة العربية</td>
            <td class="tg-lrt0">' . $title_ar . '</td>
        </tr>
        <tr>
            <td class="tg-uy9o" style="font-weight: bold">عنوان البحث / اللغة الانجليزية</td>
            <td class="tg-uy9o">' . $title_en . '</td>
        </tr>
        <tr>
            <td class="tg-lrt0" style="font-weight: bold">الاولوية</td>
            <td class="tg-lrt0">' . $tech_title . '</td>
        </tr>
        <tr>
            <td class="tg-uy9o" style="font-weight: bold">التخصص العام</td>
            <td class="tg-uy9o">' . $track_title . '</td>
        </tr>
        <tr>
            <td class="tg-lrt0" style="font-weight: bold">التخصص الدقيق</td>
            <td class="tg-lrt0">' . $subTrack_title . '</td>
        </tr>
        <tr>
            <td class="tg-uy9o" style="font-weight: bold">الباحث الرئيسي / اللغة العربية</td>
            <td class="tg-uy9o">' . $name_ar . '</td>
        </tr>
        <tr>
            <td class="tg-lrt0" style="font-weight: bold">الباحث الرئيسي / اللغة الانجليزية</td>
            <td class="tg-lrt0">' . $name_en . '</td>
        </tr>
        <tr>
            <td class="tg-uy9o" style="font-weight: bold">تاريخ الارسال</td>
            <td class="tg-uy9o">23-10-2015</td>
        </tr>
        <tr>
            <td class="tg-lrt0" style="font-weight: bold">مرحلة التقديم</td>
            <td class="tg-lrt0">30-3-2015</td>
        </tr>
        <tr>
            <td class="tg-uy9o" style="font-weight: bold">مدة المشروع -بالشهور</td>
            <td class="tg-uy9o">' . $duration . '</td>
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
