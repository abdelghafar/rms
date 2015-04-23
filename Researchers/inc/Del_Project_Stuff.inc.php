<?php

session_start();

print_r($_SESSION);

require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/Reseaches.php';

if (isset($_GET['person_id'])) {
    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
    $projectId = $_SESSION['project_id'];
    $researchAuthor = new research_stuff();
    $research = new Reseaches();
    // $res = $researchAuthor->DeleteStuff($projectId, $person_id);
//    echo $res;
} else {
    echo 'person_id and rcode are required..';
}