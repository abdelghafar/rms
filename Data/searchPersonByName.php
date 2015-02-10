<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$conn = new MysqlConnect();
if (isset($_GET['q'])) {
    $nameString = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
    $stmt = "SELECT `Person_id`,`Position`,`Major_Field`,`Speical_Field`,`College`,`Dept`,`Email`,`name_ar`,`name_en`  
FROM  `persons` WHERE  `name_ar` LIKE  '%" . $nameString . "%' OR  `name_en` LIKE  '%" . $nameString . "%'";
    $result = $conn->ExecuteNonQuery($stmt);
    while ($row = mysql_fetch_array($result)) {
        $person[] = array('person_id' => $row['Person_id'], 'name_ar' => $row['name_ar'], 'name_en' => $row['name_en'], 'Major_Field' => $row['Major_Field'], 'Speical_Field' => $row['Speical_Field'], 'College' => $row['College'], 'Dept' => $row['Dept'], 'Email' => $row['Email'], 'Position' => $row['Position']);
    }
    echo json_encode($person);
} else {
    echo 'paramter required...';
}

