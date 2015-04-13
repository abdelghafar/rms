<?php

require_once 'mysqlConnection.php';
require_once 'CenterResearch.php';
require_once 'Settings.php';
require_once 'technologies.php';

class Reseaches
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($seqId, $title_ar, $title_en, $proposed_duration, $major_field, $speical_field, $reseach_code, $Approve_session_no, $Approve_date, $abstract_ar_url, $abstract_en_url, $introduction_url, $literature_review_url, $url, $Status_id, $Status_date, $center_id, $research_year, $program, $typeId, $keywords)
    {
        $conn = new MysqlConnect();
        $stmt = "";
        if ($seqId == 0) {
            $obj = new Settings();
            $round = $obj->GetCurrRound();
            $stmt = "INSERT INTO  researches (title_ar,title_en,proposed_duration,major_field,special_field,research_code,Approve_session_no,Approve_date,abstract_ar_url,abstract_en_url,introduction_url,literature_review_url,url,Status_Id,Status_Date,center_id,research_year,program,round,type_id,keywords,isDraft) Values('" . $title_ar . "','" . $title_en . "'," . $proposed_duration . ",'" . $major_field . "','" . $speical_field . "','" . $reseach_code . "','" . $Approve_session_no . "','" . $Approve_date . "','" . $abstract_ar_url . "','" . $abstract_en_url . "','" . $introduction_url . "','" . $literature_review_url . "','" . $url . "'," . $Status_id . ",'" . $Status_date . "'," . $center_id . ",'" . $research_year . "'," . $program . "," . $round . "," . $typeId . ",'" . $keywords . "',1)";
            $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        }
    }

    public function UpdateIntro($seqId, $title_ar, $title_en, $proposed_duration, $techId, $trackId, $subtrackId, $typeId, $keywords)
    {
        $conn = new MysqlConnect();
        $stmt = "update researches set title_ar='" . $title_ar . "',title_en='" . $title_en . "'," . " proposed_duration=" . $proposed_duration . ",major_field=" . $trackId . ",special_field=" . $subtrackId . ",center_id=" . $techId . ",type_id=" . $typeId . ",keywords='" . $keywords . "' where seq_id=" . $seqId;
        return $conn->ExecuteNonQuery($stmt);
    }

    public function IsExist($title_ar)
    {
        $stmt = "SELECT seq_id FROM researches WHERE title_ar= '" . $title_ar . "'";
        $result = mysql_query($stmt);
        $seq_id = 0;
        while ($row = mysql_fetch_array($result)) {
            $seq_id = $row[0];
        }
        return $seq_id;
    }

    public function Delete($ResearchId)
    {
        $con = new MysqlConnect();
        $stmt = "Delete From research_authors Where research_id=" . $ResearchId;
        $con->ExecuteNonQuery($stmt);
        $stmt = "Delete From reseach_track Where research_id=" . $ResearchId;
        $con->ExecuteNonQuery($stmt);
        $stmt = "Delete From research_docs Where research_id=" . $ResearchId;
        $con->ExecuteNonQuery($stmt);
        $stmt = "Delete From research_review Where research_id=" . $ResearchId;
        $con->ExecuteNonQuery($stmt);
        $stmt = "Delete From researches Where seq_id=" . $ResearchId;
        $con->ExecuteNonQuery($stmt);
    }

    public function GetResearchesCount($year)
    {
        $stmt = "SELECT count(seq_id) as `count` FROM researches where withDraw=0 and `research_year`=$year";
        $result = mysql_query($stmt);
        $count = 0;
        while ($row = mysql_fetch_array($result)) {
            $count = $row[0];
        }
        return $count;
    }

    public function GetResearchesBudget($year)
    {
        $stmt = "select sum(budget) from researches where research_year=$year and `Withdraw`=0";
        $result = mysql_query($stmt);
        $count = 0;
        while ($row = mysql_fetch_array($result)) {
            $count = $row[0];
        }
        return $count;
    }

    public function GetResearchCode($ResearchId)
    {
        $stmt = "select researches.research_code from researches where seq_id=" . $ResearchId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $ResearchCode = 0;
        while ($row = mysql_fetch_array($result)) {
            $ResearchCode = $row[0];
        }
        return $ResearchCode;
    }

    public function GetResearchId($ResearchCode)
    {
        $stmt = "select researches.seq_id from researches where research_code=" . $ResearchCode;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $ResearchId = 0;
        while ($row = mysql_fetch_array($result)) {
            $ResearchId = $row[0];
        }
        return $ResearchId;
    }

    /*
 * code in the form Yr$PIO$Round_number$Program_code$Serial
 *                  2$3$1$1$4 = 11 digits
 */

    public function GenerateResearchCode($project_id)
    {
        $setting = new Settings();
        $year = $setting->GetCurrYear();
        $yr = $year[2] . $year[3];

        $research_obj = new Reseaches();
        $research = $research_obj->GetResearch($project_id);
        $tech_id = $research['center_id'];
        $tech = new Technologies();
        $tech_code = $tech->GetTechCode($tech_id);

        $round = $setting->GetCurrRound();

        $program_code = $research['program'];
        $serial = 1;

        $stmt = "Select count(*) as `count` From researches where research_year=" . $year . " and center_id=" . $tech_id . " and round=" . $round . " and program=" . $program_code . " and isDraft=0";
        $con = new MysqlConnect();
        $rs = $con->ExecuteNonQuery($stmt);
        while ($row = mysql_fetch_array($rs)) {
            $serial = $row['count'];
        }

        $formatted_serial = sprintf("%04d", $serial);
        $code = $yr . '$' . $tech_code . '$' . $round . '$' . $program_code . '$' . $formatted_serial;
        return $code;
    }

    public function UpdateResearchCode($research_id, $code)
    {
        $conn = new MysqlConnect();
        $stmt = "Update researches set research_code='" . $code . "' where seq_id=" . $research_id;
        $rs = $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetListOfResearchPerResearcherId($researcherId)
    {
        $connection = new MysqlConnect();
        $settings = new Settings();
        $year = $settings->GetCurrYear();

        $stmt = "select researches.seq_id,researches.research_code From researches join research_authors on research_authors.research_id = researches.seq_id where research_authors.person_id = " . $researcherId . " and researches.research_year= " . $year;
        $rs = $connection->ExecuteNonQuery($stmt);

        $result = Array("PairValues" => Array());
        while ($row = mysql_fetch_array($rs)) {
            array_push($result['PairValues'], Array($row['seq_id'], $row['research_code']));
        }
        return $result;
    }

    public function GetResearchDetails($ResearchId)
    {
        $stmt = "select researches.title_ar, researches.title_en,researches.major_field ,researches.special_field, researches.proposed_duration, researches.research_code, researches.abstract_ar, researches.abstract_en, researches.url,center_name FROM researches join reseacher_centers on researches.center_id=reseacher_centers.id where researches.seq_id = " . $ResearchId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetListOfResearchMin()
    {
        $stmt = "select researches.seq_id, researches.research_code,researches.title_ar,researches.research_year, reseacher_centers.center_name,reseach_status.`Status_name`,review_phase.`Phase_Title` From researches join reseacher_centers on researches.center_id = reseacher_centers.id join reseach_status on researches.status_id = reseach_status.`Status_Id` join review_phase on review_phase.`Phase_id` = reseach_status.`Phase_id` order by seq_id desc";
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetResearchDetailsMin($Research_Id)
    {
        $stmt = "select `researches`.seq_id, `researches`.title_ar,researches.title_en ,`researches`.research_code, `researches`.research_year, `researches`.keywords, technologies.title as `tech_title`,reseach_status.`Status_name`,reseach_status.`Status_Id`,`persons`.`empCode`, persons.name_ar , persons.name_en , tracks.track_name, subtracks.subTrack_name, researches.proposed_duration, project_types.title as 'type_title' , project_types.title_en  as 'type_title_en' from `researches` join `reseacher_centers` on `researches`.center_id=`reseacher_centers`.id join `persons` on `persons`.`Person_id` join reseach_status on reseach_status.`Status_Id` = researches.status_id join technologies on technologies.seq_id = researches.center_id join tracks on tracks.track_id = researches.major_field join subtracks on subtracks.seq_id = researches.special_field join project_types on researches.type_id = project_types.seq_id where `persons`.`Person_id` in (select research_stuff.person_id from research_stuff where research_stuff.role_id = 1 and research_id=$Research_Id) and `researches`.seq_id=$Research_Id";
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function Withdraw($ResearchId)
    {
        $stmt = "update researches set `Withdraw` = 1 , `withdrawDate` = now() where seq_id =" . $ResearchId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetResearch($ResearchId)
    {
        $stmt = "SELECT  `seq_id` ,  `title_ar` ,  `title_en` ,  `proposed_duration` ,  `major_field` ,  `special_field` ,  `research_code` ,  `Approve_session_no` ,  `Approve_date` ,  `url` ,  `abstract_ar_url` ,  `abstract_en_url` ,  `status_id` , `status_date` ,  `center_id` ,  `research_year` ,  `RequiresUpdate` ,  `LastUpdate` ,  `isLocked` ,  `lockFrom` ,  `lockUntill` ,  `Withdraw` ,  `withdrawDate` ,  `type_id` , `keywords` , `program` FROM  `researches` WHERE seq_id =" . $ResearchId;

        $conn = new MysqlConnect();
        $resultSet = $conn->ExecuteNonQuery($stmt);
        while ($row = mysql_fetch_array($resultSet)) {
            $result = array('seq_id' => $row['seq_id'],
                'title_ar' => $row['title_ar'],
                'title_en' => $row['title_en'],
                'proposed_duration' => $row['proposed_duration'],
                'major_field' => $row['major_field'],
                'special_field' => $row['special_field'],
                'research_code' => $row['research_code'],
                'Approve_session_no' => $row['Approve_session_no'],
                'Approve_date' => $row['Approve_date'],
                'url' => $row['url'],
                'abstract_ar' => $row['abstract_ar_url'],
                'abstract_en' => $row['abstract_en_url'],
                'status_id' => $row['status_id'],
                'status_date' => $row['status_date'],
                'center_id' => $row['center_id'],
                'research_year' => $row['research_year'],
                'RequiresUpdate' => $row['RequiresUpdate'],
                'LastUpdate' => $row['LastUpdate'],
                'isLocked' => $row['isLocked'],
                'lockFrom' => $row['lockFrom'],
                'lockUntill' => $row['lockUntill'],
                'Withdraw' => $row['Withdraw'],
                'withdrawDate' => $row['withdrawDate'],
                'type_id' => $row['type_id'],
                'keywords' => $row['keywords'],
                'program' => $row['program']
            );
        }
        return $result;
    }

    //Get, set Abstract_ar_url
    public function SetAbstract_ar_url($projectId, $url)
    {
        $stmt = "update researches set `abstract_ar_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetAbstract_ar_url($projectId)
    {
        $stmt = "Select abstract_ar_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //Get set Abstract_en_url
    public function SetAbstract_en_url($projectId, $url)
    {
        $stmt = "update researches set `abstract_en_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetAbstract_en_url($projectId)
    {
        $stmt = "Select abstract_en_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //---------get set introduction_url--------------------------------------
    public function SetIntro_url($projectId, $url)
    {
        $stmt = "update researches set `introduction_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetIntro_url($projectId)
    {
        $stmt = "Select introduction_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //----get set review ------------------------------------------------------
    public function SetLitReview_url($projectId, $url)
    {
        $stmt = "update researches set `literature_review_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetLitReview_url($projectId)
    {
        $stmt = "Select literature_review_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //----get set research_method_url ------------------------------------------------------
    public function SetResearch_method_url($projectId, $url)
    {
        $stmt = "update researches set `research_method_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetResearch_method_url($projectId)
    {
        $stmt = "Select research_method_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //----get set objective_tasks_url ------------------------------------------------------
    public function SetObjective_tasks_url($projectId, $url)
    {
        $stmt = "update researches set `objective_tasks_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetObjective_tasks_url($projectId)
    {
        $stmt = "Select objective_tasks_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //----get set objective_approach_url ------------------------------------------------------
    public function SetObjective_approach_url($projectId, $url)
    {
        $stmt = "update researches set `objective_approach_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetObjective_approach_url($projectId)
    {
        $stmt = "Select objective_approach_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //----get set working plan url ------------------------------------------------------
    public function SetWorkingPlanUrl($projectId, $url)
    {
        $stmt = "update researches set `working_plan_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetWorkingPlanUrl($projectId)
    {
        $stmt = "Select working_plan_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //----get set value to kingdom url ------------------------------------------------------
    public function SetValueToKingdomUrl($projectId, $url)
    {
        $stmt = "update researches set `value_to_kingdom_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetValueToKingdomUrl($projectId)
    {
        $stmt = "Select value_to_kingdom_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //----get set budget url ------------------------------------------------------
    public function SetBudgetUrl($projectId, $url)
    {
        $stmt = "update researches set `budget_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetBudgetUrl($projectId)
    {
        $stmt = "Select budget_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //----get set outcome objectives url ------------------------------------------------------
    public function SetOutcomeObjectiveUrl($projectId, $url)
    {
        $stmt = "update researches set `outcome_objective_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetOutcomeObjectiveUrl($projectId)
    {
        $stmt = "Select outcome_objective_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //refs_url
    public function SetRefsUrl($projectId, $url)
    {
        $stmt = "update researches set `refs_url` = '" . $url . "' where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetRefsUrl($projectId)
    {
        $stmt = "Select refs_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //Get / set url of generated file
    public function GetURL($project_id)
    {
        $stmt = "Select url From researches where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    public function SetURL($project_id, $url)
    {
        $stmt = "update researches set `url` = '" . $url . "' where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    //-----------------------
    //Get/set introduction text
    public function GetIntroductionText($project_id)
    {
        $stmt = "Select introduction_text From researches where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    public function SetIntroductionText($project_id, $data)
    {
        $stmt = "update researches set `introduction_text` = '" . $data . "' where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    //Get/set abstract_ar text
    public function GetAbstractArText($project_id)
    {
        $stmt = "Select abstract_ar_text From researches where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    public function SetAbstractArText($project_id, $data)
    {
        $stmt = "update researches set `abstract_ar_text` = '" . $data . "' where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    //Get/set abstract_en text
    public function GetAbstractEnText($project_id)
    {
        $stmt = "Select abstract_en_text From researches where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    public function SetAbstractEnText($project_id, $data)
    {
        $stmt = "update researches set `abstract_en_text` = '" . $data . "' where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    //Get/set value_to_kingdom_text
    public function GetValueToKingdomText($project_id)
    {
        $stmt = "Select value_to_kingdom_text From researches where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    public function SetValueToKingdomText($project_id, $data)
    {
        $stmt = "update researches set `value_to_kingdom_text` = '" . $data . "' where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    //Get/Set LiteratureReviewText
    public function GetLiteratureReviewText($project_id)
    {
        $stmt = "Select literature_review_text From researches where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    public function SetLiteratureReviewText($project_id, $data)
    {
        $stmt = "update researches set `literature_review_text` = '" . $data . "' where seq_id =" . $project_id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    //--------------------------------------------------------------------------
    public function Lock($projectId)
    {
        $stmt = "update researches set `isLocked` =  1 where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function Unlock($projectId)
    {
        $stmt = "update researches set `isLocked` =  0 where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

//------------------------------------------------------
    public function CanEdit($projectId)
    {
        $stmt = "select `isLocked` From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        while ($row = mysql_fetch_array($rs)) {
            $result = $row[0];
        }
        if ($result == 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function IsAuthorized($projectId, $personId)
    {
        $stmt = "SELECT research_stuff.seq_no FROM research_stuff WHERE research_stuff.research_id =  " . $projectId . " AND research_stuff.person_id = " . $personId . " AND research_stuff.role_id =1 LIMIT 0,1";
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        if (mysql_num_rows($result) == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function Research_Submit($research_id)
    {
        $con = new MysqlConnect();
        $stmt = "update researches set `isDraft`=0 where `seq_id`=" . $research_id;
        $rs = $con->ExecuteNonQuery($stmt);
        $rs2 = $this->Lock($research_id);
        if ($rs == 1 && $rs2 == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function Research_Submit_Undo($research_id)
    {
        $con = new MysqlConnect();
        $stmt = "update researches set `isDraft`=1 where `seq_id`=" . $research_id;
        $rs = $con->ExecuteNonQuery($stmt);
        $rs2 = $this->Unlock($research_id);
        if ($rs == 1 && $rs2 == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function GetResearchDuration($ResearchId)
    {
        $stmt = "select researches.proposed_duration from researches where seq_id=" . $ResearchId;

        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $proposed_duration = 0;
        while ($row = mysql_fetch_array($result)) {
            $proposed_duration = $row['proposed_duration'];
        }
        return $proposed_duration;
    }

    public function DraftComplete($Research_id)
    {
        $con = new MysqlConnect();
        $stmt = "update researches set draft_completed =1 where seq_id=" . $Research_id;
        //echo $stmt;
        $result = $con->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function IsDraftCompleted($Research_id)
    {
        $con = new MysqlConnect();
        $stmt = "Select draft_completed From researches Where seq_id=" . $Research_id;
        $result = $con->ExecuteNonQuery($stmt);
        $IsDraft_completed = 0;
        while ($row = mysql_fetch_array($result)) {
            $IsDraft_completed = $row['draft_completed'];
        }
        return $IsDraft_completed;
    }

    public function GetResearchLang($Research_id)
    {
        $con = new MysqlConnect();
        $stmt = "SELECT t.lang_code FROM researches r INNER JOIN technologies t ON r.center_id = t.seq_id AND r.seq_id=" . $Research_id;
        $result = $con->ExecuteNonQuery($stmt);
        $lang_code = 0;
        while ($row = mysql_fetch_array($result)) {
            $lang_code = $row['lang_code'];
        }
        return $lang_code;
    }
}
