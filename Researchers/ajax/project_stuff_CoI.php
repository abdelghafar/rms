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
    $stmt = "SELECT research_stuff.seq_no,persons.Position,persons.Email,name_ar,stuff_roles.role_name,persons.empCode from persons join research_stuff on research_stuff.person_id = persons.Person_id  join stuff_roles on stuff_roles.seq_id = research_stuff.role_id where research_stuff.research_id=" . $projectId . " and research_stuff.role_id =2";
    $rs = $conn->ExecuteNonQuery($stmt);
    $r = 0;
    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $result[] = array(
            'seq_no' => $row['seq_no'],
            'name_ar' => $row['name_ar'],
            'role_name' => $row['role_name'],
            'empCode' => $row['empCode'],
            'position' => $row['Position'],
            'email' => $row['Email']
        );
    }
    echo json_encode($result);
} else {
    echo json_encode('Parameters are Required...');
} 
