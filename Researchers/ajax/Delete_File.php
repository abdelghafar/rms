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

}