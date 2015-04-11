<?php

session_start();
require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/Reseaches.php';

if (isset($_GET['q'])) {
    $q = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $researchAuthor = new research_stuff();
    $res = $researchAuthor->Delete($q);
    echo $res;
} else {
    echo 'person_id and rcode are required..';
}