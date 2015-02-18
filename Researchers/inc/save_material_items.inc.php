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
    $project_id = $_POST['project_id'];
    $seq_id = filter_input(INPUT_GET, 'seq_id', FILTER_VALIDATE_INT);
    $materials_amount = filter_input(INPUT_GET, 'materials_amount');
    $materials_item_id = filter_input(INPUT_GET, 'materials_item_id');
    $materials_desc = filter_input(INPUT_GET, 'materials_desc', FILTER_SANITIZE_STRING);
    $t = new project_budget_materials();
    $rs = $t->Save($seq_id, $project_id, $materials_item_id, $materials_amount, $materials_desc);
    echo $rs;
}





