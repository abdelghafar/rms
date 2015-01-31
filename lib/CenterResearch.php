<?php
require_once 'mysqlConnection.php';

class CenterResearch {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function GetpairValues() {
        $stmt = "Select id ,center_name From reseacher_centers";
        $connection = new MysqlConnect();
        $rs = $connection->ExecuteNonQuery($stmt);

        $result = Array("PairValues" => Array());
        while ($row = mysql_fetch_array($rs)) {
            array_push($result['PairValues'], Array($row['id'], $row['center_name']));
        }
        return $result;
    }

    public function GetAll() {
        $stmt = "Select id ,center_name From reseacher_centers";
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetResearchCenterByUserName($UserName) {
        $conn = new MysqlConnect();
        $stmt = "SELECT reseacher_centers.id FROM reseacher_centers WHERE user_name =  '$UserName'";
        $result = $conn->ExecuteNonQuery($stmt);
        while ($row = mysql_fetch_array($result)) {
            $centerId = $row['id'];
        }
        return $centerId;
    }

    public function AllCenterResearch($center_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT DISTINCT seq_id, researches.research_code,title_ar, title_en,research_year,`Status_name`, status_date,concat(`FirstName_ar`,' ',`FatherName_ar`,' ',`GrandName_ar`,' ',`FamilyName_ar`) as 'name' FROM researches JOIN research_authors ON research_authors.research_id = researches.seq_id JOIN persons ON persons.`Person_id` = research_authors.person_id JOIN reseach_status ON researches.status_id = reseach_status.`Status_Id` WHERE Withdraw=0 and `isCorrsAuthor` =1 AND center_id= " . $center_id . " Order By seq_id";
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetResearchesList() {
        $conn = new MysqlConnect();
        $stmt = "SELECT distinct researches.seq_id, researches.research_code,title_ar, title_en,research_year,`Status_name`, status_date, reseacher_centers.center_name,concat(`FirstName_ar`,' ',`FatherName_ar`,' ',`GrandName_ar`,' ',`FamilyName_ar`) as 'name',researches.major_field, researches.special_field,researches.budget FROM researches left JOIN research_authors ON research_authors.research_id = researches.seq_id left JOIN persons ON persons.`Person_id` = research_authors.person_id left JOIN reseach_status ON researches.status_id = reseach_status.`Status_Id` join reseacher_centers on reseacher_centers.id = researches.center_id WHERE `isCorrsAuthor` =1 and `Withdraw`=0 order by center_id,researches.research_code";
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetResearchesListByCenterId($center_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT distinct researches.seq_id, researches.research_code,title_ar, title_en,research_year,`Status_name`, status_date, reseacher_centers.center_name,concat(`FirstName_ar`,' ',`FatherName_ar`,' ',`GrandName_ar`,' ',`FamilyName_ar`) as 'name',researches.major_field, researches.special_field,researches.budget FROM researches left JOIN research_authors ON research_authors.research_id = researches.seq_id left JOIN persons ON persons.`Person_id` = research_authors.person_id left JOIN reseach_status ON researches.status_id = reseach_status.`Status_Id` join reseacher_centers on reseacher_centers.id = researches.center_id WHERE `isCorrsAuthor` =1 and `Withdraw`=0 and center_id=$center_id order by center_id,researches.research_code";
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetResearchesByResearcher($ResearcherId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT DISTINCT seq_id, title_ar, title_en, research_code, researches.major_field, special_field, research_year, `FirstName_ar`, `FatherName_ar`, `GrandName_ar`, `FamilyName_ar`, `Status_name`, status_date,center_name, case program when 'ra2d' then 'رائد' when 'ba7th' then 'باحث' when 'wa3da' then 'واعدة' end as 'program' FROM researches JOIN research_authors ON research_authors.research_id = researches.seq_id JOIN persons ON persons.`Person_id` = research_authors.person_id JOIN reseach_status ON researches.status_id = reseach_status.`Status_Id` join reseacher_centers on reseacher_centers.id = researches.center_id WHERE `isCorrsAuthor`=1 and `Withdraw`=0 and research_authors.person_id = " . $ResearcherId;

        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetResearchesByResearcherAndProgram($ResearcherId, $program) {
        $conn = new MysqlConnect();
        $stmt = "SELECT DISTINCT seq_id, title_ar, title_en, research_code, researches.major_field, special_field, research_year, `FirstName_ar`, `FatherName_ar`, `GrandName_ar`, `FamilyName_ar`, `Status_name`, status_date,center_name, case program when 'ra2d' then 'رائد' when 'ba7th' then 'باحث' when 'wa3da' then 'واعدة' end as 'program' FROM researches JOIN research_authors ON research_authors.research_id = researches.seq_id JOIN persons ON persons.`Person_id` = research_authors.person_id JOIN reseach_status ON researches.status_id = reseach_status.`Status_Id` join reseacher_centers on reseacher_centers.id = researches.center_id WHERE `isCorrsAuthor`=1 and `Withdraw`=0 and program='" . $program . "' and research_authors.person_id = " . $ResearcherId;

        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function getAllStatus() {

        $conn = new MysqlConnect();
        $stmt = "Select Status_Id, Status_name from reseach_status order by Status_Id ";
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Save_Research_Track($id, $research_id, $research_status, $track_date, $notes) {

        $conn = new MysqlConnect();
        $stmt = "";
        if ($id == 0) {
            $stmt = "Insert into reseach_track(research_id, Status_Id, track_date, notes) values(" . $research_id . ", " . $research_status . ", '" . $track_date . "', '" . $notes . "' ) ";

            $result = $conn->ExecuteNonQuery($stmt);
            return $result;
        } else {
            
        }
    }

    public function update_research_status(
    $research_id, $research_status, $track_date) {

        $conn = new MysqlConnect();
        $stmt = "";
        $stmt = "  Select Status_Date from researches where seq_id = " . $research_id;
        $rs = mysql_query($stmt);
        while ($row = mysql_fetch_array($rs)) {
            $last_status_date = $row["Status_Date"];
        }
        $exist_date = strtotime($last_status_date);
        $new_date = strtotime($track_date);

        if ($new_date >= $exist_date) {

            $stmt = "update researches set status_id = " . $research_status . ", status_date = '" . $track_date . "' where seq_id = " . $research_id;

            $result = $conn->ExecuteNonQuery($stmt);
            return $result;
        } else {
            return 1;
        }
    }

    public function IsExist($research_id, $research_status, $track_date) {
        $stmt = "Select seq_id from reseach_track where research_id = " . $research_id . " AND Status_Id = " . $research_status . " AND track_date = '" . $track_date . "'";
        $result = mysql_query($stmt);
        $id = 0;
        while ($row = mysql_fetch_array($result)) {
            $id = $row["seq_id"];
        }

        if ($id == 0)
            return 0; //this record not exist
        else
            return 1; //this record name exists 
    }

    public function getResearchAllStatus($Researcher_Id) {
        $conn = new MysqlConnect();
        $stmt = "select DISTINCT reseach_status.`Status_name`, reseach_track.track_date, reseach_track.notes From reseach_track join reseach_status on reseach_track.`Status_Id` = reseach_status.`Status_Id` where reseach_track.research_id = " . $Researcher_Id . " order By track_date desc";

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetCenterCode($CenterId) {
        $stmt = "select center_code from reseacher_centers where `id` = " . $CenterId;
        $result = mysql_query($stmt);
        $Code = 0;
        while ($row = mysql_fetch_array($result)) {
            $Code = $row["center_code"];
        }
        return $Code;
    }

    public function GetLstOfResearchReviwers(
    $CenterId) {
        $stmt = "select research_review.seq_id, researches.research_code, researches.title_ar, research_review.submission_date, reseach_status.`Status_name`, concat(persons.`FirstName_ar`, ' ', persons.`FatherName_ar`, ' ', persons.`GrandName_ar`, ' ', persons.`FamilyName_ar`) as `reveiwer_name`, persons.email as `reviewer_email`, reseacher_centers.center_name, review_phase.`Phase_Title`, research_review.submission_date, research_review.responce_date, research_review.attachment_url, research_review.notes, users.user_name from research_review join persons on persons.`Person_id` = research_review.reviewer_person_id join researches on research_review.research_id = researches.seq_id join reseach_status on reseach_status.`Status_Id` = research_review.`responce_Status_id` join reseacher_centers on reseacher_centers.id = researches.center_id join review_phase on review_phase.`Phase_id` = research_review.`Phase_id` join users on users.person_id = persons.Person_id  where researches.center_id = " . $CenterId;
        $conn = new MysqlConnect();
        return $conn->ExecuteNonQuery($stmt);
    }

    public function GetRCenterNameById($center_id) {
        $stmt = "select reseacher_centers.center_name from reseacher_centers where reseacher_centers.id=" . $center_id;
        $result = mysql_query($stmt);
        while ($row = mysql_fetch_array($result)) {
            $name = $row["center_name"];
        }
        return $name;
    }

    public function AllCenterResearchJsonTest() {
        $conn = new MysqlConnect();
        $stmt = "SELECT DISTINCT seq_id, researches.research_code,title_ar, title_en,research_year,`Status_name`, status_date FROM researches JOIN research_authors ON research_authors.research_id = researches.seq_id JOIN persons ON persons.`Person_id` = research_authors.person_id JOIN reseach_status ON researches.status_id = reseach_status.`Status_Id` WHERE Withdraw=0 and `isCorrsAuthor` =1 AND center_id= 8";
        $result = $conn->ExecuteNonQuery($stmt);

        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $customers[] = array(
                'seq_id' => $row['seq_id'],
                'research_code' => $row['research_code'],
                'title_ar' => $row['title_ar'],
                'title_en' => $row['title_en'],
                'research_year' => $row['research_year']
            );
        }
        echo json_encode($customers);
    }

}
?>