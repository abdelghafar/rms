<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../lib/project_budget_others.php';
$seq_id = 0;
if (!isset($_GET['seq_id'])) {
    $budget_item_id = $_POST['others_items_val'];
    $item_amount_val = $_POST['others_amount_val'];
    $item_desc = $_POST['others_desc'];
    $project_id = $_POST['project_id'];
    $t = new project_budget_others();
    $rs = $t->Save(0, $project_id, $budget_item_id, $item_amount_val, $item_desc);
    echo $rs;
} else {
    $seq_id = filter_input(INPUT_GET, 'seq_id');
    $budget_item_id = $_POST['others_items_val'];
    $item_amount_val = $_POST['others_amount_val'];
    $item_desc = $_POST['others_desc'];
    $project_id = $_POST['project_id'];
    $t = new project_budget_others();
    $rs = $t->Save($seq_id, $project_id, $budget_item_id, $item_amount_val, $item_desc);
    echo $rs;
}