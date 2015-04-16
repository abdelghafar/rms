<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';
$conn = new MysqlConnect();
if (isset($_GET['id']) & isset($_GET['p']) && isset($_GET['q'])) {
    $ResearcherId = $_GET['id'];
    $program = $_GET['p'];
    $isDraft = $_GET['q'];

    $stmt = "SELECT DISTINCT seq_id, title_ar, title_en, research_code, researches.major_field, special_field, research_year,  `FirstName_ar` ,  `FatherName_ar` ,  `GrandName_ar` ,  `FamilyName_ar` ,  `Status_name` , status_date, center_name,CASE program WHEN  'ra2d' THEN  'رائد' WHEN  'ba7th' THEN  'باحث' WHEN  'wa3da'THEN  'واعدة'END AS  'program' FROM researches JOIN research_stuff ON research_stuff.research_id = researches.seq_id JOIN persons ON persons.`Person_id` = research_stuff.person_id JOIN reseach_status ON researches.status_id = reseach_status.`Status_Id` JOIN reseacher_centers ON reseacher_centers.id = researches.center_id WHERE  `role_id` =1 AND  `Withdraw` =0 AND program =" . $program . " and research_stuff.person_id = " . $ResearcherId . " and isDraft=" . $isDraft;
    //echo $stmt;
    $rs = $conn->ExecuteNonQuery($stmt);
    $r = 0;
    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $result[] = array(
            'seq_id' => $row['seq_id'],
            'title_ar' => $row['title_ar'],
            'status_date' => $row['status_date'],
            'status_name' => $row['Status_name']
        );
    }
    echo json_encode($result);
} else {
    echo json_encode('Parameters are Required...');
} 