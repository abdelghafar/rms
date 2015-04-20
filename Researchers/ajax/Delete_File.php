<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 20/04/15
 * Time: 03:37 م
 */
session_start();

require_once '../../lib/Reseaches.php';

if (isset($_GET['q']) && isset($_GET['url'])) {
    $project_id = filter_input(INPUT_GET, 'q');
    $url = filter_input(INPUT_GET, 'url');

    $r = new Reseaches();
    $base_url = '../../' . $url;
    try {
        unlink($base_url);
        $r->SetAbstract_ar_url($project_id, '');
        echo 1;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}