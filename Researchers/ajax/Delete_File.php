<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 20/04/15
 * Time: 03:37 م
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
    $base_url = '../../';
    $msg = -1;
    switch ($type) {
        case 'arabic_summary':
        {
            $url = $r->GetAbstract_ar_url($project_id);
            $base_url .= $url;
            unlink($base_url);
            $r->SetAbstract_ar_url($project_id, '');
            $msg = 1;
            break;
        }

        case 'english_summary':
        {
            $url = $r->GetAbstract_en_url($project_id);
            $base_url .= $url;
            unlink($base_url);
            $r->SetAbstract_en_url($project_id, '');
            $msg = 1;
            break;
        }
        case 'introduction':
        {
            $url = $r->GetIntro_url($project_id);
            $base_url .= $url;
            unlink($base_url);
            $r->SetIntro_url($project_id, '');
            $msg = 1;
            break;
        }
        case 'literature_review':
        {
            $url = $r->GetLitReview_url($project_id);
            $base_url .= $url;
            unlink($base_url);
            $r->SetLitReview_url($project_id, '');
            $msg = 1;
            break;
        }
        case 'research_method':
        {
            $url = $r->GetResearch_method_url($project_id);
            $base_url .= $url;
            unlink($base_url);
            $r->SetResearch_method_url($project_id, '');
            $msg = 1;
            break;
        }
        case 'value_to_kingdom':
        {
            $url = $r->GetValueToKingdomUrl($project_id);
            $base_url .= $url;
            unlink($base_url);
            $r->SetValueToKingdomUrl($project_id, '');
            $msg = 1;
            break;
        }
        case 'refs':
        {
            $url = $r->GetRefsUrl($project_id);
            $base_url .= $url;
            unlink($base_url);
            $r->SetRefsUrl($project_id, '');
            $msg = 1;
            break;
        }
        case 'resume':
        {
            $projectId = $_SESSION['q'];
            $personId = $_SESSION['person_id'];
            $research_stuff = new research_stuff();
            $pi_seqId = $research_stuff->GetSeqId($projectId, $personId, stuff_roles_system::$PI, research_stuff_categories::$person_based);
            $url = $research_stuff->GetResearchStuffResume($pi_seqId);
            $base_url .= $url;
            unlink($base_url);
            $research_stuff->SetResearchStuffResume($pi_seqId, '');
            $msg = 1;
            break;
        }
        case 'finishing_scholarship':
        {
            $projectId = $_SESSION['q'];
            $personId = $_SESSION['person_id'];
            $research_stuff = new research_stuff();
            $pi_seqId = $research_stuff->GetSeqId($projectId, $personId, stuff_roles_system::$PI, research_stuff_categories::$person_based);
            $url = $research_stuff->GetFinishingScholarshipUrl($pi_seqId);
            $base_url .= $url;
            unlink($base_url);
            $research_stuff->SetFinishingScholarshipUrl($pi_seqId, '');
            $msg = 1;
            break;
        }

        //ToDO: finish all status
        default:
            {
            $msg = -1;
            break;

            }
    }
    echo $msg;

}