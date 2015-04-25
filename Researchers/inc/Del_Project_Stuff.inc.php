<?php
session_start();

require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/Reseaches.php';
require_once '../../lib/project_budget.php';

if (isset($_GET['research_stuff_id'])) {
    $research_stuff_id = filter_input(INPUT_GET, 'research_stuff_id', FILTER_VALIDATE_INT);
    $researchAuthor = new research_stuff();
    $research = new Reseaches();
    $res = $researchAuthor->Delete($research_stuff_id);
    $project_budget = new project_budget();
    $project_budget->DeleteByResearchStuffId($research_stuff_id);
    echo $res;
} else {
    echo 'person_id and rcode are required..';
}