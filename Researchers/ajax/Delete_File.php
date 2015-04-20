<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 20/04/15
 * Time: 03:37 م
 */
session_start();

require_once '../../lib/Reseaches.php';

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
        default:
            {
            $msg = -1;
            break;

            }
    }
    echo $msg;

}