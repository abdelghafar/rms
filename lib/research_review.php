<?php

require_once 'mysqlConnection.php';

class Research_Review {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($seq_id, $reviewer_person_id, $research_id, $submission_date, $responce_Status_id, $responce_date, $attachment_url, $notes, $phase_id) {
        $conn = new MysqlConnect();
        if ($seq_id == 0) {
            $stmt = "INSERT INTO research_review (reviewer_person_id,research_id,submission_date,responce_Status_id,responce_date,attachment_url,notes,phase_id) Values(" . $reviewer_person_id . ',' . $research_id . ",'" . $submission_date . "'," . $responce_Status_id . ",'" . $responce_date . "','" . $attachment_url . "','" . $notes . "'," . $phase_id . ")";

            return $conn->ExecuteNonQuery($stmt);
        } else {
            $stmt = "update research_review set reviewer_person_id=" . $reviewer_person_id . ", research_id=" . $research_id . " , submission_date= '" . $submission_date . "', responce_Status_id =" . $responce_Status_id . ", responce_date = '" . $responce_date . "', attachment_url = '" . $attachment_url . "', notes='" . $notes . "',Phase_id=" . $phase_id . " where seq_id=" . $seq_id . "";

            return $conn->ExecuteNonQuery($stmt);
        }
    }

    public function SetReviewerReply($reviewer_person_Id, $research_Id, $responce_Status_id, $responce_date, $attachment_url, $notes, $Phase_Id) {
        $stmt = "update research_review set research_review.`responce_Status_id`=" . $responce_Status_id . ",research_review.responce_date='" . $responce_date . "', research_review.attachment_url ='" . $attachment_url . "' ,research_review.notes = '" . $notes . "' where `Phase_id`=" . $Phase_Id . " and research_review.reviewer_person_id=" . $reviewer_person_Id . " and research_id=" . $research_Id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
    }

    public function GetReviwerLstOfResearches($reviewer_person_id) {
        $stmt = "select research_review.seq_id,research_id,submission_date,research_code,title_ar,title_en from research_review left join researches on research_review.research_id= researches.seq_id  where status_id=3 and research_review.`responce_Status_id`=5 and reviewer_person_id=" . $reviewer_person_id . " order by submission_date";
        $conn = new MysqlConnect();
        return $conn->ExecuteNonQuery($stmt);
    }

    public function GetResearchReviewers($researchId, $phaseId) {
        $stmt = "select concat(persons.`FirstName_ar`,' ',persons.FatherName_ar,' ',persons.GrandName_ar,' ',FamilyName_ar) as `name_ar`,research_review.submission_date,Status_name,research_review.responce_date,research_review.Phase_id from research_review join persons on persons.`Person_id`=research_review.reviewer_person_id join reseach_status on reseach_status.Status_Id = research_review.responce_Status_id where research_review.research_id=" . $researchId . " and research_review.`Phase_id`=" . $phaseId;
        $conn = new MysqlConnect();
        return $conn->ExecuteNonQuery($stmt);
    }

}
