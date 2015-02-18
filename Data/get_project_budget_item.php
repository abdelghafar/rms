<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';
require_once '../lib/project_budget_materials.php';

$conn = new MysqlConnect();
$t = new project_budget_materials();

if (isset($_GET['seq_id'])) {
    $seq_id = filter_input(INPUT_GET, 'seq_id', FILTER_VALIDATE_INT);
    $stmt = 'select project_budget.seq_id, project_budget.amount, project_budget.`desc`, budget_items.item_title,budget_items.item_id from project_budget join budget_items on project_budget.item_id= budget_items.item_id where project_budget.seq_id=' . $seq_id;
    $result = $conn->ExecuteNonQuery($stmt);
    $jsonArray = array();
    while ($row = mysql_fetch_array($result)) {
        $jsonArray[] = array('seq_id' => $row['seq_id'], 'amount' => $row['amount'], 'desc' => $row['desc'], 'item_title' => $row['item_title'], 'item_id' => $row['item_id']);
    }
    echo json_encode($jsonArray);
} else {
    echo 'seq_id is required....';
}