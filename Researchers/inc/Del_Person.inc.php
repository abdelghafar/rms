<?php

require_once '../../lib/persons.php';
require_once '../../lib/research_Authors.php';
require_once '../../lib/Reseaches.php';

if (isset($_GET['person_id']) && isset($_GET['rcode'])) {
    $PersonId = $_GET['person_id'];
    $rcode = $_GET['rcode'];
    $researchAuthor = new research_Authors();
    $research = new Reseaches();
    $ResearchId = $research->GetResearchId($rcode);

    $res = $researchAuthor->DeleteAuthor($ResearchId, $PersonId);
} else {
    echo 'person_id and rcode are required..';
}