<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once '../../lib/project_budget.php';


if (isset($_GET['q'])) {
    $seq_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $t = new project_budget();
    $res = $t->Delete($seq_id);
    echo $res;
} else {
    echo 'seq_id is required..';
}