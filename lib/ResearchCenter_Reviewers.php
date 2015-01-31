<?php

require_once 'mysqlConnection.php';
require_once 'CenterResearch.php';
require_once 'Settings.php';

class ResearchCenter_Reviewers {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($Program_id, $Person_id) {
        $stmt = "insert into rcenter_reviewers (program_id,person_id) values (" . $Program_id . "," . $Person_id . ")";
        $conn = new MysqlConnect();
        $res = $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function GetRCenterReviwers($ProgramId) {
        $stmt = "select persons.Person_id,persons.`empCode`,concat(persons.`FirstName_ar`,' ',persons.`FatherName_ar`,' ',persons.`GrandName_ar`,' ',persons.`FamilyName_ar`) as `name`, persons.`Major_Field`, persons.`Speical_Field`, persons.`Email`, persons.`Mobile` from persons left join rcenter_reviewers on rcenter_reviewers.person_id = persons.`Person_id` where rcenter_reviewers.`program_id`=" . $ProgramId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function DeleteByPersonId($PersonId) {
        $stmt = "Delete From rcenter_reviewers Where person_id=" . $PersonId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

}

?>
