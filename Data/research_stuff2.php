<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';
require_once '../lib/persons.php';

$conn = new MysqlConnect();

if (isset($_REQUEST['project_id'])) {
    $stmt = "SELECT rs.seq_no,rs.person_id,rs.type, sr.role_name, sr.seq_id
        FROM research_stuff rs INNER JOIN stuff_roles sr ON rs.role_id = sr.seq_id WHERE research_id =" . $_REQUEST['project_id'] . " ORDER BY seq_id";
    $result = $conn->ExecuteNonQuery($stmt);
    $jsonArray = array();
    while ($row = mysql_fetch_array($result)) {
        $jsonArray[] = array('research_stuff_id' => $row['seq_no'], 'role_person' => $row['role_name']);
    }
    echo json_encode($jsonArray);
}