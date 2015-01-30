<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../lib/projectPlan.php';
if (isset($_GET['projectId']) && isset($_GET['planTitle']) && isset($_GET['planUrl'])) {

    $projectId = $_GET['projectId'];
    $planTitle = $_GET['planTitle'];
    $planUrl = $_GET['planUrl'];
    $p = new projectPlan();
    $p->Save($projectId, $planTitle, $planUrl);
}
