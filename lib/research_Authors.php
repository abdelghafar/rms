<?php

require_once 'mysqlConnection.php';

class research_Authors {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($research_id, $person_id, $isCorrsAuthor) {
        $conn = new MysqlConnect();
        $stmt = "Insert into research_authors (research_id,person_id,isCorrsAuthor) Values(" . $research_id . "," . $person_id . "," . $isCorrsAuthor . ")";
        return $conn->ExecuteNonQuery($stmt);
    }

    public function SetCorrAuthor($PersonId, $ResearchId) {
        //Remove Any Other Corrs Author
        $stmt = "Delete From research_authors where research_id=" . $ResearchId . " and isCorrsAuthor=1";
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        //Set Corrs Author
        $stmt = "Insert into research_authors (research_id,person_id,isCorrsAuthor) Values(" . $ResearchId . "," . $PersonId . ",1)";
        $conn->ExecuteNonQuery($stmt);
    }

    public function GetNonCorrsResearchAuthors($ResearchId) {
        $conn = new MysqlConnect();
        $stmt = "select research_authors.person_id,research_authors.`isCorrsAuthor`, concat(persons.`FirstName_ar`, ' ', persons.`FatherName_ar`, ' ', persons.`GrandName_ar`, ' ' ,persons.`FamilyName_ar`) as `name_ar`, concat(persons.`FirstName_en`, ' ', persons.`FatherName_en`, ' ', persons.`GrandName_en`, ' ' ,persons.`FamilyName_en`) as `name_en` from research_authors join persons on persons.`Person_id`= research_authors.person_id where research_authors.research_id = " . $ResearchId . " and research_authors.isCorrsAuthor=0";
        return $conn->ExecuteNonQuery($stmt);
    }

    public function GetCorrAuthor($Research_Id) {
        $conn = new MysqlConnect();
        $stmt = "select distinct research_authors.person_id from research_authors where `isCorrsAuthor`=1 and research_id=$Research_Id";
        $rs = $conn->ExecuteNonQuery($stmt);
        while ($row = mysql_fetch_array($rs)) {
            $person_id = $row[0];
        }
        return $person_id;
    }

    public function CountResearches($ResearchId) {
        $conn = new MysqlConnect();
        $stmt = "select count(person_id) from research_authors where person_id=" . $ResearchId;
        $rs = $conn->ExecuteNonQuery($stmt);
        $count = 0;
        while ($row = mysql_fetch_array($rs)) {
            $count = $row[0];
        }
        return $count;
    }

    public function DeleteAuthor($ResearchId, $PersonId) {
        $conn = new MysqlConnect();
        $stmt = "Delete From research_authors where research_id=" . $ResearchId . " and person_id=" . $PersonId;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

}
