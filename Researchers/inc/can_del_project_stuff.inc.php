<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 11/04/15
 * Time: 01:32 م
 */
require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/Reseaches.php';

if (isset($_GET['$research_stuff_id'])) {
    $research_stuff_id = filter_input(INPUT_GET, '$research_stuff_id', FILTER_VALIDATE_INT);
    $research_stuff = new research_stuff();
    $res = $research_stuff->CanDelete($research_stuff_id);
    echo $res;
}