<?php
session_start();
require_once '../../lib/PDFMerger/PDFMerger.php';
require_once '../../lib/Reseaches.php';
require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/stuff_roles.php';

$pdf = new PDFMerger;

$file_name = '';
$project = new Reseaches();

if (isset($_GET['url'])) {
    $file_name = $_GET['url'];
    if (strlen($file_name) > 0) {
        $target_file = '../../uploads/' . $project_id . '/' . uniqid() . '_tmp.pdf';
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        $str = $pdf->addPDF('../../uploads/' . $file_name, 'all')
            ->merge('file', $target_file);

        if (file_exists($target_file)) {
            unlink($target_file);
            echo 1;
        }
    } else {
        echo -1;
    }

}


