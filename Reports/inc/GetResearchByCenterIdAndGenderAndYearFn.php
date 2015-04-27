<?php

require_once '../../lib/mysqlConnection.php';

function GetResearchByCenterIdAndGenderAndYearFn($year, $Gender, $center_id) {

    $conn = new MysqlConnect();
    $stmt = "select distinct research_id,research_code,researches.title_ar,concat(persons.`FirstName_ar`,' ',persons.`FatherName_ar`,' ',persons.`GrandName_ar`,' ',persons.`FamilyName_ar`) as `name_ar`  from research_authors join persons on persons.`Person_id`=research_authors.person_id join researches on researches.seq_id=research_authors.research_id where `isCorrsAuthor`=1 and `Withdraw`=0 and persons.`Gender`=$Gender and research_year=$year and center_id=$center_id ";

    $result = $conn->ExecuteNonQuery($stmt);

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $list[] = array(
            'research_id' => $row['research_id'],
            'research_code' => $row['research_code'],
            'title_ar' => $row['title_ar'],
            'name_ar' => $row['name_ar']
        );
    }
    $count = 0;
    if (count($list) > 0)
        $count = count($list);
    return $count;
}

?>
