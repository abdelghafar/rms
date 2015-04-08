<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 05/04/15
 * Time: 11:59 م
 */
session_start();
require_once '../../lib/Reseaches.php';
$obj = new Reseaches();
if (isset($_SESSION['q'])) {
    $research_id = $_SESSION['q'];
    $rs = $obj->DraftComplete($research_id);
    ob_start();
    header('Location:../Researchers_View.php');
}
