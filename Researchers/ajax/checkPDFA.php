<?php

require_once '../../lib/PDFMerger/PDFMerger.php';
require_once '../../lib/Reseaches.php';
require_once '../../lib/persons.php';

$pdf = new PDFMerger;
if (isset($_GET['q']) && isset($_GET['type'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $file_name = '';
    $project = new Reseaches();

    switch ($_GET['type']) {
        case 'arAbsUpload':
        {
            $file_name = $project->GetAbstract_ar_url($project_id);
            break;
        }
        case 'enAbsUpload':
        {
            $file_name = $project->GetAbstract_en_url($project_id);
            break;
        }
        case 'introUpload':
        {
            $file_name = $project->GetIntro_url($project_id);
            break;
        }
        case 'reviewUpload':
        {
            $file_name = $project->GetLitReview_url($project_id);
            break;
        }
        case 'research_method':
        {
            $file_name = $project->GetResearch_method_url($project_id);
            break;
        }
        case 'value_to_kingdom':
        {
            $file_name = $project->GetValueToKingdomUrl($project_id);
            break;
        }
        case 'refs':
        {
            $file_name = $project->GetRefsUrl($project_id);
            break;
        }
        case 'resume':
        {
            $person_id = $_SESSION['person_id'];
            $p = new Persons();
            $file_name = $p->GetResumeUrl($person_id);
            echo 'person_id = ' . $person_id;
            break;
        }
        case 'finishing_scholarship':
        {
            $person_id = $_SESSION['person_id'];
            $p = new Persons();
            $file_name = $p->GetFinishingScholarshipUrl($person_id);
            break;
        }
        default :
            {
            break;
            }
    }

    if (strlen($file_name) > 0) {
        $target_file = '../../uploads/' . $project_id . '/' . uniqid() . '_tmp.pdf';
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        $str = $pdf->addPDF('../../' . $file_name, 'all')
            ->merge('file', $target_file);

        if (file_exists($target_file)) {
            unlink($target_file);
            echo 1;
        }
    } else {
        echo -1;
    }
}
