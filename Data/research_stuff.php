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
    $stmt = "SELECT rs.seq_no,rs.person_id,rs.type, sr.role_name, sr.seq_id
        FROM research_stuff rs INNER JOIN stuff_roles sr ON rs.role_id = sr.seq_id WHERE research_id =" . $_REQUEST['project_id'] . " ORDER BY seq_id";
    //echo $stmt;
    $result = $conn->ExecuteNonQuery($stmt);
    $jsonArray = array();
    while ($row = mysql_fetch_array($result)) {
        if ($row['type'] === 'role_based') {
            $role_person = $row['role_name'];
        } else {
            $stmt = "SELECT name_ar FROM persons Where Person_id=" . $row['person_id'];
            $person_result = mysql_query($stmt);
            while ($person_row = mysql_fetch_array($person_result)) {
                $name_ar = $person_row['name_ar'];
            }
            $role_person = $name_ar . " -- " . $row['role_name'];
        }
        $jsonArray[] = array(
            'research_stuff_id' => $row['seq_no'],
            'role_person' => $role_person);
    }
    echo json_encode($jsonArray);
}