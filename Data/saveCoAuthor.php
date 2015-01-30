<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/research_Authors.php';
require_once '../lib/Reseaches.php';

if (isset($_GET['researchCode']) && isset($_GET['personId'])) {
    $research = new Reseaches();
    $research_id = $research->GetResearchId($_GET['researchCode']);
    $person_id = $_GET['personId'];
    $author = new research_Authors();
    $author->Save($research_id, $person_id, 0);
}