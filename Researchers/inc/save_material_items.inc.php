<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../lib/project_budget_materials.php';

$seq_id = 0;
if (!isset($_GET['seq_id'])) {
    $budget_item_id = $_POST['materials_items_val'];
    $item_amount_val = $_POST['item_amount_val'];
    $item_desc = $_POST['item_desc'];
    $project_id = $_POST['project_id'];
    $t = new project_budget_materials();
    $rs = $t->Save($seq_id, $project_id, $budget_item_id, $item_amount_val, $item_desc);
    echo $rs;
} else {
    $seq_id = filter_input(INPUT_GET, 'seq_id');
    $project_id = filter_input(INPUT_POST, 'project_id');
    $materials_items_val = filter_input(INPUT_POST, 'materials_items_val');
    $item_amount_val = filter_input(INPUT_POST, 'item_amount_val');
    $item_desc = filter_input(INPUT_POST, 'item_desc');
    $t = new project_budget_materials();
    $rs = $t->Save($seq_id, $project_id, $materials_items_val, $item_amount_val, $item_desc);
    echo $rs;
}





