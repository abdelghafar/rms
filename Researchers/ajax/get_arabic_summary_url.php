<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 20/04/15
 * Time: 03:16 م
 */
session_start();

require_once '../../lib/Reseaches.php';
if (isset($_GET['q']) && isset($_GET['type'])) {
    $project_id = filter_input(INPUT_GET, 'q');
    $type = filter_input(INPUT_GET, 'type');
    $r = new Reseaches();
    $url = "";
    switch ($type) {
//        case 'arabic_summary':
//        {
//            $url = $r->GetAbstract_ar_url($project_id);
//            break;
//        }
//        case 'english_summary':
//        {
//            $url= $r->GetAbstract_en_url($project_id);
//            break;
//        }


    }
    echo $url;
}