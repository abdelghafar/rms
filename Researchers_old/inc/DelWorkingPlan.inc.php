<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../lib/projectPlan.php';

if (isset($_GET['seq_id'])) {
    $seqId = $_GET['seq_id'];
    $project = new projectPlan();
    $res = $project->Delete($seqId);
} else {
    echo 'person_id and rcode are required..';
}
