<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';
$conn = new MysqlConnect();
if (isset($_GET['q'])) {
    $projectId = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $stmt = "SELECT research_stuff.seq_no , role_name , parent_role_id FROM research_stuff join stuff_roles ON research_stuff.role_id = stuff_roles.seq_id where research_id = " . $projectId . " and type='role_based' and stuff_roles.parent_role_id in (select seq_id from stuff_roles where stuff_roles.parent_role_id=4)";
    //echo $stmt;
    $rs = $conn->ExecuteNonQuery($stmt);
    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $result[] = array(
            'seq_no' => $row['seq_no'],
            'role_name' => $row['role_name'],
            'parent_role_id' => $row['parent_role_id'],
            'parent_role' => ''
        );
    }

    for ($i = 0; $i < count($result); $i++) {
        $stmt = "SELECT role_name FROM stuff_roles where seq_id=" . $result[$i]['parent_role_id'];
        $rs = $conn->ExecuteNonQuery($stmt);
        $parent_role = "";
        while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
            $parent_role = $row['role_name'];
        }
        $result[$i]['parent_role'] = $parent_role;
    }
    echo json_encode($result);
} else {
    echo json_encode('Parameters are Required...');
}
