<?php

session_start();
ini_set("memory_limit", "18M");

//============================================================
// Include the main TCPDF library (search for installation path).
require_once '../../lib/tcpdf/tcpdf.php';
require_once '../../Reports/inc/GetResearchBudgetAndCountByYearFn.php';

// create new PDF document
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = '../../common/images/uqu.png';
        $this->Image($image_file, 195, 5, 20, 25, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $image_file = '../../common/images/uquisr.png';
        $this->Image($image_file, 30, 5, 20, 25, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer() {
        
    }

}

$Research_code = base64_decode($_GET['research_code']);
$title_ar = base64_decode($_GET['title_ar']);
$rcenter = base64_decode($_GET['rcenter']);
$submitDate = base64_decode($_GET['submit']);
$budget = base64_decode($_GET['budget']);

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('معهد البحوث العلمية و احياء التراث الاسلامي');
$pdf->SetTitle('ايصال استلام بحث');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 018', PDF_HEADER_STRING);

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

// ---------------------------------------------------------
// set font
$pdf->SetFont('aealarabiya', '', 24);

// add a page
$pdf->AddPage();

// set LTR direction for english translation
$pdf->setRTL(false);

$pdf->SetFontSize(24);

// print newline
$pdf->Ln();

// Restore RTL direction
$pdf->setRTL(true);

// set font
$pdf->SetFont('aealarabiya', '', 24);

// print newline
$pdf->Ln();

// Arabic and English content

$pdf->Cell(0, 12, 'ايصال استلام مشروع بحثي', 0, 1, 'C');

// set LTR direction for english translation
$pdf->setRTL(true);

// print newline
$pdf->Ln();

$pdf->SetFont('aealarabiya', '', 18);

// Arabic and English content
$list = GetResearchBudgetAndCountByYearFn(1435);
foreach ($list as $row) {
    echo $row['center_name'] . '<br/>';
}




$htmlcontent2 = <<<EOD
<table cellspacing="0" cellpadding="1" border="1" dir="rtl" style="width: 630px;">
        
        
           </table>
EOD;


$pdf->WriteHTML($htmlcontent2, true, 0, true, 0);

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output($Research_code . '.pdf', 'I');
?>
