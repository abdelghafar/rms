<?php

ini_set("memory_limit", "64M");

// Include the main TCPDF library (search for installation path).
require_once('../lib/tcpdf/tcpdf.php');

require_once '../lib/Reseaches.php';
require_once '../lib/research_stuff.php';
require_once '../lib/objectives.php';
require_once '../lib/projectPhases.php';
require_once '../lib/Settings.php';
require_once '../lib/budget_items.php';
require_once '../lib/project_budget.php';
require_once '../lib/objectives.php';

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
    $lg['a_meta_dir'] = 'rtl';
    $lg['a_meta_language'] = 'ar';
    $lg['w_page'] = 'page';
// set some language-dependent strings (optional)
    $pdf->setLanguageArray($lg);
    $pdf->SetFont('aealarabiya', '', 12);

    $pdf->AddPage();
    $title_ar = $details['title_ar'];
    $title_en = $details['title_en'];
    $tech_title = $details['tech_title'];
    $track_title = $details['track_title'];
    $subTrack_title = $details['subTrack_title'];
    $name_ar = $details['name_ar'];
    $name_en = $details['name_en'];
    $duration = $details['duration'];

    $html = '<style type="text/css">
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
            <td class="tg-lrt0" style="font-weight: bold">عنوان البحث-اللغة العربية</td>
            <td class="tg-lrt0">' . $title_ar . '</td>
        </tr>
        <tr>
            <td class="tg-uy9o" style="font-weight: bold">عنوان البحث-اللغة الانجليزية</td>
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
            <td class="tg-uy9o" style="font-weight: bold">الباحث الرئيسي-اللغة العربية</td>
            <td class="tg-uy9o">' . $name_ar . '</td>
        </tr>
        <tr>
            <td class="tg-lrt0" style="font-weight: bold">الباحث الرئيسي-اللغة الانجليزية</td>
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
    //---------------------------
    $pdf->AddPage();
    $html = '<p>' . 'مقدمة المشروع' . '</p>';
    $html.='<hr/>';
    $html .= '<p>' . GetResearchIntro($project_id) . '</p>';
    $pdf->writeHTML($html, true, 0, true, 0);
    //-----------------------------------------------------------
    $pdf->AddPage();
    $html = '<p>' . 'الملخص باللغة العربية' . '</p>';
    $html.='<hr/>';
    $html .= '<p>' . GetResearchAbstractAr($project_id) . '</p>';
    $pdf->writeHTML($html, true, 0, true, 0);
    //-----------------------------------------------------------
    $pdf->AddPage();
    $html = '<p>' . 'الملخص باللغة الانجليزية' . '</p>';
    $html.='<hr/>';
    $html .= '<p>' . GetResearchAbstractEng($project_id) . '</p>';
    $pdf->writeHTML($html, true, 0, true, 0);
    //----------------------------------------------------------------
    $pdf->AddPage();
    $html = '<p>' . 'المسح الأدبي' . '</p>';
    $html.='<hr/>';
    $html .= '<p>' . GetResearchReview($project_id) . '</p>';
    $pdf->writeHTML($html, true, 0, true, 0);
    //----------------------------------------------------------------
    $pdf->AddPage();
    $html = '<p>' . 'القيمة للمملكة' . '</p>';
    $html.='<hr/>';
    $html .= '<p>' . GetResearchValue($project_id) . '</p>';
    $pdf->writeHTML($html, true, 0, true, 0);
    //----------------------------------------------------------------
    //new page 
    $pdf->AddPage();
    $html = '<style type="text/css">
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
    //Abdo code
    //End of adduo code 

    $pdf->AddPage();
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
    $total_amount = 0;
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
    $html.='<tr>' . '<td class="tg-lrt0">' . 'الاجمالي' . '</td>' . '<td class="tg-lrt0">' . number_format($total_amount, 2) . '</td>' . '</tr>';
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, 0, true, 0);
    // close and output PDF document
    $base_dir = '../uploads/generated/';
    $file_name = $base_dir . $project_id;
    if (file_exists($file_name)) {
        unlink($file_name);
    }
    $pdf->Output($file_name . '.pdf', 'F');
    $abs_file_name = '../uploads/generated/' . $project_id . '.pdf';
    echo $abs_file_name;
    $reseach = new Reseaches();
    $reseach->SetURL($project_id, 'uploads/generated/' . $project_id . '.pdf');
//============================================================+
// END OF FILE
//============================================================+
}
