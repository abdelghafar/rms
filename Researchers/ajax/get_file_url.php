<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 20/04/15
 * Time: 03:16 م
 */
session_start();

require_once '../../lib/Reseaches.php';
require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/stuff_roles.php';


if (isset($_GET['q']) && isset($_GET['type'])) {
    $project_id = filter_input(INPUT_GET, 'q');
    $type = filter_input(INPUT_GET, 'type');
    $r = new Reseaches();
    $url = "";
    switch ($type) {
        case 'arabic_summary':
        {
            $url = $r->GetAbstract_ar_url($project_id);
            break;
        }
        case 'english_summary':
        {
            $url = $r->GetAbstract_en_url($project_id);
            break;
        }
        case 'introduction':
        {
            $url = $r->GetIntro_url($project_id);
            break;
        }
        case 'literature_review':
        {
            $url = $r->GetLitReview_url($project_id);
            break;
        }
        case 'research_method':
        {
            $url = $r->GetResearch_method_url($project_id);
            break;
        }
        case 'value_to_kingdom':
        {
            $url = $r->GetValueToKingdomUrl($project_id);
            break;
        }
        case 'refs':
        {
            $url = $r->GetRefsUrl($project_id);
            break;
        }
        case 'resume':
        {
            $projectId = $_SESSION['q'];
            $personId = $_SESSION['person_id'];
            $research_stuff = new research_stuff();
            $pi_seqId = $research_stuff->GetSeqId($projectId, $personId, stuff_roles_system::$PI, research_stuff_categories::$person_based);
            $url = $research_stuff->GetFinishingScholarshipUrl($pi_seqId);
            break;
        }
        case 'finishing_scholarship':
        {
            $person_id = $_SESSION['person_id'];
            $p = new Persons();
            $url = $p->GetFinishingScholarshipUrl($person_id);
            break;
        }

    }
    echo $url;
}