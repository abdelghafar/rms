<?php

session_start();
require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/Reseaches.php';

if (isset($_GET['person_id']) && isset($_GET['q'])) {
    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
    $projectId = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $researchAuthor = new research_stuff();
    $research = new Reseaches();
    $res = $researchAuthor->DeleteStuff($projectId, $person_id);
    echo $res;
} else {
    echo 'person_id and rcode are required..';
}