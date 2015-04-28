<?php

require_once '../../lib/config.php';
require_once '../../lib/Reseaches.php';
require_once '../../lib/research_stuff.php';

include '../../lib/PDFMerger/PDFMerger.php';

$pdf = new PDFMerger;
if (isset($_GET['q'])) {
    $project_id = $_GET['q'];
    $obj = new Reseaches();
    $project_team = new research_stuff();



    $summary_url = '../../uploads/' . $project_id . '/' . 'summary.pdf';
    $team_url = '../../uploads/' . $project_id . '/' . 'team.pdf';
    $intro_url_rel = '../../' . $obj->GetIntro_url($project_id);
    $abs_ar_rel = '../../' . $obj->GetAbstract_ar_url($project_id);
    $abs_en_rel = '../../' . $obj->GetAbstract_en_url($project_id);
    $review_rel = '../../' . $obj->GetLitReview_url($project_id);
    $research_method = '../../' . $obj->GetResearch_method_url($project_id);
    $value_to_kingdom = '../../' . $obj->GetValueToKingdomUrl($project_id);
    $details_url = '../../uploads/' . $project_id . '/' . 'details.pdf';
    $ref_url = '../../' . $obj->GetRefsUrl($project_id);


    $stamp = date(DateTime_Format) . '_' . sha1($project_id);
    $file_name = '../../uploads/' . $project_id . '/' . 'final_' . $stamp . ".pdf";
    $pdf->addPDF($summary_url, 'all')
            ->addPDF($team_url, 'all')
            ->addPDF($intro_url_rel, 'all')
            ->addPDF($abs_ar_rel, 'all')
            ->addPDF($abs_en_rel, 'all')
            ->addPDF($review_rel, 'all')
            ->addPDF($research_method, 'all')
            ->addPDF($value_to_kingdom, 'all')
            ->addPDF($details_url, 'all')
            ->addPDF($ref_url, 'all');

    $project_team_rs = $project_team->GetProjectTeam($project_id);
    $finishing_scholarship_url = '';
    while ($row = mysql_fetch_array($project_team_rs)) {
        if ($row['type'] === 'personal_based') { // persons in team
            if ($row['resume_url'] <> '') // add resume file to PDF 
                $pdf->addPDF('../../' . $row['resume_url'], 'all');

            if ($row['role_id'] == 1 && $row['finishing_scholarship_url'] <> '') // get PI finishing_scholarship_url
                $finishing_scholarship_url = $row['finishing_scholarship_url'];

            if ($row['role_id'] > 1 && $row['agreement_url'] <> '') // add agreement file of Others to PDF
                $pdf->addPDF('../../' . $row['agreement_url'], 'all');
        }
    }
    if ($finishing_scholarship_url <> '') // add finishing_scholarship file to PDF 
        $pdf->addPDF('../../' . $finishing_scholarship_url, 'all');


    $pdf->merge('file', '../../uploads/' . $project_id . '/' . 'final_' . $stamp . ".pdf");
    $url = 'uploads/' . $project_id . '/' . 'final_' . $stamp . ".pdf";
    $obj->SetURL($project_id, $url);
    
    echo '../uploads/' . $project_id . '/' . 'final_' . $stamp . ".pdf";
}
