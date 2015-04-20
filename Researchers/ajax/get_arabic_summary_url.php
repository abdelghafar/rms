<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 20/04/15
 * Time: 03:16 م
 */
session_start();

require_once '../../lib/Reseaches.php';
if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q');
    $r = new Reseaches();
    echo $r->GetAbstract_ar_url($project_id);
}