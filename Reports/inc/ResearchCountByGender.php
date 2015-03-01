<?php

require_once '../../lib/mysqlConnection.php';

function ResearchCountByGender($year, $gender) {
    $stmt = "select count(distinct research_id) as `count` from research_authors join persons on persons.`Person_id`=research_authors.person_id join researches on researches.seq_id=research_authors.research_id where `isCorrsAuthor`=1 and `Withdraw`=0 and persons.`Gender`=$gender and research_year=$year";
    $conn = new MysqlConnect();
    $rs = $conn->ExecuteNonQuery($stmt);
    while ($row = mysql_fetch_array($rs)) {
        $ResultSet = $row['count'];
    }
    return $ResultSet;
}

?>