<?php
session_start();

require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/Reseaches.php';

if (isset($_GET['research_stuff_id'])) {
    $research_stuff_id = filter_input(INPUT_GET, 'research_stuff_id', FILTER_VALIDATE_INT);
    $researchAuthor = new research_stuff();
    $research = new Reseaches();
    $res = $researchAuthor->Delete($research_stuff_id);
    echo $res;
} else {
    echo 'person_id and rcode are required..';
}