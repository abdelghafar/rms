<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$conn = new MysqlConnect();

if (isset($_GET['empcode'])) {
    $empCode = $_GET['empcode'];
    $stmt = "select person_id, concat(`FirstName_ar`,' ',`FatherName_ar`,' ',`GrandName_ar`,' ',`FamilyName_ar`) as  `name`, case (`Gender`) when 1 then 'أنثي' else 'ذكر' end as `gender`, `Major_Field`, `Speical_Field`,`College`, `Dept`, `empCode`, `Email` from persons where `empCode`=" . $empCode . " limit 0,1";
    $result = $conn->ExecuteNonQuery($stmt);
    $jsonArray = array();
    while ($row = mysql_fetch_array($result)) {
        $person[] = array('person_id' => $row['person_id'], 'name' => $row['name'], 'gender' => $row['gender'], 'Major_Field' => $row['Major_Field'], 'Speical_Field' => $row['Speical_Field'], 'College' => $row['College'], 'Dept' => $row['Dept'], 'empCode' => $row['empCode'], 'Email' => $row['Email']);
    }
    echo json_encode($person);
} else {
    echo json_encode('Parameter Required...');
} 

