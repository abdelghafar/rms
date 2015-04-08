<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';


$conn = new MysqlConnect();

if (isset($_REQUEST['project_id'])) {
    $stmt = "SELECT p.person_id,name_ar, sr.role_name, sr.seq_id FROM persons p INNER JOIN research_stuff rs ON p.person_id = rs.person_id INNER JOIN stuff_roles sr ON rs.role_id = sr.seq_id WHERE research_id =" . $_REQUEST['project_id'] . " ORDER BY seq_id";
    $result = $conn->ExecuteNonQuery($stmt);
    $jsonArray = array();
    while ($row = mysql_fetch_array($result)) {
        $jsonArray[] = array('person_id' => $row['person_id'], 'person_name' => $row['name_ar'] . " -- " . $row['role_name']);
    }
    echo json_encode($jsonArray);
}