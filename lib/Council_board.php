<?php

require_once 'mysqlConnection.php';

class Council_board
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($center_Id, $person_Id)
    {
        $stmt = "insert into council_board (center_id,person_id) values(" . $center_Id . "," . $person_Id . ")";
        $con = new MysqlConnect();
        return $con->ExecuteNonQuery($stmt);
    }

    public function GetCouncilBoardLstOfResearches($person_id)
    {
        $stmt = "select research_review.seq_id,research_id,submission_date,research_code,title_ar,title_en from research_review left join researches on research_review.research_id= researches.seq_id  where status_id=1 and research_review.`responce_Status_id`!=3 and research_review.`responce_Status_id`!=4 and reviewer_person_id=" . $person_id . " and `Phase_id`=1 order by submission_date";
        $conn = new MysqlConnect();
        return $conn->ExecuteNonQuery($stmt);
    }

    public function GetCouncilBoardMembers($CenterId)
    {
        $stmt = "select persons.Person_id,persons.`empCode`,concat(persons.`FirstName_ar`,' ',persons.`FatherName_ar`,' ',persons.`GrandName_ar`,' ',persons.`FamilyName_ar`) as `name`, persons.`Major_Field`, persons.`Speical_Field`, persons.`Email`, persons.`Mobile` from persons left join council_board on council_board.person_id = persons.`Person_id` where council_board.center_id=" . $CenterId;
        $conn = new MysqlConnect();
        return $conn->ExecuteNonQuery($stmt);
    }

    public function DeleteByPerosnId($personId)
    {
        $stmt = 'Delete From council_board Where person_id=' . $personId;
        $conn = new MysqlConnect();
        return $conn->ExecuteNonQuery($stmt);
    }

}

?>
