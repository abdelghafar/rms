<?php

include 'PDFMerger.php';

$pdf = new PDFMerger;
$base_dir = 'samplepdfs/';
$file_name = $base_dir . '2.pdf';
$target_file = $base_dir . uniqid() . '_tmp.pdf';

if (file_exists($target_file)) {
    unlink($target_file);
}

$str = $pdf->addPDF($file_name, 'all')
        ->merge('file', $target_file);

if (file_exists($target_file)) {
    unlink($target_file);
    echo 1;
}

//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
	//You do not need to give a file path for browser, string, or download - just the name.
