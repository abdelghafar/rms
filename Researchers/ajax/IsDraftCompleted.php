<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 12/04/15
 * Time: 10:43 ص
 */
require_once '../../lib/Reseaches.php';
if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $obj = new Reseaches();
    echo json_encode($obj->IsDraftCompleted($project_id));
}