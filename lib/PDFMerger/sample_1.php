<?php

require_once '../config.php';
require_once '../Reseaches.php';
//require_once '../../uploads/1/';
include 'PDFMerger.php';
$pdf = new PDFMerger;
if (isset($_GET['q'])) {
    $project_id = $_GET['q'];
    $obj = new Reseaches();
    $intro_url_abs = $obj->GetIntro_url($project_id);

    $intro_url_rel = '../../' . $intro_url;
    echo "<a href='" . '../../uploads/' . $project_id . '/' . 'summary.pdf' . "'/>summary</a>";

    $pdf->addPDF('http://localhost/rms/uploads/' . $project_id . '/' . 'summary.pdf', 'all')
            ->addPDF($intro_url_rel, 'all')
            ->merge('browser', 'final_' . date(DateTime_Format) . ".pdf");
}

//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.