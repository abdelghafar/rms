<?php

ini_set("memory_limit", "24M");

// Include the main TCPDF library (search for installation path).
require_once('../../lib/tcpdf/tcpdf.php');
require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/objectives.php';
require_once '../../lib/projectPhases.php';
require_once '../../lib/Settings.php';

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

function get_objectives() {
    $objectives = new Objectives();
    $project_id = 1; //$_REQUEST['project_id'];
    $objectives_rs = $objectives->GetObjectivies($project_id);
    $counter = 1;
    while ($row = mysql_fetch_array($objectives_rs, MYSQL_ASSOC)) {
        $objectives_list[] = array(
            'seq_id' => $counter,
            'obj_title' => $row['obj_title'],
            'obj_desc' => $row['obj_desc']
        );
        $counter++;
    }
    return $objectives_list;
}

function get_phases() {
    $obj = new projectPhase();
    $rs = $obj->GetProjectPhases(1);
    $i = 1;
    while ($row = mysql_fetch_array($rs)) {
        $lst[] = array('seq_id' => $i, 'phase_name' => $row['phase_name'], 'phase_desc' => $row['phase_desc']);
        $i++;
    }
    return $lst;
}

function get_stuff($project_id) {
    $obj = new research_stuff();
    $rs = $obj->GetProjectStuff($project_id);
    $list = array();
    while ($row = mysql_fetch_array($rs)) {
        $list[] = array('name_ar' => $row['name_ar'],
            'Major_Field' => $row['Major_Field'],
            'role_name' => $row['role_name'],
            'Position' => $row['Position']);
    }
    return $list;
}

class PDF extends TCPDF {

    // Colored table
    public function GetCurrRound() {
        $obj = new Settings();
        return $obj->GetCurrRound();
    }

    public function ColoredTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(7, 115, 161);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('aealarabiya', 'B');
        //$pdf->SetFont('aealarabiya', '', 10);
        // Header
        $w = array(10, 70, 100);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('aealarabiya');
        // Data
        $fill = 0;
        foreach ($data as $row) {
            $this->Cell($w[0], 10, $row['seq_id'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 10, $row['obj_title'], 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 10, $row['obj_desc'], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function phases_table($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(7, 115, 161);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('aealarabiya', 'B');
        //$pdf->SetFont('aealarabiya', '', 10);
        // Header
        $w = array(10, 170);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('aealarabiya');
        // Data
        $fill = 0;
        foreach ($data as $row) {
            $this->Cell($w[0], 10, $row['seq_id'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 10, $row['phase_name'], 'LR', 0, 'R', $fill);
            //$this->Cell($w[2], 10, $row['phase_desc'], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function stuff_render($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(7, 115, 161);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('aealarabiya', 'B');
        //$pdf->SetFont('aealarabiya', '', 10);
        // Header
        $w = array(45, 45, 45, 45);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('aealarabiya');
        // Data
        $fill = 0;
        foreach ($data as $row) {
            $this->Cell($w[0], 10, $row['name_ar'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 10, $row['Major_Field'], 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 10, $row['role_name'], 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 10, $row['Position'], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}

if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    // create new PDF document
    $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $details = GetRsearchDetails($project_id);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    //$pdf->SetAuthor('Nicola Asuni');
    //$pdf->SetTitle('TCPDF Example 011');
    //$pdf->SetSubject('TCPDF Tutorial');
    //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
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

// add a page
    $pdf->AddPage();
// column titles
    $header = array('م', 'الهدف', 'الوصف');
// data loading
    $obj_data = get_objectives();
// print colored table
    $pdf->ColoredTable($header, $obj_data);

    $pdf->AddPage();
    $p2_header = array('#', 'phases');
// data loading
    $p2_obj_data = get_phases();
// print colored table
    $pdf->phases_table($p2_header, $p2_obj_data);
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
        <tr>
            <td class="tg-lrt0" style="font-weight: bold">اجمالي الميزانية</td>
            <td class="tg-lrt0">125,000 SAR</td>
        </tr>
    </table>';



// output the HTML content
    $pdf->writeHTML($html, true, 0, true, 0);
    $pdf->AddPage();
    $stuff_header = array('name_ar', 'Major_Field', 'role_name', 'Position');
// data loading
    $stuff_data = get_stuff($project_id);
// print colored table
    $pdf->stuff_render($stuff_header, $stuff_data);

// close and output PDF document
    $file_name = '1';
    $pdf->Output($file_name . '.pdf', 'F');
//============================================================+
// END OF FILE
//============================================================+
}