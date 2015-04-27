<?php

require_once '../../lib/mysqlConnection.php';
$center_id = filter_input(INPUT_GET, 'center_id');
if (!filter_input(INPUT_GET, 'center_id')) {
    echo 'Center_Id paramter is required...';
} else {
    $conn = new MysqlConnect();
    $stmt = "SELECT DISTINCT seq_id, researches.research_code,title_ar, title_en,research_year,`Status_name`, status_date FROM researches JOIN research_authors ON research_authors.research_id = researches.seq_id JOIN persons ON persons.`Person_id` = research_authors.person_id JOIN reseach_status ON researches.status_id = reseach_status.`Status_Id` WHERE Withdraw=0 and `isCorrsAuthor` =1 AND center_id= " . $center_id . " Order By seq_id";
    $result = $conn->ExecuteNonQuery($stmt);
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $data[] = array('seq_id' => $row['seq_id'],
            'research_code' => $row['research_code'],
            'title_ar' => $row['title_ar'],
            'research_year' => $row['research_year'],
            'Status_name' => $row['Status_name'],
            'status_date' => $row['status_date']
        );
    }
    echo json_encode($data);
}
