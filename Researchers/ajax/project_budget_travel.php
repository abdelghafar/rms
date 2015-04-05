<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';
require_once '../../lib/project_budget_travel.php';
$conn = new MysqlConnect();
if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $t = new project_budget_travel();
    $stmt = 'select project_budget.seq_id, project_budget.amount, project_budget.`desc`, budget_items.item_title , budget_items.item_title_en  from project_budget join budget_items on project_budget.item_id= budget_items.item_id where budget_items.parent_item_id=' . $t->travel_code() . ' and project_budget.project_id=' . $project_id;
    $rs = $conn->ExecuteNonQuery($stmt);
    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $result[] = array(
            'seq_id' => $row['seq_id'],
            'amount' => $row['amount'],
            'desc' => $row['desc'],
            'item_title' => $row['item_title_en'] ." / " . $row['item_title']
        );
    }
    echo json_encode($result);
} else {
    echo json_encode('Parameters are Required...');
} 
